<?php
defined('ABSPATH') || exit;

/**
 * Helpers de renderizado HTML compartidos entre el shortcode (SSR inicial)
 * y las respuestas AJAX del filtrado en tiempo real.
 */
class BAH_Render
{
    /**
     * Panel lateral de filtros combinables.
     */
    public static function filters_panel($groups)
    {
        ob_start();
        ?>
        <form id="bah-filters-form" class="bah-filters__form">
            <?php if (empty($groups)) : ?>
                <p class="bah-filters__empty"><?php esc_html_e('No hay características configuradas para filtrar todavía.', 'buscador-avanzado-hbook'); ?></p>
            <?php endif; ?>

            <?php foreach ($groups as $group) : ?>
                <fieldset class="bah-filter-group" data-taxonomy="<?php echo esc_attr($group['taxonomy']); ?>">
                    <legend class="bah-filter-group__title"><?php echo esc_html($group['label']); ?></legend>
                    <div class="bah-filter-group__options">
                        <?php foreach ($group['terms'] as $term) : ?>
                            <label class="bah-checkbox">
                                <input
                                    type="checkbox"
                                    class="bah-checkbox__input"
                                    name="bah_filter[<?php echo esc_attr($group['taxonomy']); ?>][]"
                                    value="<?php echo esc_attr($term->term_id); ?>"
                                    data-taxonomy="<?php echo esc_attr($group['taxonomy']); ?>"
                                    data-slug="<?php echo esc_attr($term->slug); ?>"
                                >
                                <span class="bah-checkbox__box" aria-hidden="true">
                                    <svg viewBox="0 0 16 16" class="bah-checkbox__tick"><path d="M3 8.5L6.5 12L13 4.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <span class="bah-checkbox__label"><?php echo esc_html($term->name); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
            <?php endforeach; ?>
        </form>
        <?php
        return ob_get_clean();
    }

    /**
     * Tarjeta individual de alojamiento.
     */
    public static function card($post)
    {
        $post_id      = $post->ID;
        $title        = get_the_title($post_id);
        $permalink    = get_permalink($post_id);
        $booking_url  = BAH_Resolver::instance()->get_booking_url($post_id);
        $excerpt      = wp_trim_words(get_the_excerpt($post_id), 20);
        $terms        = self::card_badges($post_id);

        $image = has_post_thumbnail($post_id)
            ? get_the_post_thumbnail($post_id, 'medium_large', ['class' => 'bah-card__img', 'loading' => 'lazy'])
            : '<div class="bah-card__img bah-card__img--placeholder" aria-hidden="true"></div>';

        ob_start();
        ?>
        <article class="bah-card" data-post-id="<?php echo esc_attr($post_id); ?>">
            <a class="bah-card__media" href="<?php echo esc_url($permalink); ?>" tabindex="-1" aria-hidden="true">
                <?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </a>
            <div class="bah-card__body">
                <h3 class="bah-card__title">
                    <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
                </h3>

                <?php if ($excerpt) : ?>
                    <p class="bah-card__excerpt"><?php echo esc_html($excerpt); ?></p>
                <?php endif; ?>

                <?php if (!empty($terms)) : ?>
                    <ul class="bah-card__badges">
                        <?php foreach ($terms as $term) : ?>
                            <li class="bah-badge"><?php echo esc_html($term->name); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <a class="bah-card__cta" href="<?php echo esc_url($booking_url); ?>">
                    <?php esc_html_e('Ver disponibilidad', 'buscador-avanzado-hbook'); ?>
                    <svg viewBox="0 0 20 20" class="bah-card__cta-icon" aria-hidden="true"><path d="M7 4l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </article>
        <?php
        return ob_get_clean();
    }

    /**
     * Recopila hasta 4 badges de características para mostrar en la tarjeta.
     */
    private static function card_badges($post_id)
    {
        $badges    = [];
        $resolver  = BAH_Resolver::instance();

        foreach ($resolver->get_taxonomies() as $tax) {
            $terms = get_the_terms($post_id, $tax->name);

            if (empty($terms) || is_wp_error($terms)) {
                continue;
            }

            foreach ($terms as $term) {
                $badges[] = $term;
                if (count($badges) >= 4) {
                    break 2;
                }
            }
        }

        return $badges;
    }

    /**
     * Rejilla de tarjetas (usada tanto en el primer render como en AJAX).
     */
    public static function grid($query)
    {
        if (!$query->have_posts()) {
            return '';
        }

        $html = '';
        while ($query->have_posts()) {
            $query->the_post();
            $html .= self::card(get_post());
        }
        wp_reset_postdata();

        return $html;
    }

    public static function empty_state()
    {
        ob_start();
        ?>
        <div class="bah-empty-state">
            <svg viewBox="0 0 64 64" class="bah-empty-state__icon" aria-hidden="true">
                <circle cx="27" cy="27" r="16" fill="none" stroke="currentColor" stroke-width="3"/>
                <line x1="38" y1="38" x2="54" y2="54" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            </svg>
            <p><?php esc_html_e('No hemos encontrado alojamientos con esa combinación de características.', 'buscador-avanzado-hbook'); ?></p>
            <button type="button" class="bah-btn bah-btn--ghost" data-bah-clear-filters>
                <?php esc_html_e('Quitar filtros', 'buscador-avanzado-hbook'); ?>
            </button>
        </div>
        <?php
        return ob_get_clean();
    }
}
