<?php get_header(); ?>

<?php
$has_acf = function_exists('get_field');
$img_base = get_template_directory_uri() . '/assets/img';

// Helper
$gf = fn($k) => $has_acf ? get_field($k) : null;
$go = fn($k) => $has_acf ? get_field($k, 'option') : null;
?>

<!-- ══════════ HERO ══════════ -->
<?php
$hero_video     = $gf('hero_video');
$hero_eyebrow   = $gf('hero_eyebrow')   ?: 'Casa Rural · Hotel Boutique · Vejer, Cádiz';
$hero_title     = $gf('hero_title')     ?: 'La Casa del Torero';
$hero_subtitle  = $gf('hero_subtitle')  ?: 'Una finca histórica de 24 hectáreas entre olivos centenarios, a 11 km de las playas vírgenes de la Costa de la Luz.';
$hero_cta1_text = $gf('hero_cta1_text') ?: 'Reservar habitación';
$hero_cta1_url  = $gf('hero_cta1_url')  ?: '#habitaciones';
$hero_cta2_text = $gf('hero_cta2_text') ?: 'Alquilar la casa completa';
$hero_cta2_url  = $gf('hero_cta2_url')  ?: '#casa-completa';
$badge_title    = $gf('hero_badge_title') ?: 'Marruecos visible';
$badge_text     = $gf('hero_badge_text')  ?: 'en días despejados';
?>
<section class="hero" aria-label="La Casa del Torero, Vejer de la Frontera">
  <div class="hero__video-wrap">
    <?php if ($hero_video) : ?>
    <video autoplay muted loop playsinline aria-hidden="true" preload="auto">
      <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
    </video>
    <?php endif; ?>
  </div>
  <div class="hero__overlay"></div>
  <div class="hero__deco" aria-hidden="true"></div>
  <div class="hero__content">
    <span class="hero__eyebrow"><?php echo esc_html($hero_eyebrow); ?></span>
    <h1 class="hero__title"><?php echo nl2br(esc_html($hero_title)); ?></h1>
    <p class="hero__subtitle"><?php echo esc_html($hero_subtitle); ?></p>
    <div class="hero__actions">
      <a href="<?php echo esc_url($hero_cta1_url); ?>" class="btn btn--gold"><?php echo esc_html($hero_cta1_text); ?></a>
      <a href="<?php echo esc_url($hero_cta2_url); ?>" class="btn btn--ghost"><?php echo esc_html($hero_cta2_text); ?></a>
    </div>
  </div>
  <div class="hero__badge" aria-label="En días despejados se ve Marruecos">
    <strong><?php echo esc_html($badge_title); ?></strong>
    <?php echo esc_html($badge_text); ?>
  </div>
  <div class="hero__scroll" aria-hidden="true">Descubrir</div>
</section>


<!-- ══════════ PRESTIGE BAR ══════════ -->
<?php
$prestige_items = $go('prestige_items');
$default_prestige = [
    ['name' => 'Rusticae',           'url' => 'https://www.rusticae.com/hotel/la-casa-del-torero-10850',                                                          'logo' => $img_base . '/Rusticae-logo.svg',                    'text_only' => false],
    ['name' => 'Condé Nast Traveler','url' => 'https://www.traveler.es/naturaleza/galerias/las-mejores-casas-rurales-para-pasar-el-verano-con-piscina-vistas/2660','logo' => $img_base . '/conde-nast-traveler.svg',              'text_only' => false],
    ['name' => 'Secret Places',      'url' => 'https://www.secretplaces.com/vejer-de-la-frontera-boutique-hotels/la-casa-del-torero',                             'logo' => $img_base . '/secretplaces-logo-white.svg',          'text_only' => false],
    ['name' => 'Cosy Places',        'url' => 'https://cosy-places.com/la-casa-del-torero/',                                                                      'logo' => $img_base . '/Cosy-Places-Worldwide-white-long.svg', 'text_only' => false],
    ['name' => 'The Hotel Guru',     'url' => 'https://www.thehotelguru.com/best-hotels-in/spain/vejer-de-la-frontera',                                           'logo' => $img_base . '/logo_es.svg',                          'text_only' => false],
    ['name' => 'Further Afield',     'url' => 'https://www.furtherafield.com/properties/la-casa-del-torerovejer-de-la-frontera-andalucia/',                       'logo' => '',                                                  'text_only' => true],
    ['name' => 'Gay Séjour',         'url' => 'https://www.gay-sejour.com/en/a-10039/la-casa-del-torero--vejer-de-la-frontera.html',                              'logo' => '',                                                  'text_only' => true],
];
?>
<div class="prestige-bar">
  <div class="prestige-bar__track" id="prestigeTrack">
    <div class="prestige-item">
      <span class="prestige-bar__label">Seleccionados por</span>
    </div>
    <?php if ($prestige_items && is_array($prestige_items)) :
        foreach ($prestige_items as $item) :
            $p_name  = esc_html($item['prestige_name'] ?? '');
            $p_url   = esc_url($item['prestige_url']  ?? '#');
            $p_logo  = $item['prestige_logo'] ?? null;
            $p_text  = !empty($item['prestige_text_only']);
    ?>
        <a href="<?php echo $p_url; ?>" target="_blank" rel="noopener" class="prestige-item" aria-label="<?php echo $p_name; ?>">
          <?php if (!$p_text && $p_logo) : ?>
            <img src="<?php echo esc_url(is_array($p_logo) ? $p_logo['url'] : $p_logo); ?>" alt="<?php echo $p_name; ?>" loading="lazy">
          <?php else : ?>
            <span class="prestige-item__text"><?php echo $p_name; ?></span>
          <?php endif; ?>
        </a>
    <?php endforeach;
    else :
        foreach ($default_prestige as $item) : ?>
        <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener" class="prestige-item" aria-label="<?php echo esc_attr($item['name']); ?>">
          <?php if (!$item['text_only'] && $item['logo']) : ?>
            <img src="<?php echo esc_url($item['logo']); ?>" alt="<?php echo esc_attr($item['name']); ?>" loading="lazy">
          <?php else : ?>
            <span class="prestige-item__text"><?php echo esc_html($item['name']); ?></span>
          <?php endif; ?>
        </a>
    <?php endforeach;
    endif; ?>
  </div>
</div>


<!-- ══════════ INTRO STRIP ══════════ -->
<?php
$i1l = $gf('intro_item_1_label') ?: 'Finca';
$i1v = $gf('intro_item_1_value') ?: '24 hectáreas';
$i2l = $gf('intro_item_2_label') ?: 'Playas';
$i2v = $gf('intro_item_2_value') ?: '11 km · Costa de la Luz';
$i3l = $gf('intro_item_3_label') ?: 'Modalidades';
$i3v = $gf('intro_item_3_value') ?: 'Por habitación · Casa completa';
$i4l = $gf('intro_item_4_label') ?: 'Ubicación';
$i4v = $gf('intro_item_4_value') ?: 'Vejer de la Frontera, Cádiz';
?>
<div class="intro-strip">
  <div class="container">
    <div class="intro-strip__inner">
      <div class="intro-strip__item"><p class="intro-strip__label"><?php echo esc_html($i1l); ?></p><p class="intro-strip__value"><?php echo esc_html($i1v); ?></p></div>
      <div class="intro-strip__item"><p class="intro-strip__label"><?php echo esc_html($i2l); ?></p><p class="intro-strip__value"><?php echo esc_html($i2v); ?></p></div>
      <div class="intro-strip__item"><p class="intro-strip__label"><?php echo esc_html($i3l); ?></p><p class="intro-strip__value"><?php echo esc_html($i3v); ?></p></div>
      <div class="intro-strip__item"><p class="intro-strip__label"><?php echo esc_html($i4l); ?></p><p class="intro-strip__value"><?php echo esc_html($i4v); ?></p></div>
    </div>
  </div>
</div>


<!-- ══════════ MODALITY ══════════ -->
<?php
$mod_title = $gf('modality_title') ?: '¿Cómo quieres vivirlo?';
$mod_sub   = $gf('modality_subtitle') ?: 'La Casa del Torero se puede reservar por habitaciones o en exclusiva. Dos experiencias distintas, la misma magia.';
$rooms_price = $gf('modality_rooms_price') ?: 'Desde 140 €';
$house_price = $gf('modality_house_price') ?: 'Desde 50 €';

$rooms_feats_raw = $gf('modality_rooms_features');
$house_feats_raw = $gf('modality_house_features');

$rooms_feats = $rooms_feats_raw
    ? array_filter(array_map('trim', explode("\n", $rooms_feats_raw)))
    : ['Desayuno continental incluido', 'Piscina y jardines', 'Acceso a 24 ha de campo', '4 habitaciones disponibles', 'Confirmación inmediata'];

$house_feats = $house_feats_raw
    ? array_filter(array_map('trim', explode("\n", $house_feats_raw)))
    : ['Exclusividad total · solo vuestro grupo', '4 habitaciones + apartamento', 'Cocina, salones y terraza privados', 'Piscina y plaza de tentación', 'Ideal para bodas, eventos y retiros'];
?>
<section id="casa-completa" class="modality">
  <div class="container">
    <header class="modality__header reveal">
      <span class="eyebrow">Dos formas de disfrutarla</span>
      <h2 class="section-title"><?php echo esc_html($mod_title); ?></h2>
      <div class="gold-rule"></div>
      <p><?php echo esc_html($mod_sub); ?></p>
    </header>
    <div class="modality__grid">

      <div class="modality-card modality-card--rooms reveal">
        <svg class="modality-card__icon" viewBox="0 0 48 48" fill="none" stroke="var(--gold)" stroke-width="1.5" stroke-linecap="round">
          <rect x="6" y="20" width="36" height="22" rx="1"/><path d="M6 26h36M16 26v16M32 26v16M2 20l22-14 22 14"/>
        </svg>
        <div>
          <span style="font-size:.6rem;letter-spacing:.22em;text-transform:uppercase;color:var(--gold);font-family:var(--sans);font-weight:600;">B&amp;B · Por habitaciones</span>
          <h3 class="modality-card__title">Reserva tu habitación</h3>
        </div>
        <p class="modality-card__price"><?php echo esc_html($rooms_price); ?> <span>/ habitación / noche</span></p>
        <p class="modality-card__desc">Disfruta de La Casa del Torero a tu ritmo. Cada habitación incluye desayuno continental, acceso a todas las zonas comunes, piscina y los 24 km de campo de la finca.</p>
        <ul class="modality-card__features">
          <?php foreach ($rooms_feats as $feat) : ?>
            <li class="modality-card__feat"><?php echo esc_html($feat); ?></li>
          <?php endforeach; ?>
        </ul>
        <div class="modality-card__actions">
          <a href="#habitaciones" class="btn btn--gold">Ver habitaciones y reservar</a>
        </div>
      </div>

      <div class="modality-card modality-card--house reveal d1">
        <svg class="modality-card__icon" viewBox="0 0 48 48" fill="none" stroke="var(--blue)" stroke-width="1.5" stroke-linecap="round">
          <path d="M6 42V20L24 6l18 14v22H6z"/><path d="M16 42V28h16v14M24 6v6"/>
        </svg>
        <div>
          <span style="font-size:.6rem;letter-spacing:.22em;text-transform:uppercase;color:var(--blue);font-family:var(--sans);font-weight:600;">Alquiler completo · Exclusiva</span>
          <h3 class="modality-card__title">Alquila la casa entera</h3>
        </div>
        <p class="modality-card__price" style="color:var(--blue);"><?php echo esc_html($house_price); ?><span> / persona · mín. 10 personas</span></p>
        <p class="modality-card__desc">La finca es vuestra. Celebrad una boda, un cumpleaños, un retiro corporativo o una escapada familiar con total privacidad. Sin más huéspedes. Sin horarios.</p>
        <ul class="modality-card__features">
          <?php foreach ($house_feats as $feat) : ?>
            <li class="modality-card__feat"><?php echo esc_html($feat); ?></li>
          <?php endforeach; ?>
        </ul>
        <div class="modality-card__actions">
          <a href="mailto:<?php echo esc_attr(function_exists('get_field') ? (get_field('contact_email','option') ?: 'info@lacasadeltorero.com') : 'info@lacasadeltorero.com'); ?>" class="btn btn--dark">Solicitar presupuesto</a>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ══════════ SPACES / HABITACIONES ══════════ -->
<section id="habitaciones" class="spaces">
  <div class="container">
    <header class="spaces__header reveal">
      <span class="eyebrow">Las Habitaciones</span>
      <h2 class="section-title">Cuatro estancias, cada una única</h2>
      <div class="gold-rule"></div>
      <p class="section-body" style="margin-top:1.5rem">Todas con terraza propia, vistas al pueblo blanco de Vejer y acceso privado al campo. Desayuno continental incluido.</p>
    </header>
  </div>

  <?php
  $hab_query = new WP_Query([
      'post_type'      => 'habitacion',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC',
  ]);
  $has_hab = $hab_query->have_posts();
  ?>

  <div class="spaces__grid">
    <?php if ($has_hab) :
        $delay_classes = ['', 'd1', 'd2', 'd3'];
        $idx = 0;
        while ($hab_query->have_posts()) : $hab_query->the_post();
            $dc       = $delay_classes[$idx % 4] ?? '';
            $hab_img  = get_the_post_thumbnail_url(get_the_ID(), 'space-card');
            $hab_tag  = $has_acf ? get_field('hab_eyebrow')  : '';
            $hab_size = $has_acf ? get_field('hab_size')     : '';
            $hab_cap  = $has_acf ? get_field('hab_capacity') : '';
            $hab_price= $has_acf ? get_field('hab_price')    : '';
            $hab_url  = get_permalink();
    ?>
        <div class="space-card reveal <?php echo esc_attr($dc); ?>">
          <div class="space-card__img s<?php echo ($idx % 3) + 1; ?>">
            <?php if ($hab_img) : ?>
              <img loading="lazy" src="<?php echo esc_url($hab_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php endif; ?>
          </div>
          <div class="space-card__overlay">
            <?php if ($hab_tag) : ?><span class="space-card__tag"><?php echo esc_html($hab_tag); ?></span><?php endif; ?>
            <h3 class="space-card__name"><?php the_title(); ?></h3>
            <?php if ($hab_size || $hab_cap) : ?>
              <p class="space-card__size"><?php echo esc_html(trim($hab_size . ($hab_cap ? ' · ' . $hab_cap : ''))); ?></p>
            <?php endif; ?>
            <?php if ($hab_price) : ?><p class="space-card__price"><?php echo esc_html($hab_price); ?></p><?php endif; ?>
            <p class="space-card__desc"><?php echo esc_html(get_the_excerpt()); ?></p>
            <a href="<?php echo esc_url($hab_url); ?>" class="space-card__cta">Ver habitación</a>
          </div>
        </div>
    <?php $idx++; endwhile; wp_reset_postdata();
    else : // fallback hardcoded 4 rooms
    ?>
        <div class="space-card reveal">
          <div class="space-card__img s3">
            <img loading="lazy" src="<?php echo esc_url($img_base . '/espacios/hab-slide-1.jpg'); ?>" alt="Suite del Torero" style="width:100%;height:100%;object-fit:cover;display:block;">
          </div>
          <div class="space-card__overlay">
            <span class="space-card__tag">Suite</span>
            <h3 class="space-card__name">Suite del Torero</h3>
            <p class="space-card__size">50 m² · Hasta 4 personas</p>
            <p class="space-card__price">Desde 165 € / noche</p>
            <p class="space-card__desc">Gran cuarto de baño. Terrazas con vistas a Vejer. Acceso directo al campo.</p>
            <a href="<?php echo esc_url(home_url('/habitaciones/')); ?>" class="space-card__cta">Ver habitación</a>
          </div>
        </div>
        <div class="space-card reveal d1">
          <div class="space-card__img s2">
            <img loading="lazy" src="<?php echo esc_url($img_base . '/espacios/doble-superior.jpg'); ?>" alt="Doble Superior" style="width:100%;height:100%;object-fit:cover;display:block;">
          </div>
          <div class="space-card__overlay">
            <span class="space-card__tag">Habitación doble superior</span>
            <h3 class="space-card__name">Doble Superior</h3>
            <p class="space-card__size">33 m² · Hasta 2 personas</p>
            <p class="space-card__price">Desde 140 € / noche</p>
            <p class="space-card__desc">Amplio cuarto de baño. Terraza con vista a Vejer. Acceso al campo.</p>
            <a href="<?php echo esc_url(home_url('/habitaciones/')); ?>" class="space-card__cta">Ver habitación</a>
          </div>
        </div>
        <div class="space-card reveal d2">
          <div class="space-card__img s1">
            <img loading="lazy" src="<?php echo esc_url($img_base . '/espacios/habitacion-doble.jpg'); ?>" alt="Habitación Doble" style="width:100%;height:100%;object-fit:cover;display:block;">
          </div>
          <div class="space-card__overlay">
            <span class="space-card__tag">Habitación doble</span>
            <h3 class="space-card__name">Habitación Doble</h3>
            <p class="space-card__size">25 m² · Hasta 2 personas</p>
            <p class="space-card__price">Desde 140 € / noche</p>
            <p class="space-card__desc">Amplio cuarto de baño. Terraza con vista a Vejer. Acceso al campo.</p>
            <a href="<?php echo esc_url(home_url('/habitaciones/')); ?>" class="space-card__cta">Ver habitación</a>
          </div>
        </div>
        <div class="space-card reveal d3">
          <div class="space-card__img" style="background:linear-gradient(145deg,#1e2a3a,#0d1520);">
            <img loading="lazy" src="<?php echo esc_url($img_base . '/espacios/apartamento.jpg'); ?>" alt="Apartamento panorámico" style="width:100%;height:100%;object-fit:cover;display:block;">
          </div>
          <div class="space-card__overlay">
            <span class="space-card__tag">Apartamento</span>
            <h3 class="space-card__name">Apartamento Panorámico</h3>
            <p class="space-card__size">2 habitaciones · Cocina · Salón</p>
            <p class="space-card__price">Desde 250 € / noche</p>
            <p class="space-card__desc">Cocina equipada, salón de estar y vistas panorámicas. Máxima independencia.</p>
            <a href="<?php echo esc_url(home_url('/habitaciones/')); ?>" class="space-card__cta">Ver habitación</a>
          </div>
        </div>
    <?php endif; ?>
  </div>
</section>


<!-- ══════════ ABOUT — LA CASA ══════════ -->
<?php
$about_eyebrow     = $gf('about_eyebrow')     ?: 'La Casa';
$about_title       = $gf('about_title')       ?: 'Un enclave único entre el pueblo blanco y el campo andaluz';
$about_text_1      = $gf('about_text_1')      ?: '<p>La Casa del Torero es una finca de 24 hectáreas diseñada por y para un torero, siguiendo el modelo de una ganadería de reses bravas donde aún hoy siguen en uso sus instalaciones: corrales, plaza de tentación con su típica palco y burladero.</p>';
$about_text_2      = $gf('about_text_2')      ?: '<p>Situada en una de las colinas frente al pueblo blanco de Vejer, la casa ofrece unas vistas privilegiadas sobre la Laguna de La Janda, las marismas de Barbate y, en días despejados, la costa de Marruecos al otro lado del Estrecho.</p>';
$about_image_main  = $gf('about_image_main');
$about_image_accent= $gf('about_image_accent');
?>
<section id="la-casa" class="about">
  <div class="container">
    <div class="about__inner">

      <div class="about__image-wrap reveal">
        <div class="about__image-main">
          <?php if ($about_image_main) : ?>
            <img loading="lazy" src="<?php echo esc_url($about_image_main['url']); ?>" alt="<?php echo esc_attr($about_image_main['alt'] ?? ''); ?>" style="width:100%;height:100%;object-fit:cover;">
          <?php else : ?>
            <img loading="lazy" src="<?php echo esc_url($img_base . '/casa/piscina.jpg'); ?>" alt="Piscina exterior de La Casa del Torero" style="width:100%;height:100%;object-fit:cover;">
          <?php endif; ?>
        </div>
        <div class="about__image-accent">
          <?php if ($about_image_accent) : ?>
            <img loading="lazy" src="<?php echo esc_url($about_image_accent['url']); ?>" alt="<?php echo esc_attr($about_image_accent['alt'] ?? ''); ?>" style="width:100%;height:100%;object-fit:cover;">
          <?php else : ?>
            <img loading="lazy" src="<?php echo esc_url($img_base . '/galeria/g03.jpg'); ?>" alt="Salón con chimenea" style="width:100%;height:100%;object-fit:cover;">
          <?php endif; ?>
        </div>
      </div>

      <div class="about__content reveal d1">
        <span class="eyebrow"><?php echo esc_html($about_eyebrow); ?></span>
        <h2 class="about__title"><?php echo esc_html($about_title); ?></h2>
        <div class="about__text"><?php echo wp_kses_post($about_text_1); ?></div>
        <div class="about__text"><?php echo wp_kses_post($about_text_2); ?></div>

        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
          <div class="about__detail-text">
            <strong>Arquitectura tradicional andaluza rehabilitada</strong>
            <span>Encanto moderno y andaluz que acompaña cada rincón iluminado y colorido</span>
          </div>
        </div>
        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <div class="about__detail-text">
            <strong>Finca sostenible en activo</strong>
            <span>Ganado, faisanes, perdices y conejos conviven entre olivos centenarios</span>
          </div>
        </div>
        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <div class="about__detail-text">
            <strong>Check-in personalizado · Atención 24 h</strong>
            <span>Nos adaptamos a vuestros horarios y necesidades</span>
          </div>
        </div>

        <a href="#habitaciones" class="btn btn--dark">Descubrir los espacios</a>
      </div>

    </div>
  </div>
</section>


<!-- ══════════ FINCA / HISTORIA ══════════ -->
<?php
$finca_eyebrow = $gf('finca_eyebrow') ?: 'La Finca';
$finca_title   = $gf('finca_title')   ?: 'Historia viva en 24 hectáreas de campo abierto';
$finca_text    = $gf('finca_text')    ?: '<p>Concebida como una auténtica finca taurina, La Casa del Torero conserva su esencia ganadera mientras se ha convertido en un refugio de lujo accesible. Sus olivos centenarios, su plaza de tentación y sus corrales son testigos mudos de generaciones de tradición andaluza.</p><p>Desde 2019 la propiedad funciona también como alojamiento exclusivo, combinando el alma de la finca brava con los más altos estándares de confort contemporáneo.</p>';
$finca_image   = $gf('finca_image');
$finca_stats   = $gf('finca_stats');
$default_stats = [
    ['value' => '24', 'label' => 'hectáreas de campo abierto'],
    ['value' => '11', 'label' => 'km a las playas'],
    ['value' => '4',  'label' => 'habitaciones y suite'],
    ['value' => '∞',  'label' => 'vistas al horizonte'],
];
$stats = ($finca_stats && is_array($finca_stats)) ? array_map(fn($s) => ['value' => $s['finca_stat_value'], 'label' => $s['finca_stat_label']], $finca_stats) : $default_stats;
?>
<section id="la-finca" class="finca">
  <div class="container">
    <div class="finca__inner">

      <div class="finca__content reveal">
        <span class="eyebrow"><?php echo esc_html($finca_eyebrow); ?></span>
        <h2 class="finca__title"><?php echo esc_html($finca_title); ?></h2>
        <div class="finca__text"><?php echo wp_kses_post($finca_text); ?></div>

        <div class="finca__stat-grid">
          <?php foreach ($stats as $stat) : ?>
            <div class="finca__stat">
              <div class="finca__stat-number"><?php echo esc_html($stat['value']); ?></div>
              <div class="finca__stat-label"><?php echo esc_html($stat['label']); ?></div>
            </div>
          <?php endforeach; ?>
        </div>

        <a href="#reservas" class="btn btn--gold">Consultar disponibilidad</a>
      </div>

      <div class="finca__image reveal d1">
        <?php if ($finca_image) : ?>
          <img loading="lazy" src="<?php echo esc_url($finca_image['url']); ?>" alt="<?php echo esc_attr($finca_image['alt'] ?? ''); ?>" style="width:100%;height:100%;object-fit:cover;display:block;">
        <?php else : ?>
          <img loading="lazy" src="<?php echo esc_url($img_base . '/casa/aerea.jpg'); ?>" alt="Vista aérea de La Casa del Torero con Vejer al fondo" style="width:100%;height:100%;object-fit:cover;display:block;">
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>


<!-- ══════════ EXPERIENCE ══════════ -->
<?php
$exp_title     = $gf('exp_title')     ?: 'Todo lo que necesitáis, y lo que no esperabais';
$exp_lead      = $gf('exp_lead')      ?: 'Desde vuestra llegada todo está pensado para que no tengáis que pensar en nada. La finca, el campo, las vistas y la tranquilidad absoluta son los mejores anfitriones.';
$exp_amenities = $gf('exp_amenities') ?: '';
$exp_image_1   = $gf('exp_image_1');
$exp_image_2   = $gf('exp_image_2');
$exp_image_3   = $gf('exp_image_3');

$amenities_list = $exp_amenities
    ? array_filter(array_map('trim', explode("\n", $exp_amenities)))
    : ['Piscina exterior de temporada', 'WiFi gratuito de alta velocidad', 'Aire acondicionado', 'Chimenea de leña', 'Salón comunitario', 'Parking gratuito', 'Terraza de sol', 'Desayuno continental incluido', 'Chef privado a disposición', 'Menús con producto local', 'Huerta propia ecológica', '24 ha de campo para pasear', 'Plaza de tentación histórica', 'TV en todas las estancias'];
?>
<section id="experiencias" class="experience">
  <div class="container">
    <div class="experience__inner">

      <div class="experience__content reveal">
        <span class="eyebrow">La Experiencia</span>
        <h2 class="experience__title"><?php echo esc_html($exp_title); ?></h2>
        <p class="experience__lead"><?php echo esc_html($exp_lead); ?></p>
        <ul class="amenities-list">
          <?php foreach ($amenities_list as $am) : ?>
            <li class="amenity"><?php echo esc_html($am); ?></li>
          <?php endforeach; ?>
        </ul>
        <a href="#reservas" class="btn btn--dark">Consultar disponibilidad</a>
      </div>

      <div class="experience__visual reveal d1">
        <div class="exp-grid">
          <div class="exp-img ei1">
            <?php if ($exp_image_1) : ?>
              <img loading="lazy" src="<?php echo esc_url($exp_image_1['url']); ?>" alt="<?php echo esc_attr($exp_image_1['alt'] ?? ''); ?>" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php else : ?>
              <img loading="lazy" src="<?php echo esc_url($img_base . '/casa/finca-exterior.jpg'); ?>" alt="Exterior de la finca" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php endif; ?>
          </div>
          <div class="exp-img ei2">
            <?php if ($exp_image_2) : ?>
              <img loading="lazy" src="<?php echo esc_url($exp_image_2['url']); ?>" alt="<?php echo esc_attr($exp_image_2['alt'] ?? ''); ?>" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php else : ?>
              <img loading="lazy" src="<?php echo esc_url($img_base . '/galeria/g07.jpg'); ?>" alt="Detalle interior" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php endif; ?>
          </div>
          <div class="exp-img ei3">
            <?php if ($exp_image_3) : ?>
              <img loading="lazy" src="<?php echo esc_url($exp_image_3['url']); ?>" alt="<?php echo esc_attr($exp_image_3['alt'] ?? ''); ?>" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php else : ?>
              <img loading="lazy" src="<?php echo esc_url($img_base . '/galeria/g04.jpg'); ?>" alt="Detalle de la finca" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ══════════ GASTRONOMÍA ══════════ -->
<?php
$gastro_eyebrow  = $gf('gastro_eyebrow')  ?: 'Gastronomía · Servicio exclusivo';
$gastro_title    = $gf('gastro_title')    ?: 'Chef propio a vuestra disposición';
$gastro_text     = $gf('gastro_text')     ?: '<p>Un chef privado que elabora cada día los mejores productos de la zona, con verduras frescas de nuestra propia huerta. Cocina mediterránea con un delicado toque afrancesado — sencilla en apariencia, memorable en el plato.</p>';
$gastro_features = $gf('gastro_features') ?: '';
$gastro_image_1  = $gf('gastro_image_1');
$gastro_image_2  = $gf('gastro_image_2');
$gastro_image_3  = $gf('gastro_image_3');

$gastro_tags = $gastro_features
    ? array_filter(array_map('trim', explode("\n", $gastro_features)))
    : ['Menús diarios', 'Huerta propia', 'Producto local', 'Cocina mediterránea', 'Toque afrancesado', 'Personalizable'];
$contact_email = function_exists('get_field') ? (get_field('contact_email', 'option') ?: 'info@lacasadeltorero.com') : 'info@lacasadeltorero.com';
?>
<section id="gastronomia" class="gastro">
  <div class="container">
    <div class="gastro__inner">

      <div class="gastro__content reveal">
        <span class="eyebrow"><?php echo esc_html($gastro_eyebrow); ?></span>
        <h2 class="gastro__title"><?php echo wp_kses_post($gastro_title); ?></h2>
        <div class="gastro__lead"><?php echo wp_kses_post($gastro_text); ?></div>
        <div class="gastro__tags">
          <?php foreach ($gastro_tags as $tag) : ?>
            <span class="gastro__tag"><?php echo esc_html($tag); ?></span>
          <?php endforeach; ?>
        </div>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="btn btn--ghost">Consultar menús y disponibilidad</a>
      </div>

      <div class="gastro__visual reveal d1">
        <div class="gastro__img">
          <?php if ($gastro_image_1) : ?>
            <img loading="lazy" src="<?php echo esc_url($gastro_image_1['url']); ?>" alt="<?php echo esc_attr($gastro_image_1['alt'] ?? ''); ?>">
          <?php else : ?>
            <img loading="lazy" src="<?php echo esc_url($img_base . '/gastro/mesa.jpg'); ?>" alt="Mesa preparada para la cena">
          <?php endif; ?>
        </div>
        <div class="gastro__img">
          <?php if ($gastro_image_2) : ?>
            <img loading="lazy" src="<?php echo esc_url($gastro_image_2['url']); ?>" alt="<?php echo esc_attr($gastro_image_2['alt'] ?? ''); ?>">
          <?php else : ?>
            <img loading="lazy" src="<?php echo esc_url($img_base . '/gastro/comedor.jpg'); ?>" alt="Comedor de La Casa del Torero">
          <?php endif; ?>
        </div>
        <div class="gastro__img">
          <?php if ($gastro_image_3) : ?>
            <img loading="lazy" src="<?php echo esc_url($gastro_image_3['url']); ?>" alt="<?php echo esc_attr($gastro_image_3['alt'] ?? ''); ?>">
          <?php else : ?>
            <img loading="lazy" src="<?php echo esc_url($img_base . '/gastro/plato.jpg'); ?>" alt="Plato del chef">
          <?php endif; ?>
        </div>
        <div class="gastro__quote">
          <p>"Verduras de nuestra propia huerta, los mejores productos de la zona y la precisión de la cocina francesa — todo en una misma mesa."</p>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ══════════ GALERÍA SLIDER ══════════ -->
<?php
$gallery_items = $gf('gallery_items');
$default_gallery = [
    ['img' => 'casa/aerea.jpg',              'alt' => 'Vista aérea de la finca'],
    ['img' => 'espacios/suite-principal.jpg','alt' => 'Suite del Torero'],
    ['img' => 'galeria/g01.jpg',             'alt' => 'Cocina y comedor de La Casa del Torero'],
    ['img' => 'casa/piscina.jpg',            'alt' => 'Piscina exterior'],
    ['img' => 'galeria/g03.jpg',             'alt' => 'Salón con chimenea'],
    ['img' => 'casa/finca-exterior.jpg',     'alt' => 'Exterior de la finca'],
    ['img' => 'galeria/g05.jpg',             'alt' => 'Detalle de la finca'],
    ['img' => 'galeria/g07.jpg',             'alt' => 'Rincón interior de la casa'],
    ['img' => 'galeria/g08.jpg',             'alt' => 'Mesa exterior preparada para cenar'],
    ['img' => 'espacios/hab-slide-1.jpg',    'alt' => 'Habitación'],
    ['img' => 'galeria/g10.jpg',             'alt' => 'Vista de la terraza'],
    ['img' => 'espacios/hab-slide-2.jpg',    'alt' => 'Habitación doble'],
];
?>
<section id="galeria" style="background: var(--blue); padding: clamp(3rem,5vw,5rem) 0 0; overflow:hidden;">
  <div class="container" style="margin-bottom:2rem; text-align:center;">
    <span class="eyebrow">Galería</span>
    <h2 class="section-title" style="color:#fff;">La finca, por dentro y por fuera</h2>
    <div class="gold-rule"></div>
  </div>

  <div class="glider-wrap" style="position:relative;">
    <div class="glider-track" id="gliderTrack" style="
      display:flex; gap:6px;
      overflow-x:auto; scroll-snap-type:x mandatory;
      scrollbar-width:none; -ms-overflow-style:none;
      cursor:grab; user-select:none;
      padding: 0 clamp(1.25rem,5vw,3rem);
    ">
      <?php if ($gallery_items && is_array($gallery_items)) :
          foreach ($gallery_items as $item) :
              $g_img = $item['gallery_image'] ?? null;
              $g_alt = esc_attr($item['gallery_alt'] ?? ($g_img['alt'] ?? ''));
              $g_url = $g_img ? esc_url(is_array($g_img) ? $g_img['url'] : $g_img) : '';
              if (!$g_url) continue;
              $is_wide = in_array(array_search($item, $gallery_items) % 3, [0, 2]);
              $w = $is_wide ? 'clamp(260px,38vw,580px)' : 'clamp(200px,28vw,420px)';
      ?>
          <div style="flex:0 0 auto;width:<?php echo $w; ?>;height:clamp(240px,38vw,520px);overflow:hidden;scroll-snap-align:start;">
            <img loading="lazy" src="<?php echo $g_url; ?>" alt="<?php echo $g_alt; ?>" style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s ease;">
          </div>
      <?php endforeach;
      else :
          foreach ($default_gallery as $i => $item) :
              $is_wide = in_array($i % 3, [0, 2]);
              $w = $is_wide ? 'clamp(260px,38vw,580px)' : 'clamp(200px,28vw,420px)';
      ?>
          <div style="flex:0 0 auto;width:<?php echo $w; ?>;height:clamp(240px,38vw,520px);overflow:hidden;scroll-snap-align:start;">
            <img loading="lazy" src="<?php echo esc_url($img_base . '/' . $item['img']); ?>" alt="<?php echo esc_attr($item['alt']); ?>" style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s ease;">
          </div>
      <?php endforeach;
      endif; ?>
    </div>

    <button class="glider-btn" onclick="document.getElementById('gliderTrack').scrollBy({left:-460,behavior:'smooth'})" style="position:absolute;top:50%;left:clamp(.5rem,2vw,1.5rem);transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(0,0,0,.55);border:1px solid rgba(255,255,255,.25);color:#fff;font-size:1.2rem;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);z-index:10;">&#8592;</button>

    <button class="glider-btn" onclick="document.getElementById('gliderTrack').scrollBy({left:460,behavior:'smooth'})" style="position:absolute;top:50%;right:clamp(.5rem,2vw,1.5rem);transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(0,0,0,.55);border:1px solid rgba(255,255,255,.25);color:#fff;font-size:1.2rem;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);z-index:10;">&#8594;</button>
  </div>
</section>


<!-- ══════════ TESTIMONIALS ══════════ -->
<?php
$testimonials = $go('testimonials');
$default_testimonials = [
    ['text' => '«Es un lugar con un encanto muy especial. Cristofer, excelente profesional, muy atento y servicial, nos hizo sentir muy a gusto. Es el segundo año que vamos y sigue estando al máximo nivel. Los desayunos que te sirven en mesa son de lo mejor que puedes encontrar en cualquier hotel.»', 'author' => 'Cristina', 'origin' => 'España · Julio 2025 · Suite Junior', 'platform' => 'Booking.com · 10/10'],
    ['text' => '«Tuvimos un tiempo fabuloso en el apartamento. Nos hicieron sentir tan bienvenidos por nuestros anfitriones Bruno & Christophe. Christophe nos mimó con su cocina y todos acordamos que sus desayunos eran un punto culminante de vacaciones.»', 'author' => 'Anna', 'origin' => 'Septiembre 2024 · Apartamento', 'platform' => 'TripAdvisor · 5/5'],
    ['text' => '«Un lugar increíble. La finca tiene una historia y una personalidad únicas. La atención de Bruno y Christophe es impecable — se nota que cuidan cada detalle. Las vistas a Vejer al amanecer son inolvidables.»', 'author' => 'Carlos & Lucía', 'origin' => 'Sevilla · Agosto 2024', 'platform' => 'Booking.com · 10/10'],
    ['text' => '«Incredible property. The landscape is breathtaking — olive trees, the white village, the sea in the distance. The hosts Bruno and Christophe are wonderfully attentive. The pool and the breakfasts are perfect. We will definitely be back.»', 'author' => 'James & Sophie', 'origin' => 'London · June 2024', 'platform' => 'Booking.com · 10/10'],
    ['text' => '«Un endroit magique et unique. 24 hectares d\'oliveraies, une histoire authentique de torero, et des hôtes — Bruno & Christophe — qui rendent tout parfait. Les petits-déjeuners sont un pur délice. À recommander absolument.»', 'author' => 'Claire & Étienne', 'origin' => 'Paris · Juillet 2024', 'platform' => 'TripAdvisor · 5/5'],
    ['text' => '«La tranquilidad que se respira en la finca es difícil de encontrar. Todo está cuidado con mimo. El desayuno servido en la terraza con vistas a Vejer es uno de esos momentos que no se olvidan. Repetiremos.»', 'author' => 'Marta', 'origin' => 'Barcelona · Mayo 2025', 'platform' => 'Booking.com · 10/10'],
    ['text' => '«La Casa del Torero was, by far, the best place my husband and I have ever stayed. The location is majestic — sweeping views of the countryside and Vejer in the distance. Simply unforgettable.»', 'author' => 'Huéspeda verificada', 'origin' => 'Booking.com · 10/10', 'platform' => 'Booking.com'],
    ['text' => '«Magnificent accommodation with exceptional treatment. Everything is carefully detailed, very clean and welcoming. Spectacular breakfasts prepared by Christophe and the kindness and service of Bruno are unforgettable.»', 'author' => 'Huésped verificado', 'origin' => 'Booking.com · 10/10', 'platform' => 'Booking.com'],
    ['text' => '«The place is amazing, the view stunning, the house full of history. Special kudos to Bruno and Christophe, amazing hosts that made our stay fantastic. We were welcomed like stars.»', 'author' => 'Huésped verificado', 'origin' => 'Booking.com · 10/10', 'platform' => 'Booking.com'],
    ['text' => '«Bruno\'s attention is exquisite, always ready to give advice about the area and explanations about the property. Breakfasts are truly wonderful and lack nothing. A visit to this beautiful Quinta is a must.»', 'author' => 'Huésped verificado', 'origin' => 'TripAdvisor · 5/5', 'platform' => 'TripAdvisor'],
    ['text' => '«I was overwhelmed by the loving design — coherent and high quality down to the smallest detail — and by two hosts who know how to make the stay an incomparable experience.»', 'author' => 'Huésped verificado', 'origin' => 'Booking.com · 10/10', 'platform' => 'Booking.com'],
];
?>
<section class="testimonials">
  <div class="container">
    <header class="testimonials__header reveal">
      <span class="eyebrow">Opiniones reales</span>
      <h2 class="section-title">Lo que dicen nuestros huéspedes</h2>
      <div class="gold-rule"></div>
    </header>
    <div class="testimonials__scores reveal">
      <div class="t-score">
        <span class="t-score__badge t-score__badge--booking">9,9</span>
        <div class="t-score__label"><strong>Excepcional</strong><span>117 opiniones · Booking.com</span></div>
      </div>
      <div class="t-score">
        <span class="t-score__badge t-score__badge--tripadvisor">5,0</span>
        <div class="t-score__label"><strong>Excelente</strong><span>20 opiniones · TripAdvisor</span></div>
      </div>
    </div>
  </div>
  <div class="testimonials__slider" id="tSlider">
    <?php if ($testimonials && is_array($testimonials)) :
        foreach ($testimonials as $t) : ?>
        <div class="t-card">
          <p class="t-card__stars">★★★★★</p>
          <p class="t-card__text">«<?php echo esc_html($t['testimonial_text'] ?? ''); ?>»</p>
          <p class="t-card__name"><?php echo esc_html($t['testimonial_author'] ?? ''); ?></p>
          <p class="t-card__origin"><?php echo esc_html($t['testimonial_origin'] ?? ''); ?></p>
          <p class="t-card__platform">
            <?php
            $plat = $t['testimonial_platform'] ?? '';
            echo esc_html(match($plat) { 'booking' => 'Booking.com', 'tripadvisor' => 'TripAdvisor', default => $plat });
            ?>
            <?php if (!empty($t['testimonial_score'])) : ?> · <?php echo esc_html($t['testimonial_score']); ?><?php endif; ?>
          </p>
        </div>
    <?php endforeach;
    else :
        foreach ($default_testimonials as $t) : ?>
        <div class="t-card">
          <p class="t-card__stars">★★★★★</p>
          <p class="t-card__text"><?php echo esc_html($t['text']); ?></p>
          <p class="t-card__name"><?php echo esc_html($t['author']); ?></p>
          <p class="t-card__origin"><?php echo esc_html($t['origin']); ?></p>
          <p class="t-card__platform"><?php echo esc_html($t['platform']); ?></p>
        </div>
    <?php endforeach;
    endif; ?>
  </div>
</section>


<!-- ══════════ RESERVAS CTA ══════════ -->
<section id="reservas" class="booking">
  <div class="container">
    <div class="booking__header reveal">
      <span class="eyebrow">Reservas</span>
      <h2 class="section-title">¿Cuándo nos visitas?</h2>
      <div class="gold-rule"></div>
      <p>Reserva directamente con nosotros y obtén las mejores condiciones. Sin intermediarios. Confirmación inmediata.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:2.5rem;">
        <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold">Comprobar disponibilidad</a>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn--ghost">Contactar</a>
      </div>
    </div>
  </div>
</section>


<!-- ══════════ FAQ ══════════ -->
<?php
$faq_items = $go('faq_items');
$default_faq = [
    ['q' => '¿Se admiten mascotas?',                                                'a' => '— Pendiente de confirmar con el propietario —'],
    ['q' => '¿Cuál es el horario de check-in y check-out?',                        'a' => '— Pendiente de confirmar con el propietario —'],
    ['q' => '¿Está incluido el desayuno?',                                          'a' => '— Pendiente de confirmar con el propietario —'],
    ['q' => '¿Hay un mínimo de noches?',                                            'a' => '— Pendiente de confirmar con el propietario —'],
    ['q' => '¿Se puede alquilar la casa completa para eventos o celebraciones?',   'a' => '— Pendiente de confirmar con el propietario —'],
    ['q' => '¿La piscina está disponible todo el año?',                            'a' => '— Pendiente de confirmar con el propietario —'],
    ['q' => '¿Cuánto se tarda en llegar a la playa más cercana?',                  'a' => 'Las playas vírgenes de la Costa de la Luz están a tan solo 11 km. En coche son aproximadamente 15 minutos hasta Caños de Meca y El Palmar.'],
    ['q' => '¿Hay aparcamiento en la finca?',                                      'a' => 'Sí, la finca dispone de aparcamiento privado gratuito para todos los huéspedes.'],
    ['q' => '¿Cuál es la política de cancelación?',                               'a' => '— Pendiente de confirmar con el propietario —'],
    ['q' => '¿Hay WiFi en toda la finca?',                                         'a' => 'Sí, la finca dispone de WiFi gratuito de alta velocidad en todas las habitaciones y zonas comunes.'],
];
$faq_wa_num = function_exists('get_field') ? (get_field('social_whatsapp', 'option') ?: '34615508168') : '34615508168';
?>
<section class="faq">
  <div class="container">
    <div class="faq__inner">
      <div class="faq__aside reveal">
        <span class="eyebrow">Preguntas frecuentes</span>
        <h2 class="section-title">Todo lo que necesitas saber</h2>
        <p>Si no encuentras respuesta a tu pregunta, escríbenos — respondemos en menos de 24 horas.</p>
        <a href="https://wa.me/<?php echo esc_attr(preg_replace('/\D/', '', $faq_wa_num)); ?>" class="faq__contact" target="_blank" rel="noopener">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          Pregúntanos por WhatsApp
        </a>
      </div>

      <div class="faq__list reveal d1">
        <?php if ($faq_items && is_array($faq_items)) :
            foreach ($faq_items as $item) : ?>
            <div class="faq-item">
              <button class="faq-item__btn" aria-expanded="false">
                <?php echo esc_html($item['faq_question'] ?? ''); ?>
                <span class="faq-item__icon"><svg viewBox="0 0 12 12"><line x1="6" y1="1" x2="6" y2="11"/><line x1="1" y1="6" x2="11" y2="6"/></svg></span>
              </button>
              <div class="faq-item__body"><div class="faq-item__body-inner"><p><?php echo wp_kses_post($item['faq_answer'] ?? ''); ?></p></div></div>
            </div>
        <?php endforeach;
        else :
            foreach ($default_faq as $item) : ?>
            <div class="faq-item">
              <button class="faq-item__btn" aria-expanded="false">
                <?php echo esc_html($item['q']); ?>
                <span class="faq-item__icon"><svg viewBox="0 0 12 12"><line x1="6" y1="1" x2="6" y2="11"/><line x1="1" y1="6" x2="11" y2="6"/></svg></span>
              </button>
              <div class="faq-item__body"><div class="faq-item__body-inner"><p><?php echo esc_html($item['a']); ?></p></div></div>
            </div>
        <?php endforeach;
        endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- ══════════ LOCATION ══════════ -->
<?php
$loc_title   = $gf('location_title')   ?: 'Vejer de la Frontera — el pueblo blanco más bello de Cádiz';
$loc_text    = $gf('location_text')    ?: '<p>La Casa del Torero se asienta sobre una colina frente al pueblo blanco de Vejer de la Frontera, con vistas espectaculares a la Laguna de La Janda, las marismas de Barbate y la Costa de la Luz. En días claros, la silueta de Marruecos es visible al otro lado del Estrecho.</p>';
$loc_map_url = $gf('location_map_url') ?: 'https://www.openstreetmap.org/export/embed.html?bbox=-6.0000%2C36.2500%2C-5.9000%2C36.3050&layer=mapnik&marker=36.27762%2C-5.95314';
$loc_distances = $gf('location_distances');
$default_distances = [
    ['place' => 'Centro de Vejer de la Frontera', 'km' => 'A pocos minutos en coche'],
    ['place' => 'Playas de la Costa de la Luz', 'km' => '11 km · El Palmar, Zahara de los Atunes, Caños de Meca'],
    ['place' => 'Tarifa (surf · kitesurf)', 'km' => '35 km'],
    ['place' => 'Aeropuerto de Jerez (XRY)', 'km' => '45 minutos en coche'],
    ['place' => 'Aeropuerto de Málaga', 'km' => '1 h 30 min en coche'],
];
$distances = ($loc_distances && is_array($loc_distances))
    ? array_map(fn($d) => ['place' => $d['distance_place'], 'km' => $d['distance_km']], $loc_distances)
    : $default_distances;
?>
<section id="ubicacion" class="location">
  <div class="container">
    <div class="location__inner">

      <div class="location__content reveal">
        <span class="eyebrow">Ubicación</span>
        <h2 class="location__title"><?php echo esc_html($loc_title); ?></h2>
        <div class="location__text"><?php echo wp_kses_post($loc_text); ?></div>

        <div class="location__points">
          <?php foreach ($distances as $d) : ?>
          <div class="loc-point">
            <div class="loc-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 0-8 8c0 5.333 8 14 8 14s8-8.667 8-14a8 8 0 0 0-8-8z"/></svg>
            </div>
            <div><strong><?php echo esc_html($d['place']); ?></strong><span><?php echo esc_html($d['km']); ?></span></div>
          </div>
          <?php endforeach; ?>
        </div>

        <a href="#reservas" class="btn btn--dark">Reservar ahora</a>
      </div>

      <div class="location__map reveal d1">
        <iframe
          src="<?php echo esc_url($loc_map_url); ?>"
          title="Vejer de la Frontera — La Casa del Torero"
          loading="lazy"
          allowfullscreen
        ></iframe>
      </div>

    </div>
  </div>
</section>


<!-- ══════════ CTA BANNER ══════════ -->
<?php
$cta_title    = $gf('cta_title')    ?: 'Vejer os espera.<br>¿Cuándo venís?';
$cta_text     = $gf('cta_text')     ?: 'Cada estancia en La Casa del Torero es irrepetible. Olivos centenarios, cielos infinitos y el mar a 11 km. Reserva directamente y asegura vuestras fechas.';
$cta_btn_text = $gf('cta_btn_text') ?: 'Reservar ahora';
$cta_btn_url  = $gf('cta_btn_url')  ?: '#reservas';
$cta_email    = function_exists('get_field') ? (get_field('contact_email', 'option') ?: 'info@lacasadeltorero.com') : 'info@lacasadeltorero.com';
?>
<section class="cta-banner" id="contacto">
  <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url($img_base); ?>/casa/aerea.jpg')"></div>
  <div class="container">
    <div class="cta-banner__content reveal">
      <span class="eyebrow" style="color:var(--gold-lt)">Contacto &amp; Reservas</span>
      <h2 class="cta-banner__title"><?php echo wp_kses_post($cta_title); ?></h2>
      <p class="cta-banner__text"><?php echo esc_html($cta_text); ?></p>
      <div class="cta-banner__actions">
        <a href="<?php echo esc_url($cta_btn_url); ?>" class="btn btn--gold"><?php echo esc_html($cta_btn_text); ?></a>
        <a href="mailto:<?php echo esc_attr($cta_email); ?>" class="btn btn--ghost">Escribirnos</a>
      </div>
    </div>
  </div>
</section>


<!-- ══════════ WHATSAPP FLOAT ══════════ -->
<?php
$wa_num_fp = function_exists('get_field') ? (get_field('social_whatsapp', 'option') ?: '34615508168') : '34615508168';
$wa_href   = 'https://wa.me/' . preg_replace('/\D/', '', $wa_num_fp);
?>
<a href="<?php echo esc_url($wa_href); ?>" target="_blank" rel="noopener" class="wa-float" id="waFloat" aria-label="Contactar por WhatsApp">
  <span class="wa-float__label">¿Hablamos?</span>
  <span class="wa-float__btn">
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
  </span>
</a>

<?php get_footer(); ?>
