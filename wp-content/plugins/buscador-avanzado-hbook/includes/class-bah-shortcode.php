<?php
defined('ABSPATH') || exit;

class BAH_Shortcode
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
        add_shortcode('buscador_avanzado_hbook', [$this, 'render']);
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    }

    public function register_assets()
    {
        wp_register_style(
            'bah-styles',
            BAH_URL . 'assets/css/styles.css',
            [],
            BAH_VERSION
        );

        wp_register_script(
            'bah-filter',
            BAH_URL . 'assets/js/filter.js',
            [],
            BAH_VERSION,
            true
        );
    }

    public function render($atts)
    {
        $atts = shortcode_atts([
            'posts_per_page' => 0,
            'columns'        => 3,
        ], $atts, 'buscador_avanzado_hbook');

        $resolver = BAH_Resolver::instance();
        $per_page = (int) $atts['posts_per_page'] > 0 ? (int) $atts['posts_per_page'] : $resolver->get_posts_per_page();
        $columns  = max(2, min(4, (int) $atts['columns']));

        $groups = $resolver->get_filter_groups();
        $query  = BAH_Query::run([], 1, $per_page);
        $grid   = BAH_Render::grid($query);
        $count  = (int) $query->found_posts;

        wp_enqueue_style('bah-styles');
        wp_enqueue_script('bah-filter');

        wp_localize_script('bah-filter', 'BAH_DATA', [
            'ajaxUrl'    => admin_url('admin-ajax.php'),
            'nonce'      => wp_create_nonce('bah_filter_nonce'),
            'perPage'    => $per_page,
            'i18n'       => [
                'loading'      => __('Buscando alojamientos…', 'buscador-avanzado-hbook'),
                'loadMore'     => __('Cargar más alojamientos', 'buscador-avanzado-hbook'),
                'resultsOne'   => __('1 alojamiento encontrado', 'buscador-avanzado-hbook'),
                /* translators: %d: número de alojamientos */
                'resultsMany'  => __('%d alojamientos encontrados', 'buscador-avanzado-hbook'),
                'resultsNone'  => __('Ningún alojamiento coincide con tu selección', 'buscador-avanzado-hbook'),
                'filterButton' => __('Filtrar características', 'buscador-avanzado-hbook'),
                'clear'        => __('Limpiar filtros', 'buscador-avanzado-hbook'),
                'close'        => __('Cerrar', 'buscador-avanzado-hbook'),
                'apply'        => __('Ver resultados', 'buscador-avanzado-hbook'),
            ],
        ]);

        $unique_id = wp_unique_id('bah-');

        ob_start();
        ?>
        <div class="bah-wrapper" id="<?php echo esc_attr($unique_id); ?>" data-bah-root data-per-page="<?php echo esc_attr($per_page); ?>">

            <button type="button" class="bah-mobile-toggle" data-bah-open-filters aria-haspopup="dialog" aria-controls="<?php echo esc_attr($unique_id); ?>-filters" aria-expanded="false">
                <svg viewBox="0 0 20 20" class="bah-mobile-toggle__icon" aria-hidden="true"><path d="M3 5h14M6 10h8M9 15h2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <span><?php esc_html_e('Filtrar características', 'buscador-avanzado-hbook'); ?></span>
                <span class="bah-mobile-toggle__badge" data-bah-active-count hidden>0</span>
            </button>

            <div class="bah-overlay" data-bah-overlay hidden></div>

            <div class="bah-layout">
                <aside class="bah-filters" id="<?php echo esc_attr($unique_id); ?>-filters" data-bah-filters role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Filtros de búsqueda', 'buscador-avanzado-hbook'); ?>">
                    <div class="bah-filters__header">
                        <h2 class="bah-filters__title"><?php esc_html_e('Características', 'buscador-avanzado-hbook'); ?></h2>
                        <button type="button" class="bah-filters__close" data-bah-close-filters aria-label="<?php esc_attr_e('Cerrar filtros', 'buscador-avanzado-hbook'); ?>">
                            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </button>
                    </div>

                    <div class="bah-filters__scroll">
                        <?php echo BAH_Render::filters_panel($groups); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>

                    <div class="bah-filters__footer">
                        <button type="button" class="bah-btn bah-btn--ghost" data-bah-clear-filters>
                            <?php esc_html_e('Limpiar filtros', 'buscador-avanzado-hbook'); ?>
                        </button>
                        <button type="button" class="bah-btn bah-btn--primary bah-filters__apply" data-bah-close-filters>
                            <?php esc_html_e('Ver resultados', 'buscador-avanzado-hbook'); ?>
                        </button>
                    </div>
                </aside>

                <section class="bah-results" aria-live="polite">
                    <div class="bah-results__meta">
                        <p class="bah-results__count" data-bah-count>
                            <?php
                            echo esc_html($count === 1
                                ? __('1 alojamiento encontrado', 'buscador-avanzado-hbook')
                                : sprintf(
                                    /* translators: %d: número de alojamientos */
                                    __('%d alojamientos encontrados', 'buscador-avanzado-hbook'),
                                    $count
                                ));
                            ?>
                        </p>
                    </div>

                    <div class="bah-grid-wrap" data-bah-grid-wrap>
                        <div class="bah-grid bah-grid--cols-<?php echo esc_attr($columns); ?>" data-bah-grid>
                            <?php echo $grid; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>

                        <?php if (0 === $count) : ?>
                            <div data-bah-empty><?php echo BAH_Render::empty_state(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                        <?php else : ?>
                            <div data-bah-empty hidden><?php echo BAH_Render::empty_state(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                        <?php endif; ?>

                        <div class="bah-spinner-overlay" data-bah-spinner hidden>
                            <span class="bah-spinner" aria-hidden="true"></span>
                            <span class="bah-spinner-overlay__text"><?php esc_html_e('Buscando alojamientos…', 'buscador-avanzado-hbook'); ?></span>
                        </div>
                    </div>

                    <div class="bah-loadmore-wrap">
                        <button type="button" class="bah-btn bah-btn--outline" data-bah-loadmore data-page="1" <?php echo ($query->max_num_pages <= 1) ? 'hidden' : ''; ?>>
                            <?php esc_html_e('Cargar más alojamientos', 'buscador-avanzado-hbook'); ?>
                        </button>
                    </div>
                </section>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
