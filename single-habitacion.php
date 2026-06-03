<?php get_header(); ?>

<style>
/* ══ SINGLE HABITACION — complete rewrite ═══════════════════ */

/* ── Hero ── */
.hab-hero {
  position: relative;
  height: 65vh;
  min-height: 480px;
  overflow: hidden;
}
.hab-hero__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.hab-hero__overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(8,5,3,.82) 0%, rgba(8,5,3,.1) 55%, transparent 100%);
}
.hab-hero__content {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: clamp(2.5rem, 5vw, 5rem);
  color: var(--white);
}
.hab-hero__eyebrow {
  font-family: var(--sans);
  font-size: .6rem;
  letter-spacing: .25em;
  text-transform: uppercase;
  color: var(--gold-lt);
  display: block;
  margin-bottom: .75rem;
}
.hab-hero__title {
  font-family: var(--serif);
  font-size: clamp(2.5rem, 5vw, 4.5rem);
  font-weight: 300;
  line-height: 1.1;
  color: var(--white);
  margin-bottom: 1rem;
}
.hab-hero__meta {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
  font-size: .82rem;
  color: rgba(255,255,255,.65);
}
.hab-hero__meta strong { color: var(--gold-lt); font-weight: 400; }

/* ── Body layout ── */
.hab-body {
  background: var(--cream);
  padding: var(--py) 0;
}
.hab-layout {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: clamp(3rem, 5vw, 6rem);
  align-items: start;
}

/* ── Gallery ── */
.hab-gallery {
  margin-bottom: 3rem;
}
.hab-gallery__track {
  display: flex;
  gap: 6px;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  scrollbar-width: none;
  cursor: grab;
}
.hab-gallery__track::-webkit-scrollbar { display: none; }
.hab-gallery__track.dragging { cursor: grabbing; scroll-snap-type: none; }
.hab-gallery__slide {
  flex: 0 0 clamp(300px, 75%, 700px);
  aspect-ratio: 4/3;
  overflow: hidden;
  scroll-snap-align: start;
}
.hab-gallery__slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .7s ease;
}
.hab-gallery__slide:hover img { transform: scale(1.03); }

/* ── Description ── */
.hab-description { margin-bottom: 3rem; }
.hab-description h2, .hab-description h3 {
  font-family: var(--serif);
  font-size: clamp(1.35rem, 2vw, 1.75rem);
  margin-bottom: .75rem;
  margin-top: 1.75rem;
  color: var(--text);
}
.hab-description p {
  font-size: 1.0625rem;
  line-height: 1.85;
  color: var(--text);
  margin-bottom: 1.25rem;
}

/* ── Amenities ── */
.hab-amenities { margin-bottom: 3rem; }
.hab-amenities__heading {
  font-family: var(--serif);
  font-size: clamp(1.25rem, 2vw, 1.5rem);
  margin-bottom: 1.5rem;
  color: var(--text);
  padding-bottom: .75rem;
  border-bottom: 1px solid var(--border);
}
.hab-amenities__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.25rem 1rem;
}
.hab-amenities__item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: .5rem;
  text-align: center;
}
.hab-amenities__icon {
  width: 40px; height: 40px;
  display: flex; align-items: center; justify-content: center;
  color: var(--gold);
}
.hab-amenities__icon svg { width: 28px; height: 28px; }
.hab-amenities__label {
  font-size: .75rem;
  color: var(--text);
  line-height: 1.3;
}
@media (max-width: 768px) {
  .hab-amenities__grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 480px) {
  .hab-amenities__grid { grid-template-columns: repeat(2, 1fr); }
}

/* ── Sidebar ── */
.hab-sidebar__card {
  background: var(--white);
  border: 1px solid var(--border);
  padding: 2rem;
  position: sticky;
  top: 7rem;
}
.hab-sidebar__from {
  font-family: var(--sans);
  font-size: .7rem;
  letter-spacing: .15em;
  text-transform: uppercase;
  color: var(--muted);
  margin-bottom: .25rem;
}
.hab-sidebar__price {
  font-family: var(--serif);
  font-size: 2.5rem;
  font-weight: 300;
  color: var(--blue);
  line-height: 1;
  margin-bottom: .25rem;
}
.hab-sidebar__per {
  font-size: .8rem;
  color: var(--muted);
  margin-bottom: 1.5rem;
}
.hab-sidebar__divider {
  height: 1px;
  background: var(--border);
  margin: 1.5rem 0;
}
.hab-engine { margin-bottom: 1rem; }
.hab-sidebar__contact { margin-top: 0; }
.hab-sidebar__contact p {
  color: var(--muted);
  margin-bottom: .5rem;
  font-family: var(--sans);
  font-size: .72rem;
  letter-spacing: .1em;
  text-transform: uppercase;
}
.hab-sidebar__contact a {
  display: block;
  color: var(--text);
  text-decoration: none;
  margin-bottom: .4rem;
  font-size: .875rem;
  transition: color var(--ease);
}
.hab-sidebar__contact a:hover { color: var(--gold); }

/* ── Other rooms section ── */
.other-rooms {
  background: var(--cream);
  padding: var(--py) 0;
  border-top: 1px solid var(--border);
}
.other-rooms__title {
  font-family: var(--serif);
  font-size: clamp(1.5rem, 2.5vw, 2.25rem);
  text-align: center;
  margin-bottom: clamp(2rem, 4vw, 3.5rem);
  color: var(--text);
}
.other-rooms__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5px;
}

/* ── Responsive ── */
@media(max-width: 960px) {
  .hab-layout { grid-template-columns: 1fr; }
  .hab-sidebar__card { position: static; }
}
@media(max-width: 640px) {
  .other-rooms__grid { grid-template-columns: 1fr; gap: 1.5px; }
  .hab-features__grid { grid-template-columns: 1fr; }
  .hab-gallery__slide { flex: 0 0 85vw; }
}
</style>

<?php
$has_acf  = function_exists('get_field');
$gf       = fn($k) => $has_acf ? get_field($k)          : null;
$go       = fn($k) => $has_acf ? get_field($k, 'option') : null;
$img_base = get_template_directory_uri() . '/assets/img';

if (have_posts()) : while (have_posts()) : the_post();

$eyebrow   = $gf('hab_eyebrow')           ?: 'Alojamiento';
$size      = $gf('hab_size')              ?: '';
$capacity  = $gf('hab_capacity')          ?: '';
$price     = $gf('hab_price')             ?: '';
$desc_long = $gf('hab_description_long')  ?: get_the_content();
$amenities = $gf('hab_amenities')         ?: [];
$gallery   = $gf('hab_gallery')           ?: [];
$ohbe_id   = $gf('hab_ohbe_id')           ?: '';

$phone   = $go('contact_phone')   ?: '+34 615 508 168';
$wa_raw  = $go('social_whatsapp') ?: '34615508168';
$wa_url  = 'https://wa.me/' . preg_replace('/\D/', '', $wa_raw);

/* Fallback images per room slug */
$slug_fallbacks = [
    'suite-del-torero'       => $img_base . '/espacios/suite-principal.jpg',
    'doble-superior'         => $img_base . '/espacios/doble-superior.jpg',
    'habitacion-doble'       => $img_base . '/espacios/habitacion-doble.jpg',
    'apartamento-panoramico' => $img_base . '/espacios/apartamento.jpg',
];
$slug = get_post_field('post_name');
$fallback_hero = $slug_fallbacks[$slug] ?? ($img_base . '/espacios/hab-slide-1.jpg');

/* Fallback gallery images per slug */
$gallery_fallbacks = [
    'suite-del-torero'       => [
        $img_base . '/espacios/suite-principal.jpg',
        $img_base . '/espacios/suite-2.jpg',
        $img_base . '/espacios/suite-3.jpg',
        $img_base . '/espacios/suite-bano.jpg',
    ],
    'doble-superior'         => [
        $img_base . '/espacios/doble-superior.jpg',
        $img_base . '/espacios/hab-slide-1.jpg',
        $img_base . '/espacios/hab-slide-2.jpg',
    ],
    'habitacion-doble'       => [
        $img_base . '/espacios/habitacion-doble.jpg',
        $img_base . '/espacios/hab-slide-1.jpg',
        $img_base . '/espacios/hab-slide-2.jpg',
    ],
    'apartamento-panoramico' => [
        $img_base . '/espacios/apartamento.jpg',
        $img_base . '/espacios/hab-slide-1.jpg',
        $img_base . '/espacios/hab-slide-2.jpg',
    ],
];
$fallback_slides = $gallery_fallbacks[$slug] ?? [ $fallback_hero, $img_base . '/espacios/hab-slide-1.jpg' ];

/* Hero image: featured image → first ACF gallery image → slug fallback */
$hero_img = get_the_post_thumbnail_url(null, 'hero');
if ( ! $hero_img && ! empty($gallery) ) {
    $first = $gallery[0]['hab_image'] ?? null;
    $hero_img = is_array($first) ? ($first['url'] ?? '') : $first;
}
$hero_img = $hero_img ?: $fallback_hero;
?>

<!-- ══════════ HERO ══════════ -->
<section class="hab-hero" aria-label="<?php echo esc_attr(get_the_title()); ?>">
  <img class="hab-hero__img"
       src="<?php echo esc_url($hero_img); ?>"
       alt="<?php echo esc_attr(get_the_title()); ?>"
       loading="eager">

  <div class="hab-hero__overlay"></div>

  <div class="hab-hero__content">
    <span class="hab-hero__eyebrow"><?php echo esc_html($eyebrow); ?></span>
    <h1 class="hab-hero__title"><?php the_title(); ?></h1>
    <div class="hab-hero__meta">
      <?php if ($size) : ?>
        <span><?php echo esc_html($size); ?></span>
      <?php endif; ?>
      <?php if ($capacity) : ?>
        <span><?php echo esc_html($capacity); ?></span>
      <?php endif; ?>
      <?php if ($price) : ?>
        <span><strong>Desde <?php echo esc_html($price); ?></strong> / noche</span>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- ══════════ BODY ══════════ -->
<main id="main" class="hab-body">
  <div class="container">
    <div class="hab-layout">

      <!-- ── LEFT: Main content ── -->
      <div class="hab-main">

        <!-- Gallery slider -->
        <div class="hab-gallery reveal">
          <div class="hab-gallery__track" id="habGalleryTrack">
            <?php if (!empty($gallery)) :
              foreach ($gallery as $item) :
                $img = is_array($item) ? ($item['hab_image'] ?? null) : null;
                $alt = is_array($item) ? ($item['hab_image_alt'] ?? '') : '';
                if (!$img) continue;
                $src = is_array($img) ? ($img['url'] ?? '') : $img;
            ?>
              <div class="hab-gallery__slide">
                <img src="<?php echo esc_url($src); ?>"
                     alt="<?php echo esc_attr($alt ?: get_the_title()); ?>"
                     loading="lazy">
              </div>
            <?php endforeach;

            else :
              foreach ($fallback_slides as $slide) : ?>
                <div class="hab-gallery__slide">
                  <img src="<?php echo esc_url($slide); ?>"
                       alt="<?php echo esc_attr(get_the_title()); ?>"
                       loading="lazy">
                </div>
              <?php endforeach;
            endif; ?>
          </div>
        </div>


        <!-- Long description -->
        <?php if ($desc_long) : ?>
        <div class="hab-description reveal">
          <?php echo wp_kses_post($desc_long); ?>
        </div>
        <?php endif; ?>


        <!-- Amenities grid -->
        <?php
        $amenity_map = [
            'calefaccion' => ['label' => 'Calefacción',        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>'],
            'aire'        => ['label' => 'Aire acondicionado', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="8" rx="2"/><path d="M12 11v10"/><path d="m9 17 3 3 3-3"/><path d="M8 15H5a2 2 0 0 0 0 4h3M16 15h3a2 2 0 0 1 0 4h-3"/></svg>'],
            'tv'          => ['label' => 'Televisión',         'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="14" rx="2"/><path d="M8 20h8M12 18v2"/></svg>'],
            'descanso'    => ['label' => 'Área de descanso',  'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"/><path d="M3 11v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v2H7v-2a2 2 0 0 0-4 0z"/><path d="M5 18v2M19 18v2"/></svg>'],
            'ducha'       => ['label' => 'Ducha',              'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M4 4h2a2 2 0 0 1 2 2v2H4V4zM8 8a8 8 0 0 1 8 8"/><line x1="10" y1="16" x2="10.01" y2="16"/><line x1="14" y1="16" x2="14.01" y2="16"/><line x1="18" y1="16" x2="18.01" y2="16"/><line x1="10" y1="20" x2="10.01" y2="20"/><line x1="14" y1="20" x2="14.01" y2="20"/><line x1="18" y1="20" x2="18.01" y2="20"/></svg>'],
            'aseo'        => ['label' => 'Artículos de aseo', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8l-5-5z"/><path d="M9 3v5h9"/><path d="M7 13h10M7 17h6"/></svg>'],
            'albornoz'    => ['label' => 'Albornoz',           'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg>'],
            'secador'     => ['label' => 'Secador',            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 7h5l3 3-3 3H3V7z"/><path d="M8 10h13"/><path d="M18 7v6"/><path d="M15 5c0 1.66-1.34 3-3 3"/><path d="M15 15c0-1.66-1.34-3-3-3"/></svg>'],
            'parking'     => ['label' => 'Parking',            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 17V7h4a3 3 0 0 1 0 6H9"/></svg>'],
            'piscina'     => ['label' => 'Piscina',            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M2 12c.5-1 1.5-1 2-1s1.5 0 2 1 1.5 1 2 1 1.5 0 2-1 1.5-1 2-1 1.5 0 2 1 1.5 1 2 1 1.5 0 2-1"/><path d="M2 17c.5-1 1.5-1 2-1s1.5 0 2 1 1.5 1 2 1 1.5 0 2-1 1.5-1 2-1 1.5 0 2 1 1.5 1 2 1 1.5 0 2-1"/><path d="M4 4v5M8 4v5M12 4v5"/><circle cx="18" cy="5" r="2"/><path d="M20 7v2"/></svg>'],
            'wifi'        => ['label' => 'WiFi',               'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><circle cx="12" cy="20" r="1" fill="currentColor" stroke="none"/></svg>'],
        ];
        if (!empty($amenities)) : ?>
        <div class="hab-amenities reveal">
          <h3 class="hab-amenities__heading">Incluido en tu estancia</h3>
          <div class="hab-amenities__grid">
            <?php foreach ($amenities as $key) :
              $item = $amenity_map[$key] ?? null;
              if (!$item) continue;
            ?>
              <div class="hab-amenities__item">
                <div class="hab-amenities__icon"><?php echo $item['svg']; ?></div>
                <span class="hab-amenities__label"><?php echo esc_html($item['label']); ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </div><!-- /.hab-main -->


      <!-- ── RIGHT: Booking sidebar ── -->
      <aside class="hab-sidebar">
        <div class="hab-sidebar__card">

          <?php if ($price) : ?>
            <p class="hab-sidebar__from">desde</p>
            <p class="hab-sidebar__price"><?php echo esc_html($price); ?></p>
            <p class="hab-sidebar__per">por noche</p>
            <div class="hab-sidebar__divider"></div>
          <?php endif; ?>

          <div class="hab-engine">
            <?php if ($ohbe_id) : ?>
              <?php echo do_shortcode('[ohbe_search acco_id="' . esc_attr($ohbe_id) . '"]'); ?>
            <?php else : ?>
              <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold" style="width:100%;text-align:center;justify-content:center;">Reservar esta habitación</a>
            <?php endif; ?>
          </div>

          <div class="hab-sidebar__divider"></div>

          <div class="hab-sidebar__contact">
            <p>¿Tienes alguna pregunta?</p>
            <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>">
              <?php echo esc_html($phone); ?>
            </a>
            <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block;vertical-align:middle;margin-right:.35rem;color:var(--gold)"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.557 4.125 1.532 5.862L.054 23.25a.75.75 0 0 0 .917.917l5.388-1.478A11.956 11.956 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.91 0-3.72-.5-5.285-1.378l-.38-.218-3.94 1.08 1.08-3.94-.218-.38A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>WhatsApp
            </a>
          </div>

        </div>
      </aside>

    </div><!-- /.hab-layout -->
  </div><!-- /.container -->
</main>


<!-- ══════════ OTRAS HABITACIONES ══════════ -->
<?php
$other_query = new WP_Query([
  'post_type'      => 'habitacion',
  'posts_per_page' => 3,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
  'post__not_in'   => [get_the_ID()],
  'post_status'    => 'publish',
]);

if ($other_query->have_posts()) : ?>
<section class="other-rooms" aria-label="Otras habitaciones">
  <div class="container">
    <h2 class="other-rooms__title reveal">Otras habitaciones</h2>
    <div class="other-rooms__grid">
      <?php while ($other_query->have_posts()) : $other_query->the_post();
        $o_eyebrow = $has_acf ? get_field('hab_eyebrow') : '';
        $o_size    = $has_acf ? get_field('hab_size')    : '';
        $o_price   = $has_acf ? get_field('hab_price')   : '';
      ?>
        <a href="<?php the_permalink(); ?>" class="space-card reveal">
          <?php if (has_post_thumbnail()) : ?>
            <img class="space-card__img" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
          <?php else : ?>
            <div class="space-card__img s2"></div>
          <?php endif; ?>
          <div class="space-card__overlay">
            <?php if ($o_eyebrow) : ?>
              <span class="space-card__tag"><?php echo esc_html($o_eyebrow); ?></span>
            <?php endif; ?>
            <h3 class="space-card__name"><?php the_title(); ?></h3>
            <?php if ($o_size) : ?>
              <p class="space-card__size"><?php echo esc_html($o_size); ?></p>
            <?php endif; ?>
            <?php if ($o_price) : ?>
              <p class="space-card__price">desde <?php echo esc_html($o_price); ?></p>
            <?php endif; ?>
            <span class="space-card__cta">Ver habitación</span>
          </div>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>


<!-- ══════════ CTA BANNER ══════════ -->
<?php
$img_base_cta = get_template_directory_uri() . '/assets/img';
?>
<section class="cta-banner" aria-label="Reserva">
  <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url($img_base_cta); ?>/casa/aerea.jpg')"></div>
  <div class="container">
    <div class="cta-banner__content reveal">
      <span class="eyebrow" style="color:var(--gold-lt);">¿Listo para reservar?</span>
      <h2 class="cta-banner__title">Tu próxima escapada<br><em style="font-style:italic;color:var(--gold-lt);">a Vejer</em></h2>
      <p class="cta-banner__text">Confirmación inmediata · Cancelación flexible · Desayuno incluido</p>
      <div class="cta-banner__actions">
        <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold">Ver disponibilidad</a>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn--ghost">Contactar</a>
      </div>
    </div>
  </div>
</section>


<?php endwhile; endif; ?>


<script>
(function() {
  /* Gallery drag-scroll */
  var track = document.getElementById('habGalleryTrack');
  if (track) {
    var isDown = false, startX, scrollLeft;
    track.addEventListener('mousedown', function(e) {
      isDown = true; track.classList.add('dragging');
      startX = e.pageX - track.offsetLeft;
      scrollLeft = track.scrollLeft;
    });
    document.addEventListener('mouseup', function() { isDown = false; track.classList.remove('dragging'); });
    track.addEventListener('mousemove', function(e) {
      if (!isDown) return;
      e.preventDefault();
      var x = e.pageX - track.offsetLeft;
      track.scrollLeft = scrollLeft - (x - startX) * 1.4;
    });
  }

  /* Reveal on scroll */
  var reveals = document.querySelectorAll('.reveal');
  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.1 });
  reveals.forEach(function(el) { io.observe(el); });
})();
</script>

<?php get_footer(); ?>
