<?php
/**
 * Template Name: Reservas
 */
get_header();

$has_acf = function_exists('get_field');
$go      = fn($k) => $has_acf ? get_field($k, 'option') : null;
$img_base = get_template_directory_uri() . '/assets/img';

$phone  = $go('contact_phone')   ?: '+34 615 508 168';
$wa_raw = $go('social_whatsapp') ?: '34615508168';
$wa_url = 'https://wa.me/' . preg_replace('/\D/', '', $wa_raw);

// Habitaciones con sus acco_id
$rooms = [
    [
        'title'    => 'Suite del Torero',
        'tag'      => 'Suite',
        'price'    => 'Desde 165 €',
        'size'     => '50 m²',
        'capacity' => 'Hasta 4 personas',
        'img'      => $img_base . '/espacios/hab-slide-1.jpg',
        'acco_id'  => '16',
    ],
    [
        'title'    => 'Doble Superior',
        'tag'      => 'Habitación doble superior',
        'price'    => 'Desde 140 €',
        'size'     => '33 m²',
        'capacity' => 'Hasta 2 personas',
        'img'      => $img_base . '/espacios/doble-superior.jpg',
        'acco_id'  => '13',
    ],
    [
        'title'    => 'Habitación Doble',
        'tag'      => 'Habitación doble',
        'price'    => 'Desde 140 €',
        'size'     => '25 m²',
        'capacity' => 'Hasta 2 personas',
        'img'      => $img_base . '/espacios/habitacion-doble.jpg',
        'acco_id'  => '14',
    ],
    [
        'title'    => 'Apartamento Panorámico',
        'tag'      => 'Apartamento',
        'price'    => 'Desde 250 €',
        'size'     => '2 hab · Cocina · Salón',
        'capacity' => 'Hasta 6 personas',
        'img'      => $img_base . '/espacios/apartamento.jpg',
        'acco_id'  => '15',
    ],
];

// Si hay habitaciones como CPT las usamos en su lugar
$cpt_query = new WP_Query([
    'post_type'      => 'habitacion',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
$use_cpt = $cpt_query->have_posts();
?>

<style>
/* ── Reservas hero ── */
.reservas-hero {
  position: relative;
  background: var(--blue);
  padding: clamp(6rem,10vw,10rem) 0 clamp(4rem,6vw,6rem);
  text-align: center;
  overflow: hidden;
}
.reservas-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url('<?php echo esc_url($img_base); ?>/casa/piscina.jpg');
  background-size: cover;
  background-position: center 60%;
  opacity: .2;
}
.reservas-hero__inner { position: relative; z-index: 1; }
.reservas-hero .eyebrow { color: var(--gold-lt); display: block; margin-bottom: 1rem; }
.reservas-hero h1 {
  font-family: var(--serif);
  font-size: clamp(3rem,6vw,5rem);
  color: var(--white);
  font-weight: 300;
  margin-bottom: 1.25rem;
}
.reservas-hero p {
  color: rgba(255,255,255,.6);
  font-size: 1.0625rem;
  max-width: 50ch;
  margin-inline: auto;
  line-height: 1.75;
}

/* ── Motor general ── */
.reservas-engine-section {
  background: var(--cream);
  padding: clamp(3rem,5vw,5rem) 0;
  border-bottom: 1px solid var(--border);
}
.reservas-engine-section .container { max-width: 900px; }
.reservas-engine-section h2 {
  font-family: var(--serif);
  font-size: clamp(1.5rem,2.5vw,2.25rem);
  text-align: center;
  margin-bottom: .5rem;
}
.reservas-engine-section .section-sub {
  text-align: center;
  color: var(--muted);
  margin-bottom: 2.5rem;
  font-size: .9375rem;
}
.ohbe-wrap { background: var(--white); padding: clamp(2rem,4vw,3rem); border: 1px solid var(--border); }

/* ── Rooms grid ── */
.reservas-rooms { background: var(--white); padding: var(--py) 0; }
.reservas-rooms__header { text-align: center; margin-bottom: clamp(3rem,5vw,5rem); }
.reservas-rooms__header h2 { font-family: var(--serif); font-size: clamp(1.75rem,3vw,2.75rem); margin-bottom: .5rem; }
.reservas-rooms__header p { color: var(--muted); font-size: .9375rem; max-width: 52ch; margin-inline: auto; }

.res-room-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2px; }
.res-room-card { position: relative; background: var(--cream); display: flex; flex-direction: column; }
.res-room-card__img {
  width: 100%;
  aspect-ratio: 4/3;
  overflow: hidden;
}
.res-room-card__img img {
  width: 100%; height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .7s ease;
}
.res-room-card:hover .res-room-card__img img { transform: scale(1.04); }
.res-room-card__body { padding: 2rem 2rem 1.5rem; flex: 1; display: flex; flex-direction: column; }
.res-room-card__tag { font-size: .58rem; letter-spacing: .2em; text-transform: uppercase; color: var(--gold); font-weight: 600; margin-bottom: .6rem; }
.res-room-card__title { font-family: var(--serif); font-size: 1.5rem; margin-bottom: .75rem; }
.res-room-card__meta { display: flex; gap: 1.5rem; margin-bottom: 1.25rem; }
.res-room-card__meta span { font-size: .8rem; color: var(--muted); display: flex; align-items: center; gap: .35rem; }
.res-room-card__meta svg { width: 14px; height: 14px; stroke: var(--gold); fill: none; stroke-width: 1.5; flex-shrink: 0; }
.res-room-card__price { font-family: var(--sans); font-size: 1.1rem; font-weight: 600; color: var(--blue); margin-bottom: 1.5rem; }
.res-room-card__price small { font-weight: 400; color: var(--muted); font-size: .8rem; }
.res-room-card__engine { margin-top: auto; }
.res-room-card__engine .btn { width: 100%; text-align: center; margin-bottom: 1rem; }

/* ── Promise strip ── */
.reservas-promise { background: var(--blue); padding: clamp(3rem,5vw,5rem) 0; }
.reservas-promise__inner { display: grid; grid-template-columns: repeat(4,1fr); gap: 2rem; text-align: center; }
.promise-item__icon { width: 40px; height: 40px; margin: 0 auto 1rem; }
.promise-item__icon svg { width: 40px; height: 40px; stroke: var(--gold); fill: none; stroke-width: 1.2; }
.promise-item h4 { font-family: var(--serif); font-size: 1.1rem; color: var(--white); margin-bottom: .4rem; }
.promise-item p { font-size: .82rem; color: rgba(255,255,255,.55); line-height: 1.6; }

/* ── Contact CTA ── */
.reservas-contact { background: var(--cream); padding: clamp(3rem,5vw,5rem) 0; text-align: center; border-top: 1px solid var(--border); }
.reservas-contact h2 { font-family: var(--serif); font-size: clamp(1.5rem,2.5vw,2.25rem); margin-bottom: .75rem; }
.reservas-contact p { color: var(--muted); max-width: 48ch; margin: 0 auto 2rem; line-height: 1.7; }
.reservas-contact__actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

@media(max-width:768px) {
  .res-room-grid { grid-template-columns: 1fr; }
  .reservas-promise__inner { grid-template-columns: 1fr 1fr; }
}
@media(max-width:480px) {
  .reservas-promise__inner { grid-template-columns: 1fr; }
}
</style>

<!-- HERO -->
<section class="reservas-hero">
  <div class="container reservas-hero__inner">
    <span class="eyebrow">Reserva directa · Sin intermediarios</span>
    <h1>Reservar</h1>
    <p>Comprueba disponibilidad y reserva directamente con nosotros. Siempre obtendrás las mejores tarifas y condiciones.</p>
  </div>
</section>

<!-- MOTOR GENERAL -->
<section class="reservas-engine-section">
  <div class="container">
    <h2 class="reveal">Comprueba disponibilidad</h2>
    <p class="section-sub reveal">Busca entre todas nuestras estancias para las fechas que necesitas</p>
    <div class="ohbe-wrap reveal">
      <?php echo do_shortcode('[ohbe_search]'); ?>
    </div>
  </div>
</section>

<!-- HABITACIONES CON MOTOR INDIVIDUAL -->
<section class="reservas-rooms">
  <div class="container">
    <header class="reservas-rooms__header reveal">
      <span class="eyebrow">Nuestras estancias</span>
      <h2>Reserva una habitación concreta</h2>
      <p>Si ya sabes qué habitación quieres, resérvala directamente desde aquí.</p>
    </header>

    <div class="res-room-grid">
      <?php if ($use_cpt) :
        while ($cpt_query->have_posts()) : $cpt_query->the_post();
          $o_tag      = get_field('hab_eyebrow')  ?: '';
          $o_price    = get_field('hab_price')    ?: '';
          $o_size     = get_field('hab_size')     ?: '';
          $o_capacity = get_field('hab_capacity') ?: '';
          $o_ohbe     = get_field('hab_ohbe_id')  ?: '';
          $o_img      = get_the_post_thumbnail_url(null, 'space-card');
      ?>
        <div class="res-room-card reveal">
          <div class="res-room-card__img">
            <?php if ($o_img) : ?>
              <img src="<?php echo esc_url($o_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
            <?php endif; ?>
          </div>
          <div class="res-room-card__body">
            <?php if ($o_tag) : ?><p class="res-room-card__tag"><?php echo esc_html($o_tag); ?></p><?php endif; ?>
            <h3 class="res-room-card__title"><?php the_title(); ?></h3>
            <div class="res-room-card__meta">
              <?php if ($o_size) : ?>
                <span><svg viewBox="0 0 24 24"><path d="M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z"/></svg><?php echo esc_html($o_size); ?></span>
              <?php endif; ?>
              <?php if ($o_capacity) : ?>
                <span><svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0 1 13 0"/></svg><?php echo esc_html($o_capacity); ?></span>
              <?php endif; ?>
            </div>
            <?php if ($o_price) : ?>
              <p class="res-room-card__price"><?php echo esc_html($o_price); ?> <small>/ noche</small></p>
            <?php endif; ?>
            <div class="res-room-card__engine">
              <?php if ($o_ohbe) : ?>
                <?php echo do_shortcode('[ohbe_search acco_id="' . esc_attr($o_ohbe) . '"]'); ?>
              <?php else : ?>
                <a href="<?php the_permalink(); ?>" class="btn btn--gold">Ver habitación</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata();
      else :
        foreach ($rooms as $i => $room) :
          $delay = $i > 0 ? ' d' . $i : '';
      ?>
        <div class="res-room-card reveal<?php echo $delay; ?>">
          <div class="res-room-card__img">
            <img src="<?php echo esc_url($room['img']); ?>" alt="<?php echo esc_attr($room['title']); ?>" loading="lazy">
          </div>
          <div class="res-room-card__body">
            <p class="res-room-card__tag"><?php echo esc_html($room['tag']); ?></p>
            <h3 class="res-room-card__title"><?php echo esc_html($room['title']); ?></h3>
            <div class="res-room-card__meta">
              <span><svg viewBox="0 0 24 24"><path d="M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z"/></svg><?php echo esc_html($room['size']); ?></span>
              <span><svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0 1 13 0"/></svg><?php echo esc_html($room['capacity']); ?></span>
            </div>
            <p class="res-room-card__price"><?php echo esc_html($room['price']); ?> <small>/ noche</small></p>
            <div class="res-room-card__engine">
              <?php echo do_shortcode('[ohbe_search acco_id="' . esc_attr($room['acco_id']) . '"]'); ?>
            </div>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<!-- PROMISE STRIP -->
<section class="reservas-promise">
  <div class="container">
    <div class="reservas-promise__inner">
      <div class="promise-item reveal">
        <div class="promise-item__icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h4>Mejor precio garantizado</h4>
        <p>Reservando directamente obtienes siempre la mejor tarifa disponible</p>
      </div>
      <div class="promise-item reveal d1">
        <div class="promise-item__icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
        <h4>Confirmación inmediata</h4>
        <p>Recibirás la confirmación de tu reserva al instante por email</p>
      </div>
      <div class="promise-item reveal d2">
        <div class="promise-item__icon"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
        <h4>Atención personalizada</h4>
        <p>Nuestro equipo está disponible para cualquier necesidad especial</p>
      </div>
      <div class="promise-item reveal d3">
        <div class="promise-item__icon"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
        <h4>Sin cargos ocultos</h4>
        <p>El precio que ves es el precio final. Sin sorpresas al llegar</p>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT CTA -->
<section class="reservas-contact">
  <div class="container">
    <h2 class="reveal">¿Prefieres hablar con nosotros?</h2>
    <p class="reveal">Estamos encantados de ayudarte a elegir la mejor opción y preparar tu estancia a medida.</p>
    <div class="reservas-contact__actions reveal">
      <a href="<?php echo esc_url($wa_url); ?>" class="btn btn--gold" target="_blank" rel="noopener">
        WhatsApp
      </a>
      <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn--dark">Formulario de contacto</a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner" aria-label="Reserva tu estancia">
  <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/casa/aerea.jpg')"></div>
  <div class="container cta-banner__inner reveal">
    <span class="eyebrow">Reserva directa</span>
    <h2 class="cta-banner__title">¿Lista para vivir la experiencia?</h2>
    <div class="gold-rule"></div>
    <p class="cta-banner__text">Reserva tu estancia en La Casa del Torero. Directamente con nosotros, sin intermediarios y con las mejores condiciones.</p>
    <div class="cta-banner__actions">
      <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold">Ver disponibilidad</a>
      <a href="<?php echo esc_url(home_url('/habitaciones/')); ?>" class="btn btn--ghost">Ver habitaciones</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
