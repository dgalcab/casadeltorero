<?php
defined('ABSPATH') || exit;

/**
 * Construye y ejecuta la consulta de alojamientos filtrados.
 *
 * Cada característica marcada (independientemente de la taxonomía a la
 * que pertenezca) se añade como una cláusula independiente de tax_query
 * con relación superior "AND": una propiedad solo aparece si cumple
 * TODAS las características seleccionadas.
 */
class BAH_Query
{
    /**
     * @param array $filters Array asociativo [taxonomy_slug => [term_id, ...]]
     * @param int   $paged
     * @param int   $per_page
     * @return WP_Query
     */
    public static function run(array $filters, $paged = 1, $per_page = null)
    {
        $resolver  = BAH_Resolver::instance();
        $post_type = $resolver->get_post_type();
        $per_page  = $per_page ?: $resolver->get_posts_per_page();

        $valid_taxonomies = wp_list_pluck($resolver->get_taxonomies(), 'name');

        $args = [
            'post_type'              => $post_type,
            'post_status'            => 'publish',
            'posts_per_page'         => $per_page,
            'paged'                  => max(1, (int) $paged),
            'ignore_sticky_posts'    => true,
            'no_found_rows'          => false,
            'update_post_term_cache' => false,
        ];

        $tax_query = ['relation' => 'AND'];

        foreach ($filters as $taxonomy => $term_ids) {
            if (!in_array($taxonomy, $valid_taxonomies, true)) {
                continue;
            }

            $term_ids = array_filter(array_map('absint', (array) $term_ids));

            foreach ($term_ids as $term_id) {
                $tax_query[] = [
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => [$term_id],
                    'operator' => 'IN',
                ];
            }
        }

        if (count($tax_query) > 1) {
            $args['tax_query'] = $tax_query; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
        }

        $args = apply_filters('bah_query_args', $args, $filters);

        return new WP_Query($args);
    }

    /**
     * Sanea el payload de filtros recibido por AJAX:
     * [ 'taxonomy_slug' => [ term_id, term_id, ... ], ... ]
     */
    public static function sanitize_filters($raw)
    {
        $filters = [];

        if (!is_array($raw)) {
            return $filters;
        }

        $valid_taxonomies = wp_list_pluck(BAH_Resolver::instance()->get_taxonomies(), 'name');

        foreach ($raw as $taxonomy => $term_ids) {
            $taxonomy = sanitize_key($taxonomy);

            if (!in_array($taxonomy, $valid_taxonomies, true) || !is_array($term_ids)) {
                continue;
            }

            $clean = array_values(array_filter(array_map('absint', $term_ids)));

            if (!empty($clean)) {
                $filters[$taxonomy] = $clean;
            }
        }

        return $filters;
    }
}
