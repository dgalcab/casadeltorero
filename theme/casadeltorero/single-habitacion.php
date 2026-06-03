<?php get_header(); ?>

<?php
$has_acf = function_exists('get_field');
$gf      = fn($k) => $has_acf ? get_field($k) : null;
$go      = fn($k) => $has_acf ? get_field($k, 'option') : null;
$img_base = get_template_directory_uri() . '/assets/img';

if (have_posts()) : while (have_posts()) : the_post();

$eyebrow      = $gf('hab_eyebrow')    ?: 'Alojamiento';
$size         = $gf('hab_size')       ?: '';
$capacity     = $gf('hab_capacity')   ?: '';
$price        = $gf('hab_price')      ?: '';
$desc_long    = $gf('hab_description_long') ?: get_the_content();
$features     = $gf('hab_features')   ?: [];
$gallery      = $gf('hab_gallery')    ?: [];
$booking_url  = $gf('hab_booking_url') ?: home_url('/#reservas');

$phone    = $go('contact_phone')   ?: '+34 615 508 168';
$wa_raw   = $go('social_whatsapp') ?: '34615508168';
$wa_url   = 'https://wa.me/' . preg_replace('/\D/', '', $wa_raw);
?>

<section class="hab-hero">
  <?php if (has_post_thumbnail()) : ?>
    <div class="hab-hero__img">
      <?php the_post_thumbnail('hero', ['loading' => 'lazy', 'alt' => esc_attr(get_the_title())]); ?>
    </div>
  <?php else : ?>
    <div class="hab-hero__img hab-hero__img--placeholder" style="background:var(--cream);min-height:420px;"></div>
  <?php endif; ?>
  <div class="hab-hero__overlay">
    <div class="container">
      <p class="hab-hero__eyebrow"><?php echo esc_html($eyebrow); ?></p>
      <h1 class="hab-hero__title"><?php the_title(); ?></h1>
      <?php if ($price) : ?>
        <p class="hab-hero__price">desde <?php echo esc_html($price); ?> / noche</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<main id="main" class="hab-body">
  <div class="container">
    <div class="hab-layout">

      <!-- Main content -->
      <div class="hab-main">

        <!-- Meta bar -->
        <?php if ($size || $capacity) : ?>
        <div class="hab-meta reveal">
          <?php if ($size) : ?>
            <div class="hab-meta__item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z"/></svg>
              <span><?php echo esc_html($size); ?></span>
            </div>
          <?php endif; ?>
          <?php if ($capacity) : ?>
            <div class="hab-meta__item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0 1 13 0"/></svg>
              <span><?php echo esc_html($capacity); ?></span>
            </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Long description -->
        <?php if ($desc_long) : ?>
        <div class="hab-description reveal">
          <?php echo wp_kses_post($desc_long); ?>
        </div>
        <?php endif; ?>

        <!-- Features list -->
        <?php if ($features) : ?>
        <div class="hab-features reveal">
          <h3>Equipamiento e incluido</h3>
          <ul class="hab-features__list">
            <?php foreach ($features as $item) :
              $label = is_array($item) ? ($item['hab_feature'] ?? '') : $item;
              if (!$label) continue;
            ?>
              <li>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="20 6 9 17 4 12"/></svg>
                <?php echo esc_html($label); ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <!-- Photo gallery slider -->
        <?php if ($gallery) : ?>
        <div class="hab-gallery reveal">
          <h3>Galería</h3>
          <div class="hab-gallery-slider" id="habGallery">
            <div class="hab-gallery-slider__track" id="habGalleryTrack">
              <?php foreach ($gallery as $item) :
                $img = is_array($item) ? ($item['hab_image'] ?? null) : null;
                $alt = is_array($item) ? ($item['hab_image_alt'] ?? '') : '';
                if (!$img) continue;
                $src = is_array($img) ? ($img['url'] ?? '') : $img;
              ?>
                <div class="hab-gallery-slider__slide">
                  <img src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr($alt ?: get_the_title()); ?>" loading="lazy">
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div><!-- /.hab-main -->

      <!-- Sidebar -->
      <aside class="hab-sidebar reveal">
        <div class="hab-sidebar__card">
          <p class="hab-sidebar__from">desde</p>
          <?php if ($price) : ?>
            <p class="hab-sidebar__price"><?php echo esc_html($price); ?></p>
            <p class="hab-sidebar__per">por noche</p>
          <?php endif; ?>
          <a href="<?php echo esc_url($booking_url); ?>" class="btn btn--gold btn--full">Reservar esta habitación</a>
          <div class="hab-sidebar__contact">
            <p>¿Preguntas?</p>
            <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
            <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener">WhatsApp</a>
          </div>
        </div>
      </aside>

    </div><!-- /.hab-layout -->
  </div><!-- /.container -->
</main>

<!-- Other rooms -->
<?php
$other_args = [
    'post_type'      => 'habitacion',
    'posts_per_page' => 3,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post__not_in'   => [get_the_ID()],
];
$other_query = new WP_Query($other_args);
if ($other_query->have_posts()) :
?>
<section class="other-rooms">
  <div class="container">
    <h2 class="other-rooms__title reveal">Otras habitaciones</h2>
    <div class="other-rooms__grid reveal">
      <?php while ($other_query->have_posts()) : $other_query->the_post();
        $o_price = $has_acf ? get_field('hab_price') : '';
        $o_eyebrow = $has_acf ? get_field('hab_eyebrow') : '';
      ?>
        <a href="<?php the_permalink(); ?>" class="space-card">
          <?php if (has_post_thumbnail()) : ?>
            <div class="space-card__img">
              <?php the_post_thumbnail('space-card', ['loading' => 'lazy', 'alt' => esc_attr(get_the_title())]); ?>
            </div>
          <?php endif; ?>
          <div class="space-card__body">
            <?php if ($o_eyebrow) : ?>
              <p class="space-card__tag"><?php echo esc_html($o_eyebrow); ?></p>
            <?php endif; ?>
            <h3 class="space-card__name"><?php the_title(); ?></h3>
            <?php if ($o_price) : ?>
              <p class="space-card__price">desde <?php echo esc_html($o_price); ?></p>
            <?php endif; ?>
          </div>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
