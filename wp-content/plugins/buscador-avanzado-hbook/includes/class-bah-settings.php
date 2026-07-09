<?php
defined('ABSPATH') || exit;

/**
 * Página de ajustes en Ajustes > Buscador HBook.
 *
 * Permite confirmar o sobrescribir el CPT/taxonomías auto-detectados y
 * configurar cómo se genera la URL de reserva, sin tocar código.
 */
class BAH_Settings
{
    private static $instance = null;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_settings_page()
    {
        add_options_page(
            __('Buscador Avanzado HBook', 'buscador-avanzado-hbook'),
            __('Buscador HBook', 'buscador-avanzado-hbook'),
            'manage_options',
            'buscador-avanzado-hbook',
            [$this, 'render_settings_page']
        );
    }

    public function register_settings()
    {
        register_setting('bah_settings_group', BAH_Resolver::OPTION_KEY, [
            'sanitize_callback' => [$this, 'sanitize_settings'],
        ]);
    }

    public function sanitize_settings($input)
    {
        $clean = [];

        $clean['post_type']       = isset($input['post_type']) ? sanitize_key($input['post_type']) : '';
        $clean['taxonomies']      = isset($input['taxonomies']) ? sanitize_text_field($input['taxonomies']) : '';
        $clean['posts_per_page']  = isset($input['posts_per_page']) ? max(1, absint($input['posts_per_page'])) : 12;
        $clean['engine_page_id']  = isset($input['engine_page_id']) ? absint($input['engine_page_id']) : 0;
        $clean['engine_id_param'] = isset($input['engine_id_param']) ? sanitize_key($input['engine_id_param']) : '';
        $clean['accommodation_id_meta_keys'] = isset($input['accommodation_id_meta_keys'])
            ? sanitize_textarea_field($input['accommodation_id_meta_keys'])
            : '';

        return $clean;
    }

    public function render_settings_page()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $resolver          = BAH_Resolver::instance();
        $detected_post_type = $resolver->get_post_type();
        $detected_taxonomies = wp_list_pluck($resolver->get_taxonomies(), 'name');
        $settings           = get_option(BAH_Resolver::OPTION_KEY, []);
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Buscador Avanzado HBook', 'buscador-avanzado-hbook'); ?></h1>

            <p>
                <?php esc_html_e('El plugin detecta automáticamente el tipo de contenido y las taxonomías de características usadas por HBook. Solo necesitas rellenar estos campos si tu instalación usa nombres personalizados.', 'buscador-avanzado-hbook'); ?>
            </p>

            <table class="widefat" style="max-width:720px;margin-bottom:24px;">
                <tbody>
                    <tr>
                        <td><strong><?php esc_html_e('Tipo de contenido detectado', 'buscador-avanzado-hbook'); ?></strong></td>
                        <td>
                            <code><?php echo esc_html($detected_post_type); ?></code>
                            <?php if (!post_type_exists($detected_post_type)) : ?>
                                <span style="color:#b32d2e;"> — <?php esc_html_e('no existe todavía en esta instalación', 'buscador-avanzado-hbook'); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Taxonomías de características detectadas', 'buscador-avanzado-hbook'); ?></strong></td>
                        <td><code><?php echo esc_html($detected_taxonomies ? implode(', ', $detected_taxonomies) : __('ninguna', 'buscador-avanzado-hbook')); ?></code></td>
                    </tr>
                </tbody>
            </table>

            <form method="post" action="options.php">
                <?php settings_fields('bah_settings_group'); ?>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="bah_post_type"><?php esc_html_e('Tipo de contenido (CPT)', 'buscador-avanzado-hbook'); ?></label></th>
                        <td>
                            <input type="text" id="bah_post_type" class="regular-text" placeholder="<?php echo esc_attr($detected_post_type); ?>"
                                name="<?php echo esc_attr(BAH_Resolver::OPTION_KEY); ?>[post_type]"
                                value="<?php echo esc_attr($settings['post_type'] ?? ''); ?>">
                            <p class="description"><?php esc_html_e('Déjalo vacío para usar el valor auto-detectado.', 'buscador-avanzado-hbook'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bah_taxonomies"><?php esc_html_e('Taxonomías de características', 'buscador-avanzado-hbook'); ?></label></th>
                        <td>
                            <input type="text" id="bah_taxonomies" class="regular-text" placeholder="accommodation_tag, accommodation_cat"
                                name="<?php echo esc_attr(BAH_Resolver::OPTION_KEY); ?>[taxonomies]"
                                value="<?php echo esc_attr($settings['taxonomies'] ?? ''); ?>">
                            <p class="description"><?php esc_html_e('Lista separada por comas. Déjalo vacío para auto-detectar.', 'buscador-avanzado-hbook'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bah_posts_per_page"><?php esc_html_e('Alojamientos por página', 'buscador-avanzado-hbook'); ?></label></th>
                        <td>
                            <input type="number" min="1" id="bah_posts_per_page" class="small-text"
                                name="<?php echo esc_attr(BAH_Resolver::OPTION_KEY); ?>[posts_per_page]"
                                value="<?php echo esc_attr($settings['posts_per_page'] ?? 12); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2"><h2><?php esc_html_e('Flujo de reserva', 'buscador-avanzado-hbook'); ?></h2></th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="description">
                                <?php esc_html_e('Por defecto, el botón "Ver disponibilidad" enlaza a la página del propio alojamiento (donde HBook muestra su widget de reserva). Si tu instalación usa una página central del motor de reservas con un parámetro de ID (p. ej. "acco_id"), configúralo aquí.', 'buscador-avanzado-hbook'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bah_engine_page_id"><?php esc_html_e('Página del motor de reservas (opcional)', 'buscador-avanzado-hbook'); ?></label></th>
                        <td>
                            <?php
                            wp_dropdown_pages([
                                'name'              => BAH_Resolver::OPTION_KEY . '[engine_page_id]',
                                'id'                => 'bah_engine_page_id',
                                'selected'          => (int) ($settings['engine_page_id'] ?? 0),
                                'show_option_none'  => __('— Usar la página del alojamiento —', 'buscador-avanzado-hbook'),
                                'option_none_value' => 0,
                            ]);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bah_engine_id_param"><?php esc_html_e('Parámetro de ID en la URL', 'buscador-avanzado-hbook'); ?></label></th>
                        <td>
                            <input type="text" id="bah_engine_id_param" class="regular-text" placeholder="acco_id"
                                name="<?php echo esc_attr(BAH_Resolver::OPTION_KEY); ?>[engine_id_param]"
                                value="<?php echo esc_attr($settings['engine_id_param'] ?? ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bah_meta_keys"><?php esc_html_e('Meta keys candidatas para el ID externo', 'buscador-avanzado-hbook'); ?></label></th>
                        <td>
                            <textarea id="bah_meta_keys" rows="4" class="large-text code"
                                name="<?php echo esc_attr(BAH_Resolver::OPTION_KEY); ?>[accommodation_id_meta_keys]"
                            ><?php echo esc_textarea($settings['accommodation_id_meta_keys'] ?? "hab_ohbe_id\nacco_id\n_hb_room_id\nhb_accommodation_id"); ?></textarea>
                            <p class="description"><?php esc_html_e('Una por línea. Se usa la primera que tenga valor en el alojamiento.', 'buscador-avanzado-hbook'); ?></p>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>
            </form>

            <hr>
            <p><strong><?php esc_html_e('Shortcode:', 'buscador-avanzado-hbook'); ?></strong> <code>[buscador_avanzado_hbook]</code></p>
        </div>
        <?php
    }
}
