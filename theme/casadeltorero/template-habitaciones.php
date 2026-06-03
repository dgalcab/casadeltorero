<?php
/**
 * Template Name: Habitaciones
 *
 * Página /habitaciones/ — listado de todas las habitaciones.
 */
get_header(); ?>

<style>
/* ══ HABITACIONES PAGE ══════════════════════════════════════ */

/* ── Hero ── */
.habs-hero {
  position: relative;
  min-height: clamp(420px, 55vw, 600px);
  display: flex;
  align-items: flex-end;
  justify-content: center;
  text-align: center;
  overflow: hidden;
  background: var(--blue);
  padding-bottom: clamp(3.5rem, 6vw, 6rem);
  padding-top: clamp(7rem, 12vw, 10rem);
}
.habs-hero__bg {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  opacity: .2;
}
.habs-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at center bottom, rgba(184,150,90,.12) 0%, transparent 65%);
  pointer-events: none;
  z-index: 1;
}
.habs-hero__content {
  position: relative;
  z-index: 2;
  color: var(--white);
  padding-inline: 1.5rem;
  max-width: 720px;
}
.habs-hero__eyebrow {
  font-family: var(--sans);
  font-size: .6875rem;
  font-weight: 500;
  letter-spacing: .26em;
  text-transform: uppercase;
  color: var(--gold-lt);
  display: block;
  margin-bottom: 1.25rem;
}
.habs-hero__title {
  font-family: var(--serif);
  font-size: clamp(2.75rem, 6vw, 5.5rem);
  font-weight: 300;
  line-height: 1.05;
  letter-spacing: -.02em;
  color: var(--white);
  margin-bottom: 1.25rem;
}
.habs-hero__subtitle {
  font-size: clamp(.9375rem, 1.5vw, 1.0625rem);
  color: rgba(255,255,255,.7);
  max-width: 52ch;
  margin-inline: auto;
  line-height: 1.8;
}
.habs-hero .gold-rule { margin-top: 1.75rem; }

/* ── Intro ── */
.habs-intro {
  padding: clamp(3.5rem, 6vw, 6rem) 0;
  background: var(--cream);
  text-align: center;
}
.habs-intro__body {
  max-width: 680px;
  margin-inline: auto;
  font-family: var(--serif);
  font-size: 1.175rem;
  color: var(--muted);
  line-height: 1.85;
}
.habs-intro__body p { margin-bottom: 1rem; }
.habs-intro__body p:last-child { margin-bottom: 0; }
.habs-intro__modalities {
  display: flex;
  justify-content: center;
  gap: 3rem;
  margin-top: 2.25rem;
  flex-wrap: wrap;
}
.habs-intro__mod {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: .4rem;
}
.habs-intro__mod-label {
  font-family: var(--sans);
  font-size: .6rem;
  letter-spacing: .22em;
  text-transform: uppercase;
  color: var(--gold);
}
.habs-intro__mod-value {
  font-family: var(--serif);
  font-size: 1.15rem;
  color: var(--text);
}

/* ── Grid ── */
.habs-grid {
  background: var(--cream);
  padding-bottom: 0;
}
.habs-grid__inner {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.5px;
}

/* Mobile scroll-snap — same as home spaces grid */
@media(max-width: 768px) {
  .habs-grid__inner {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
    gap: 1.5px;
    cursor: grab;
    padding-right: 18vw;
  }
  .habs-grid__inner::-webkit-scrollbar { display: none; }
  .habs-grid__inner.dragging { cursor: grabbing; scroll-snap-type: none; }
  .habs-grid__inner .space-card { flex: 0 0 72vw; scroll-snap-align: start; }
  .habs-grid__inner .space-card__img { aspect-ratio: 3/4; }
}

/* ── "Alquiler completo" split section ── */
.habs-completo {
  background: var(--white);
  padding: clamp(4rem, 8vw, 8rem) 0;
}
.habs-completo__inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(3rem, 6vw, 7rem);
  align-items: center;
}
.habs-completo__img-wrap {
  overflow: hidden;
}
.habs-completo__img {
  width: 100%;
  aspect-ratio: 4/3;
  object-fit: cover;
  display: block;
  transition: transform .8s ease;
}
.habs-completo__img-wrap:hover .habs-completo__img {
  transform: scale(1.03);
}
.habs-completo__content .eyebrow { color: var(--gold); }
.habs-completo__title {
  font-family: var(--serif);
  font-size: clamp(2rem, 3.5vw, 3rem);
  color: var(--text);
  margin-bottom: 1.25rem;
  line-height: 1.1;
}
.habs-completo__text {
  font-size: 1.0625rem;
  color: var(--muted);
  line-height: 1.85;
  margin-bottom: 1.5rem;
}
.habs-completo__price {
  font-family: var(--serif);
  font-size: 2rem;
  color: var(--blue);
  line-height: 1;
  margin-bottom: 1.75rem;
}
.habs-completo__price span {
  font-family: var(--sans);
  font-size: .85rem;
  font-weight: 400;
  color: var(--muted);
  margin-left: .4rem;
}

@media(max-width: 768px) {
  .habs-completo__inner { grid-template-columns: 1fr; }
}
</style>

<?php
$has_acf  = function_exists('get_field');
$img_base = get_template_directory_uri() . '/assets/img';
?>

<!-- ══════════ HERO ══════════ -->
<section class="habs-hero" aria-label="Las Habitaciones de La Casa del Torero">
  <div class="habs-hero__bg" style="background-image:url('<?php echo esc_url($img_base); ?>/espacios/hab-slide-1.jpg')"></div>
  <div class="habs-hero__content reveal">
    <span class="habs-hero__eyebrow">Nuestras estancias</span>
    <h1 class="habs-hero__title">Las Habitaciones</h1>
    <p class="habs-hero__subtitle">Cuatro espacios únicos, cada uno con su propio carácter. Todas con terraza privada, vistas a Vejer y acceso al campo.</p>
    <div class="gold-rule"></div>
  </div>
</section>


<!-- ══════════ INTRO ══════════ -->
<section class="habs-intro" aria-label="Modalidades de alojamiento">
  <div class="container">
    <div class="habs-intro__body reveal">
      <p>Cada habitación es un mundo propio: desde la amplitud de la Suite con cama extragrande y bañera exenta, hasta la intimidad del Apartamento con cocina independiente y entrada privada. Todas comparten el mismo cuidado en el detalle, el silencio de la finca y las vistas al campo andaluz.</p>
      <p>Puedes reservar <strong>habitaciones sueltas en régimen B&B</strong> o, si vuestro grupo llega a 8 personas, optar por el <strong>alquiler completo de la casa</strong> con todos los servicios incluidos.</p>
    </div>

    <div class="habs-intro__modalities reveal d1">
      <div class="habs-intro__mod">
        <span class="habs-intro__mod-label">Modalidad</span>
        <span class="habs-intro__mod-value">B&amp;B por habitación</span>
      </div>
      <div class="habs-intro__mod" style="border-left:1px solid var(--border); padding-left:3rem;">
        <span class="habs-intro__mod-label">Modalidad</span>
        <span class="habs-intro__mod-value">Alquiler completo</span>
      </div>
    </div>
  </div>
</section>


<!-- ══════════ GRID DE HABITACIONES ══════════ -->
<section class="habs-grid" aria-label="Nuestras habitaciones">

  <?php
  /* ── Fallback rooms for when no CPT posts exist ── */
  $fallback_rooms = [
    [
      'title'   => 'Suite Principal',
      'eyebrow' => 'Suite',
      'size'    => '65 m²',
      'price'   => 'Desde 195 €',
      'slug'    => 'suite-principal',
      'img'     => $img_base . '/espacios/suite-principal.jpg',
    ],
    [
      'title'   => 'Doble Superior',
      'eyebrow' => 'Doble Superior',
      'size'    => '40 m²',
      'price'   => 'Desde 145 €',
      'slug'    => 'doble-superior',
      'img'     => $img_base . '/espacios/doble-superior.jpg',
    ],
    [
      'title'   => 'Doble Clásica',
      'eyebrow' => 'Doble',
      'size'    => '30 m²',
      'price'   => 'Desde 115 €',
      'slug'    => 'doble',
      'img'     => $img_base . '/espacios/doble.jpg',
    ],
    [
      'title'   => 'Apartamento',
      'eyebrow' => 'Apartamento',
      'size'    => '55 m²',
      'price'   => 'Desde 165 €',
      'slug'    => 'apartamento',
      'img'     => $img_base . '/espacios/apartamento.jpg',
    ],
  ];

  $hab_query = new WP_Query([
    'post_type'      => 'habitacion',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
  ]);

  $use_cpt = $hab_query->have_posts();
  ?>

  <div class="habs-grid__inner" id="habsGrid">

    <?php if ($use_cpt) :
      while ($hab_query->have_posts()) : $hab_query->the_post();
        $h_eyebrow = $has_acf ? get_field('hab_eyebrow') : '';
        $h_size    = $has_acf ? get_field('hab_size')    : '';
        $h_price   = $has_acf ? get_field('hab_price')   : '';
    ?>
      <a href="<?php the_permalink(); ?>" class="space-card">
        <?php if (has_post_thumbnail()) : ?>
          <img class="space-card__img" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
        <?php else : ?>
          <div class="space-card__img s1"></div>
        <?php endif; ?>
        <div class="space-card__overlay">
          <?php if ($h_eyebrow) : ?>
            <span class="space-card__tag"><?php echo esc_html($h_eyebrow); ?></span>
          <?php endif; ?>
          <h2 class="space-card__name"><?php the_title(); ?></h2>
          <?php if ($h_size) : ?>
            <p class="space-card__size"><?php echo esc_html($h_size); ?></p>
          <?php endif; ?>
          <?php if ($h_price) : ?>
            <p class="space-card__price">desde <?php echo esc_html($h_price); ?></p>
          <?php endif; ?>
          <span class="space-card__cta">Ver habitación</span>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata();

    else :
      foreach ($fallback_rooms as $room) : ?>
        <a href="<?php echo esc_url(home_url('/habitaciones/' . $room['slug'] . '/')); ?>" class="space-card">
          <img class="space-card__img" src="<?php echo esc_url($room['img']); ?>" alt="<?php echo esc_attr($room['title']); ?>" loading="lazy">
          <div class="space-card__overlay">
            <span class="space-card__tag"><?php echo esc_html($room['eyebrow']); ?></span>
            <h2 class="space-card__name"><?php echo esc_html($room['title']); ?></h2>
            <p class="space-card__size"><?php echo esc_html($room['size']); ?></p>
            <p class="space-card__price"><?php echo esc_html($room['price']); ?></p>
            <span class="space-card__cta">Ver habitación</span>
          </div>
        </a>
      <?php endforeach;
    endif; ?>

  </div><!-- /.habs-grid__inner -->
</section>


<!-- ══════════ ALQUILER COMPLETO ══════════ -->
<section class="habs-completo" aria-label="Alquiler completo de la casa">
  <div class="container">
    <div class="habs-completo__inner">

      <div class="habs-completo__img-wrap reveal">
        <img
          class="habs-completo__img"
          src="<?php echo esc_url($img_base); ?>/casa/piscina.jpg"
          alt="Piscina de La Casa del Torero con vistas al campo"
          loading="lazy"
        >
      </div>

      <div class="habs-completo__content reveal d1">
        <span class="eyebrow">Para grupos y eventos</span>
        <h2 class="habs-completo__title">¿Prefieres la casa completa?</h2>
        <p class="habs-completo__text">
          Si sois un grupo de 8 o más personas, podéis alquilar La Casa del Torero en exclusiva: las cuatro habitaciones, los espacios comunes, la piscina y el jardín solo para vosotros. Perfecto para celebraciones, retiros o simplemente para disfrutar de la finca sin interrupciones.
        </p>
        <p class="habs-completo__text">
          El precio incluye desayuno, limpieza diaria y la atención personalizada del equipo de la casa.
        </p>
        <p class="habs-completo__price">
          Desde 50 €<span>/ persona · noche</span>
        </p>
        <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold">Consultar disponibilidad</a>
      </div>

    </div>
  </div>
</section>


<!-- ══════════ CTA BANNER ══════════ -->
<section class="cta-banner" aria-label="Reserva tu estancia">
  <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url($img_base); ?>/casa/aerea.jpg')"></div>
  <div class="container">
    <div class="cta-banner__content reveal">
      <span class="eyebrow" style="color:var(--gold-lt);">La Casa del Torero · Vejer de la Frontera</span>
      <h2 class="cta-banner__title">Tu estancia perfecta<br><em style="font-style:italic;color:var(--gold-lt);">te espera</em></h2>
      <p class="cta-banner__text">Reserva con antelación para asegurar tu habitación. Confirmación inmediata, cancelación flexible.</p>
      <div class="cta-banner__actions">
        <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold">Ver disponibilidad</a>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn--ghost">Contactar</a>
      </div>
    </div>
  </div>
</section>


<script>
(function() {
  /* Drag-to-scroll for habs grid */
  var grid = document.getElementById('habsGrid');
  if (!grid) return;
  var isDown = false, startX, scrollLeft;
  grid.addEventListener('mousedown', function(e) {
    isDown = true; grid.classList.add('dragging');
    startX = e.pageX - grid.offsetLeft;
    scrollLeft = grid.scrollLeft;
  });
  document.addEventListener('mouseup', function() { isDown = false; grid.classList.remove('dragging'); });
  grid.addEventListener('mousemove', function(e) {
    if (!isDown) return;
    e.preventDefault();
    var x = e.pageX - grid.offsetLeft;
    grid.scrollLeft = scrollLeft - (x - startX) * 1.4;
  });

  /* Reveal on scroll */
  var reveals = document.querySelectorAll('.reveal');
  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
  }, { threshold: 0.12 });
  reveals.forEach(function(el) { io.observe(el); });
})();
</script>

<?php get_footer(); ?>
