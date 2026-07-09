<?php
defined('ABSPATH') || exit;

/**
 * Detecta automáticamente cómo está registrado HBook en la instalación
 * actual (post type y taxonomías de características) y resuelve la URL
 * de reserva de cada alojamiento. Todo es sobrescribible desde
 * Ajustes > Buscador HBook sin tocar código.
 */
class BAH_Resolver
{
    const OPTION_KEY = 'bah_settings';

    private static $instance = null;

    /** @var array */
    private $settings;

    /** @var string|null */
    private $post_type_cache = null;

    /** @var array|null */
    private $taxonomies_cache = null;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $defaults = [
            'post_type'        => '',
            'taxonomies'       => '',
            'posts_per_page'   => 12,
            'engine_page_id'   => 0,
            'engine_id_param'  => '',
            'accommodation_id_meta_keys' => "hab_ohbe_id\nacco_id\n_hb_room_id\nhb_accommodation_id",
        ];

        $this->settings = wp_parse_args(get_option(self::OPTION_KEY, []), $defaults);
    }

    public function get_setting($key)
    {
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }

    /**
     * Post types candidatos habituales usados por el plugin HBook y
     * variantes conocidas, en orden de prioridad.
     */
    private function candidate_post_types()
    {
        return [
            'hb_accommodation',
            'accommodation',
            'hbook_accommodation',
            'hb-accommodation',
        ];
    }

    /**
     * Devuelve el slug del Custom Post Type de alojamientos a utilizar.
     */
    public function get_post_type()
    {
        if (null !== $this->post_type_cache) {
            return $this->post_type_cache;
        }

        // 1. Override manual desde ajustes.
        $override = trim((string) $this->get_setting('post_type'));
        if ($override !== '' && post_type_exists($override)) {
            return $this->post_type_cache = $override;
        }

        // 2. Candidatos conocidos de HBook.
        foreach ($this->candidate_post_types() as $candidate) {
            if (post_type_exists($candidate)) {
                return $this->post_type_cache = $candidate;
            }
        }

        // 3. Búsqueda heurística entre todos los post types registrados.
        foreach (get_post_types([], 'names') as $name) {
            if (preg_match('/^hb[_-]?accommodation|accommodation/i', $name)) {
                return $this->post_type_cache = $name;
            }
        }

        // 4. Último recurso: el CPT de habitaciones propio del tema, si existe.
        if (post_type_exists('habitacion')) {
            return $this->post_type_cache = 'habitacion';
        }

        return $this->post_type_cache = apply_filters('bah_fallback_post_type', 'hb_accommodation');
    }

    /**
     * Devuelve las taxonomías de características (piscina, mascotas, etc.)
     * asociadas al CPT de alojamientos, como array de objetos WP_Taxonomy.
     */
    public function get_taxonomies()
    {
        if (null !== $this->taxonomies_cache) {
            return $this->taxonomies_cache;
        }

        $post_type = $this->get_post_type();
        $result    = [];

        // 1. Override manual (lista separada por comas).
        $override = trim((string) $this->get_setting('taxonomies'));
        if ($override !== '') {
            foreach (array_map('trim', explode(',', $override)) as $slug) {
                if ($slug !== '' && taxonomy_exists($slug)) {
                    $result[] = get_taxonomy($slug);
                }
            }
        }

        if (empty($result)) {
            $preferred = ['accommodation_tag', 'accommodation_cat', 'hb_accommodation_tag', 'hb_accommodation_type', 'hb_amenity'];
            $attached  = get_object_taxonomies($post_type, 'objects');

            foreach ($preferred as $slug) {
                if (isset($attached[$slug])) {
                    $result[] = $attached[$slug];
                    unset($attached[$slug]);
                }
            }

            // Resto de taxonomías públicas asociadas (categorías/etiquetas nativas incluidas).
            foreach ($attached as $tax) {
                if (!empty($tax->public) || in_array($tax->name, ['category', 'post_tag'], true)) {
                    $result[] = $tax;
                }
            }
        }

        // Solo nos interesan las taxonomías que realmente tienen términos con contenido.
        $result = array_values(array_filter($result, function ($tax) {
            $terms = get_terms([
                'taxonomy'   => $tax->name,
                'hide_empty' => false,
                'number'     => 1,
                'fields'     => 'ids',
            ]);

            return !is_wp_error($terms) && !empty($terms);
        }));

        return $this->taxonomies_cache = apply_filters('bah_accommodation_taxonomies', $result, $post_type);
    }

    /**
     * Construye los grupos de filtros (taxonomía + términos) listos para pintar.
     */
    public function get_filter_groups()
    {
        $groups = [];

        foreach ($this->get_taxonomies() as $tax) {
            $terms = get_terms([
                'taxonomy'   => $tax->name,
                'hide_empty' => true,
                'orderby'    => 'name',
                'order'      => 'ASC',
            ]);

            if (is_wp_error($terms) || empty($terms)) {
                continue;
            }

            $groups[] = [
                'taxonomy' => $tax->name,
                'label'    => $tax->labels->name ?? $tax->label,
                'terms'    => $terms,
            ];
        }

        return apply_filters('bah_filter_groups', $groups);
    }

    /**
     * Claves meta habituales donde HBook (o integraciones tipo OHBE)
     * guardan el identificador del alojamiento en el motor de reservas.
     */
    private function accommodation_id_meta_keys()
    {
        $raw = (string) $this->get_setting('accommodation_id_meta_keys');
        $keys = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $raw)));

        return array_values($keys);
    }

    /**
     * Resuelve la URL de "Ver disponibilidad / Reservar" para un alojamiento,
     * evitando formularios duplicados: reutiliza la propia página del
     * alojamiento (donde HBook inyecta su widget de reserva) y propaga
     * cualquier búsqueda de fechas/huéspedes ya realizada por el usuario.
     */
    public function get_booking_url($post_id)
    {
        $engine_page_id  = (int) $this->get_setting('engine_page_id');
        $engine_id_param = trim((string) $this->get_setting('engine_id_param'));

        if ($engine_page_id && $engine_id_param) {
            $engine_value = $this->get_external_accommodation_id($post_id);
            $url = add_query_arg($engine_id_param, $engine_value ?: $post_id, get_permalink($engine_page_id));
        } else {
            $url = get_permalink($post_id);
        }

        $url = $this->propagate_search_params($url);

        return apply_filters('bah_booking_url', $url, $post_id);
    }

    /**
     * Busca en post meta un identificador externo del alojamiento
     * (usado por integraciones tipo "acco_id" de OHBE/HBook).
     */
    private function get_external_accommodation_id($post_id)
    {
        foreach ($this->accommodation_id_meta_keys() as $meta_key) {
            $value = get_post_meta($post_id, $meta_key, true);
            if ($value !== '' && $value !== null) {
                return $value;
            }
        }

        return '';
    }

    /**
     * Propaga parámetros de búsqueda de fechas/huéspedes ya presentes en la
     * URL actual (check-in, check-out, adultos, niños...) para que el
     * usuario no tenga que volver a introducirlos en el motor de HBook.
     */
    private function propagate_search_params($url)
    {
        $whitelist = apply_filters('bah_propagated_search_params', [
            'check_in', 'check_out', 'checkin', 'checkout',
            'hb_check_in', 'hb_check_out',
            'adults', 'children', 'guests',
        ]);

        foreach ($whitelist as $param) {
            if (isset($_GET[$param]) && $_GET[$param] !== '') { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                $url = add_query_arg($param, rawurlencode(wp_unslash($_GET[$param])), $url); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            }
        }

        return $url;
    }

    public function get_posts_per_page()
    {
        $value = (int) $this->get_setting('posts_per_page');

        return $value > 0 ? $value : 12;
    }
}
