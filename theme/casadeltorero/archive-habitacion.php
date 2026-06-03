<?php get_header(); ?>

<?php
$has_acf = function_exists('get_field');
?>

<section class="archive-hero">
  <div class="archive-hero__content">
    <div class="container">
      <p class="archive-hero__eyebrow">La Casa del Torero · Vejer de la Frontera</p>
      <h1 class="archive-hero__title">Nuestras Habitaciones</h1>
      <p class="archive-hero__subtitle">Cuatro espacios únicos en una finca histórica rodeada de olivos centenarios</p>
    </div>
  </div>
</section>

<main id="main" class="archive-page">
  <div class="container">
    <div class="archive-grid">
      <?php if (have_posts()) : while (have_posts()) : the_post();
        $price    = $has_acf ? get_field('hab_price')    : '';
        $eyebrow  = $has_acf ? get_field('hab_eyebrow')  : '';
        $size     = $has_acf ? get_field('hab_size')     : '';
        $capacity = $has_acf ? get_field('hab_capacity') : '';
      ?>
        <article <?php post_class('space-card reveal'); ?>>
          <a href="<?php the_permalink(); ?>" class="space-card__link" tabindex="-1" aria-hidden="true">
            <?php if (has_post_thumbnail()) : ?>
              <div class="space-card__img">
                <?php the_post_thumbnail('space-card', ['loading' => 'lazy', 'alt' => esc_attr(get_the_title())]); ?>
              </div>
            <?php endif; ?>
          </a>
          <div class="space-card__body">
            <?php if ($eyebrow) : ?>
              <p class="space-card__tag"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <h2 class="space-card__name">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <?php if (has_excerpt()) : ?>
              <p class="space-card__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php endif; ?>
            <div class="space-card__meta">
              <?php if ($size) : ?>
                <span><?php echo esc_html($size); ?></span>
              <?php endif; ?>
              <?php if ($capacity) : ?>
                <span><?php echo esc_html($capacity); ?></span>
              <?php endif; ?>
            </div>
            <div class="space-card__footer">
              <?php if ($price) : ?>
                <p class="space-card__price">desde <?php echo esc_html($price); ?> / noche</p>
              <?php endif; ?>
              <a href="<?php the_permalink(); ?>" class="btn btn--outline">Ver habitación</a>
            </div>
          </div>
        </article>
      <?php endwhile; endif; ?>
    </div><!-- /.archive-grid -->

    <?php the_posts_pagination(['mid_size' => 2, 'prev_text' => '←', 'next_text' => '→']); ?>

  </div><!-- /.container -->
</main>

<?php get_footer(); ?>
