<?php
/**
 * Portada — usa ACF Pro para todos los campos de contenido e imágenes.
 * Si ACF no está activo o un campo está vacío, se muestra un placeholder visual.
 */

/* ── Helper: obtiene campo ACF o devuelve fallback ── */
function cdt_field(string $key, $fallback = '') {
    if (!function_exists('get_field')) return $fallback;
    $val = get_field($key);
    return ($val !== '' && $val !== null && $val !== false) ? $val : $fallback;
}

/* ── Helper: imprime una imagen ACF (array) o un placeholder ── */
function cdt_image(string $key, string $placeholder_text = 'Foto', string $extra_class = '', string $style = ''): void {
    if (function_exists('get_field')) {
        $img = get_field($key);
        if ($img && !empty($img['url'])) {
            printf(
                '<img class="%s" src="%s" alt="%s" loading="lazy" %s>',
                esc_attr($extra_class),
                esc_url($img['url']),
                esc_attr($img['alt'] ?: $placeholder_text),
                $style ? 'style="' . esc_attr($style) . '"' : ''
            );
            return;
        }
    }
    // Placeholder visual
    ?>
    <div class="acf-placeholder <?php echo esc_attr($extra_class); ?>" <?php echo $style ? 'style="' . esc_attr($style) . '"' : ''; ?>>
      <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width=".8" stroke-linecap="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
      <span><?php echo esc_html($placeholder_text); ?></span>
    </div>
    <?php
}

get_header();
?>

<?php /* ══════════════════════════════════════════
   HERO — VÍDEO
══════════════════════════════════════════ */ ?>
<section class="hero" aria-label="La Casa del Torero, Vejer">

  <div class="hero__video-wrap">
    <?php
    $video_url  = cdt_field('hero_video') ?: get_template_directory_uri() . '/assets/video/hero.mp4';
    $poster_url = cdt_field('hero_poster');
    $fallback   = cdt_field('hero_fallback');
    ?>
    <video
      autoplay muted loop playsinline
      <?php if ($poster_url) : ?>poster="<?php echo esc_url($poster_url); ?>"<?php endif; ?>
      aria-hidden="true"
      preload="auto"
    >
      <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
    </video>

    <?php if ($fallback || !$video_url) : ?>
      <div class="hero__bg" <?php if ($fallback) : ?>style="background-image:url('<?php echo esc_url($fallback); ?>')"<?php endif; ?>></div>
    <?php endif; ?>
  </div>

  <div class="hero__overlay"></div>
  <div class="hero__deco" aria-hidden="true"></div>

  <div class="hero__content">
    <span class="hero__eyebrow">Casa Rural &middot; Hotel Boutique &middot; Vejer, C&aacute;diz</span>
    <h1 class="hero__title"><?php echo nl2br(esc_html(cdt_field('hero_title', "La Casa\ndel Torero"))); ?></h1>
    <p class="hero__subtitle"><?php echo esc_html(cdt_field('hero_subtitle', 'Una finca histórica de 24 hectáreas entre olivos centenarios, a 11 km de las playas vírgenes de la Costa de la Luz.')); ?></p>
    <div class="hero__actions">
      <a href="#reservas" class="btn btn--primary"><?php esc_html_e('Reservar ahora', 'casadeltorero'); ?></a>
      <a href="#la-casa" class="btn btn--outline"><?php esc_html_e('Descubrir la finca', 'casadeltorero'); ?></a>
    </div>
  </div>

  <div class="hero__badge" aria-label="<?php esc_attr_e('En días despejados se ve Marruecos', 'casadeltorero'); ?>">
    <strong><?php esc_html_e('Marruecos visible', 'casadeltorero'); ?></strong>
    <?php esc_html_e('en días despejados', 'casadeltorero'); ?>
  </div>

  <div class="hero__scroll" aria-hidden="true"><?php esc_html_e('Descubrir', 'casadeltorero'); ?></div>
</section>


<?php /* ══════════════════════════════════════════
   INTRO STRIP
══════════════════════════════════════════ */ ?>
<div class="intro-strip">
  <div class="container">
    <div class="intro-strip__inner">
      <div class="intro-strip__item">
        <p class="intro-strip__label"><?php esc_html_e('Finca', 'casadeltorero'); ?></p>
        <p class="intro-strip__value">24 <?php esc_html_e('hectáreas', 'casadeltorero'); ?></p>
      </div>
      <div class="intro-strip__item">
        <p class="intro-strip__label"><?php esc_html_e('Playas', 'casadeltorero'); ?></p>
        <p class="intro-strip__value">11 km &middot; Costa de la Luz</p>
      </div>
      <div class="intro-strip__item">
        <p class="intro-strip__label"><?php esc_html_e('Alquiler', 'casadeltorero'); ?></p>
        <p class="intro-strip__value"><?php esc_html_e('Casa completa en exclusiva', 'casadeltorero'); ?></p>
      </div>
      <div class="intro-strip__item">
        <p class="intro-strip__label"><?php esc_html_e('Ubicación', 'casadeltorero'); ?></p>
        <p class="intro-strip__value">Vejer, C&aacute;diz</p>
      </div>
    </div>
  </div>
</div>


<?php /* ══════════════════════════════════════════
   LA CASA
══════════════════════════════════════════ */ ?>
<section id="la-casa" class="about">
  <div class="container">
    <div class="about__inner">

      <div class="about__image-wrap reveal">
        <?php cdt_image('casa_foto_principal', 'Foto fachada principal', 'about__image-main'); ?>
        <?php cdt_image('casa_foto_detalle',   'Detalle interior',       'about__image-accent'); ?>
      </div>

      <div class="about__content reveal reveal-delay-1">
        <span class="eyebrow"><?php esc_html_e('La Casa', 'casadeltorero'); ?></span>
        <h2 class="about__title"><?php echo esc_html(cdt_field('casa_titulo', 'Un enclave único entre el pueblo blanco y el campo andaluz')); ?></h2>

        <div class="about__text">
          <?php
          $texto1 = cdt_field('casa_texto1');
          echo $texto1
            ? wp_kses_post($texto1)
            : '<p>La Casa del Torero es una finca de 24 hectáreas diseñada por y para un torero, siguiendo el modelo de una ganadería de reses bravas donde aún hoy siguen en uso sus instalaciones: corrales, plaza de tentación con su típica palco y burladero.</p>';
          ?>
        </div>
        <div class="about__text">
          <?php
          $texto2 = cdt_field('casa_texto2');
          echo $texto2
            ? wp_kses_post($texto2)
            : '<p>Situada en una de las colinas frente al pueblo blanco de Vejer, la casa ofrece unas vistas privilegiadas sobre la Laguna de La Janda, las marismas de Barbate y, en días despejados, la costa de Marruecos al otro lado del Estrecho.</p>';
          ?>
        </div>

        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
          <div class="about__detail-text">
            <strong><?php esc_html_e('Arquitectura tradicional andaluza rehabilitada', 'casadeltorero'); ?></strong>
            <span><?php esc_html_e('Encanto moderno y andaluz que acompaña cada rincón iluminado y colorido', 'casadeltorero'); ?></span>
          </div>
        </div>
        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <div class="about__detail-text">
            <strong><?php esc_html_e('Finca sostenible en activo', 'casadeltorero'); ?></strong>
            <span><?php esc_html_e('Ganado, faisanes, perdices y conejos conviven entre olivos centenarios', 'casadeltorero'); ?></span>
          </div>
        </div>
        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <div class="about__detail-text">
            <strong><?php esc_html_e('Check-in personalizado · Atención 24 h', 'casadeltorero'); ?></strong>
            <span><?php esc_html_e('Nos adaptamos a vuestros horarios y necesidades', 'casadeltorero'); ?></span>
          </div>
        </div>

        <a href="#espacios" class="btn btn--dark"><?php esc_html_e('Descubrir los espacios', 'casadeltorero'); ?></a>
      </div>

    </div>
  </div>
</section>


<?php /* ══════════════════════════════════════════
   LA FINCA
══════════════════════════════════════════ */ ?>
<section id="la-finca" class="finca">
  <div class="container">
    <div class="finca__inner">

      <div class="finca__content reveal">
        <span class="eyebrow"><?php esc_html_e('La Finca', 'casadeltorero'); ?></span>
        <h2 class="finca__title"><?php echo esc_html(cdt_field('finca_titulo', 'Historia viva en 24 hectáreas de campo abierto')); ?></h2>

        <div class="finca__text">
          <?php
          $ft1 = cdt_field('finca_texto1');
          echo $ft1
            ? wp_kses_post($ft1)
            : '<p>Concebida como una auténtica finca taurina, La Casa del Torero conserva su esencia ganadera mientras se ha convertido en un refugio de lujo. Sus olivos centenarios, su plaza de tentación y sus corrales son testigos de generaciones de tradición andaluza.</p>';
          ?>
        </div>
        <div class="finca__text">
          <?php
          $ft2 = cdt_field('finca_texto2');
          echo $ft2
            ? wp_kses_post($ft2)
            : '<p>Desde 2019 la propiedad funciona también como alojamiento exclusivo, combinando el alma de la finca brava con los más altos estándares de confort. Los productos de la huerta propia y la cocina mediterránea con toque francés completan la experiencia.</p>';
          ?>
        </div>

        <div class="finca__stat-grid">
          <div class="finca__stat"><div class="finca__stat-number">24</div><div class="finca__stat-label"><?php esc_html_e('hectáreas de campo abierto', 'casadeltorero'); ?></div></div>
          <div class="finca__stat"><div class="finca__stat-number">11</div><div class="finca__stat-label"><?php esc_html_e('km a las playas', 'casadeltorero'); ?></div></div>
          <div class="finca__stat"><div class="finca__stat-number">4</div><div class="finca__stat-label"><?php esc_html_e('habitaciones y suite', 'casadeltorero'); ?></div></div>
          <div class="finca__stat"><div class="finca__stat-number">∞</div><div class="finca__stat-label"><?php esc_html_e('vistas al horizonte', 'casadeltorero'); ?></div></div>
        </div>

        <a href="#reservas" class="btn btn--gold"><?php esc_html_e('Consultar disponibilidad', 'casadeltorero'); ?></a>
      </div>

      <div class="finca__image reveal reveal-delay-1">
        <?php cdt_image('finca_foto', 'Foto aérea / olivos centenarios'); ?>
      </div>

    </div>
  </div>
</section>


<?php /* ══════════════════════════════════════════
   ESPACIOS — Repeater ACF
══════════════════════════════════════════ */ ?>
<section id="espacios" class="spaces">
  <div class="container">
    <header class="spaces__header reveal">
      <span class="eyebrow"><?php esc_html_e('Los Espacios', 'casadeltorero'); ?></span>
      <h2 class="section-title"><?php esc_html_e('Cuatro habitaciones, una experiencia única', 'casadeltorero'); ?></h2>
      <div class="gold-rule"></div>
      <p class="section-body" style="margin-top:1.5rem"><?php esc_html_e('Cada estancia ha sido diseñada con encanto moderno y andaluz. Todas con terraza, vistas al pueblo y acceso privado al campo.', 'casadeltorero'); ?></p>
    </header>
  </div>

  <div class="spaces__grid">
    <?php
    $espacios = function_exists('get_field') ? get_field('espacios') : null;

    if ($espacios) :
      foreach ($espacios as $i => $espacio) :
        $delay = $i > 0 ? ' reveal-delay-' . min($i, 3) : '';
        $img   = $espacio['foto'] ?? null;
    ?>
      <div class="space-card reveal<?php echo esc_attr($delay); ?>">
        <?php if ($img && !empty($img['url'])) : ?>
          <img class="space-card__img" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?: $espacio['nombre']); ?>" loading="lazy">
        <?php else : ?>
          <div class="space-card__img acf-placeholder acf-placeholder--dark">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width=".8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          </div>
        <?php endif; ?>
        <div class="space-card__overlay">
          <?php if (!empty($espacio['tag'])) : ?>
            <span class="space-card__tag"><?php echo esc_html($espacio['tag']); ?></span>
          <?php endif; ?>
          <h3 class="space-card__name"><?php echo esc_html($espacio['nombre'] ?? ''); ?></h3>
          <?php if (!empty($espacio['tamanyo'])) : ?>
            <p class="space-card__size"><?php echo esc_html($espacio['tamanyo']); ?></p>
          <?php endif; ?>
          <?php if (!empty($espacio['descripcion'])) : ?>
            <p class="space-card__desc"><?php echo esc_html($espacio['descripcion']); ?></p>
          <?php endif; ?>
        </div>
      </div>
    <?php
      endforeach;

    else :
      // Fallback visual si aún no hay datos ACF
      $fallback_spaces = [
        ['tag' => 'Suite',         'name' => 'Suite del Torero',  'size' => '50 m² · Hasta 4 personas', 'class' => 's1'],
        ['tag' => 'Habitación',    'name' => 'Habitación Albero', 'size' => '25 m² · Hasta 2 personas', 'class' => 's2'],
        ['tag' => 'Exterior',      'name' => 'Jardín & Piscina',  'size' => 'Piscina · Jacuzzi',         'class' => 's3'],
      ];
      foreach ($fallback_spaces as $i => $s) :
        $delay = $i > 0 ? ' reveal-delay-' . $i : '';
    ?>
      <div class="space-card reveal<?php echo esc_attr($delay); ?>">
        <div class="space-card__img acf-placeholder acf-placeholder--dark <?php echo esc_attr($s['class']); ?>">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width=".8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
        <div class="space-card__overlay">
          <span class="space-card__tag"><?php echo esc_html($s['tag']); ?></span>
          <h3 class="space-card__name"><?php echo esc_html($s['name']); ?></h3>
          <p class="space-card__size"><?php echo esc_html($s['size']); ?></p>
        </div>
      </div>
    <?php
      endforeach;
    endif;
    ?>
  </div>
</section>


<?php /* ══════════════════════════════════════════
   EXPERIENCIAS + AMENITIES
══════════════════════════════════════════ */ ?>
<section id="experiencias" class="experience">
  <div class="container">
    <div class="experience__inner">

      <div class="experience__content reveal">
        <span class="eyebrow"><?php esc_html_e('La Experiencia', 'casadeltorero'); ?></span>
        <h2 class="experience__title"><?php esc_html_e('Todo lo que necesitáis, y lo que no esperabais', 'casadeltorero'); ?></h2>
        <p class="experience__lead"><?php esc_html_e('Desde vuestra llegada todo está pensado para que no tengáis que pensar en nada. La finca, el campo, las vistas y la tranquilidad absoluta son los mejores anfitriones.', 'casadeltorero'); ?></p>

        <ul class="amenities-list">
          <?php
          $amenities = function_exists('get_field') ? get_field('amenities') : null;
          if ($amenities) :
            foreach ($amenities as $a) :
          ?>
            <li class="amenity"><?php echo esc_html($a['texto']); ?></li>
          <?php
            endforeach;
          else :
            $defaults = ['Piscina exterior de temporada','Jacuzzi privado','WiFi gratuito','Aire acondicionado','Chimenea de leña','Salón comunitario','Parking gratuito','Terraza de sol','Desayuno continental','Huerto propio','24 ha de campo para pasear','Plaza de tentación histórica','Cocina mediterránea con toque francés','TV en todas las estancias'];
            foreach ($defaults as $d) :
          ?>
            <li class="amenity"><?php echo esc_html($d); ?></li>
          <?php
            endforeach;
          endif;
          ?>
        </ul>

        <a href="#reservas" class="btn btn--dark"><?php esc_html_e('Consultar disponibilidad', 'casadeltorero'); ?></a>
      </div>

      <div class="experience__visual reveal reveal-delay-1">
        <div class="experience__image-grid">
          <?php
          cdt_image('exp_foto_grande', 'Salón / chimenea',       'exp-img ei1');
          cdt_image('exp_foto_2',      'Piscina / jacuzzi',      'exp-img ei2');
          cdt_image('exp_foto_3',      'Desayuno / huerto',      'exp-img ei3');
          ?>
        </div>
      </div>

    </div>
  </div>
</section>


<?php /* ══════════════════════════════════════════
   GALERÍA
══════════════════════════════════════════ */ ?>
<?php
$galeria = function_exists('get_field') ? get_field('galeria') : null;
if ($galeria && count($galeria) > 0) :
?>
<section id="galeria" class="gallery">
  <div class="container">
    <header class="gallery__header reveal">
      <span class="eyebrow"><?php esc_html_e('Galería', 'casadeltorero'); ?></span>
      <h2 class="section-title"><?php esc_html_e('La finca en imágenes', 'casadeltorero'); ?></h2>
      <div class="gold-rule"></div>
    </header>
  </div>
  <div class="gallery__grid">
    <?php foreach ($galeria as $img) : ?>
      <a href="<?php echo esc_url($img['url']); ?>" class="gallery__item" data-lightbox="galeria" data-title="<?php echo esc_attr($img['caption'] ?? ''); ?>">
        <img
          src="<?php echo esc_url($img['sizes']['medium_large'] ?? $img['url']); ?>"
          alt="<?php echo esc_attr($img['alt'] ?: 'La Casa del Torero'); ?>"
          loading="lazy"
          width="<?php echo esc_attr($img['sizes']['medium_large-width'] ?? ''); ?>"
          height="<?php echo esc_attr($img['sizes']['medium_large-height'] ?? ''); ?>"
        >
      </a>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>


<?php /* ══════════════════════════════════════════
   BOOKING — REDFORS
══════════════════════════════════════════ */ ?>
<section id="reservas" class="booking">
  <div class="container">
    <header class="booking__header reveal">
      <span class="eyebrow"><?php esc_html_e('Reservas', 'casadeltorero'); ?></span>
      <h2 class="section-title"><?php esc_html_e('Comprueba disponibilidad', 'casadeltorero'); ?></h2>
      <p><?php esc_html_e('Reserva directamente con nosotros y obtén las mejores condiciones. Sin intermediarios. Confirmación inmediata.', 'casadeltorero'); ?></p>
    </header>

    <div class="booking__engine reveal reveal-delay-1">
      <?php
      if (shortcode_exists('redfors_booking')) {
          echo do_shortcode('[redfors_booking]');
      } else {
          ?>
          <div style="text-align:center;padding:3rem;color:var(--color-muted);">
            <p style="font-family:var(--font-sans);font-size:.75rem;letter-spacing:.15em;text-transform:uppercase;margin-bottom:1rem;color:var(--color-gold);">Motor de reservas</p>
            <p style="font-family:var(--font-serif);font-size:1.5rem;margin-bottom:2rem;color:var(--color-black);">Activa el plugin Redfors Hotel<br>para mostrar el motor de reservas aquí.</p>
            <p style="font-size:.875rem;">Contacto directo: <a href="mailto:<?php echo esc_attr(get_field('contact_email', 'option') ?: 'info@lacasadeltorero.com'); ?>" style="color:var(--color-gold)"><?php echo esc_html(get_field('contact_email', 'option') ?: 'info@lacasadeltorero.com'); ?></a></p>
          </div>
          <?php
      }
      ?>
    </div>
  </div>
</section>


<?php /* ══════════════════════════════════════════
   TESTIMONIOS — Repeater ACF
══════════════════════════════════════════ */ ?>
<section class="testimonials">
  <div class="container">
    <header class="testimonials__header reveal">
      <span class="eyebrow"><?php esc_html_e('Opiniones', 'casadeltorero'); ?></span>
      <h2 class="section-title"><?php esc_html_e('Lo que dicen nuestros huéspedes', 'casadeltorero'); ?></h2>
      <div class="gold-rule"></div>
    </header>

    <div class="testimonials__track">
      <?php
      $testimonios = function_exists('get_field') ? get_field('testimonios') : null;
      if ($testimonios) :
        foreach ($testimonios as $i => $t) :
          $delay = $i > 0 ? ' reveal-delay-' . min($i, 3) : '';
          $stars = str_repeat('★', intval($t['estrellas'] ?? 5));
      ?>
        <div class="testimonial-card reveal<?php echo esc_attr($delay); ?>">
          <p class="testimonial-card__stars"><?php echo esc_html($stars); ?></p>
          <p class="testimonial-card__text">«<?php echo esc_html($t['texto']); ?>»</p>
          <p class="testimonial-card__name"><?php echo esc_html($t['nombre']); ?></p>
          <p class="testimonial-card__origin"><?php echo esc_html($t['origen']); ?></p>
          <?php if (!empty($t['plataforma'])) : ?>
            <p class="testimonial-card__platform"><?php echo esc_html($t['plataforma']); ?></p>
          <?php endif; ?>
        </div>
      <?php
        endforeach;
      else :
        // Fallback
        $defaults = [
          ['★★★★★', '«Atención exquisita. La casa es preciosa y la ubicación espectacular. Las vistas a Vejer desde la terraza al amanecer son para no olvidar. Volveremos sin duda.»', 'María C.', 'Madrid · Agosto 2024', 'Tripadvisor'],
          ['★★★★★', '«Incredible property. The landscape is breathtaking — olive trees, the white village, the sea in the distance. The hosts are wonderfully attentive and the pool is perfect.»', 'James & Sophie T.', 'London · June 2024', 'Booking.com'],
          ['★★★★★', '«Un endroit magique. 24 hectares d\'oliveraie, une histoire authentique et des hôtes qui rendent tout parfait. À recommander absolument.»', 'Claire & Étienne M.', 'Paris · Juillet 2024', 'Airbnb'],
        ];
        foreach ($defaults as $i => $t) :
          $delay = $i > 0 ? ' reveal-delay-' . $i : '';
      ?>
        <div class="testimonial-card reveal<?php echo esc_attr($delay); ?>">
          <p class="testimonial-card__stars"><?php echo esc_html($t[0]); ?></p>
          <p class="testimonial-card__text"><?php echo esc_html($t[1]); ?></p>
          <p class="testimonial-card__name"><?php echo esc_html($t[2]); ?></p>
          <p class="testimonial-card__origin"><?php echo esc_html($t[3]); ?></p>
          <p class="testimonial-card__platform"><?php echo esc_html($t[4]); ?></p>
        </div>
      <?php
        endforeach;
      endif;
      ?>
    </div>
  </div>
</section>


<?php /* ══════════════════════════════════════════
   UBICACIÓN
══════════════════════════════════════════ */ ?>
<section id="ubicacion" class="location">
  <div class="container">
    <div class="location__inner">

      <div class="location__content reveal">
        <span class="eyebrow"><?php esc_html_e('Ubicación', 'casadeltorero'); ?></span>
        <h2 class="location__title"><?php echo esc_html(cdt_field('ubicacion_titulo', 'Vejer — el pueblo blanco más bello de Cádiz')); ?></h2>
        <p class="location__text">
          <?php echo esc_html(cdt_field('ubicacion_texto', 'La Casa del Torero se asienta sobre una colina frente al pueblo blanco de Vejer, con vistas espectaculares a la Laguna de La Janda, las marismas de Barbate y la Costa de la Luz. En días claros, la silueta de Marruecos es visible al otro lado del Estrecho.')); ?>
        </p>

        <div class="location__points">
          <?php
          $puntos = function_exists('get_field') ? get_field('puntos_ubicacion') : null;
          if ($puntos) :
            foreach ($puntos as $p) :
          ?>
            <div class="loc-point">
              <div class="loc-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 0-8 8c0 5.333 8 14 8 14s8-8.667 8-14a8 8 0 0 0-8-8z"/></svg>
              </div>
              <div>
                <strong><?php echo esc_html($p['nombre']); ?></strong>
                <span><?php echo esc_html($p['distancia']); ?></span>
              </div>
            </div>
          <?php
            endforeach;
          else :
            $default_puntos = [
              ['Centro de Vejer', 'A pocos minutos en coche'],
              ['Playas de El Palmar, Zahara, Caños de Meca', '11 km · Costa de la Luz'],
              ['Tarifa — surf y kitesurf', '35 km'],
              ['Aeropuerto de Jerez (XRY)', '45 minutos en coche'],
              ['Aeropuerto de Málaga', '1 h 30 min en coche'],
            ];
            foreach ($default_puntos as $p) :
          ?>
            <div class="loc-point">
              <div class="loc-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 0-8 8c0 5.333 8 14 8 14s8-8.667 8-14a8 8 0 0 0-8-8z"/></svg>
              </div>
              <div>
                <strong><?php echo esc_html($p[0]); ?></strong>
                <span><?php echo esc_html($p[1]); ?></span>
              </div>
            </div>
          <?php
            endforeach;
          endif;
          ?>
        </div>

        <a href="#reservas" class="btn btn--dark"><?php esc_html_e('Reservar ahora', 'casadeltorero'); ?></a>
      </div>

      <div class="location__map reveal reveal-delay-1">
        <?php
        $map_embed = cdt_field('map_embed');
        if ($map_embed) {
            echo wp_kses($map_embed, ['iframe' => ['src' => [], 'width' => [], 'height' => [], 'title' => [], 'loading' => [], 'allowfullscreen' => [], 'style' => [], 'frameborder' => []]]);
        } else {
        ?>
          <iframe
            src="https://www.openstreetmap.org/export/embed.html?bbox=-5.9900%2C36.2300%2C-5.9400%2C36.2700&layer=mapnik&marker=36.2516%2C-5.9699"
            title="Vejer — La Casa del Torero"
            width="100%" height="100%"
            loading="lazy"
            allowfullscreen
          ></iframe>
        <?php } ?>
      </div>

    </div>
  </div>
</section>


<?php /* ══════════════════════════════════════════
   CTA BANNER
══════════════════════════════════════════ */ ?>
<section class="cta-banner" id="contacto">
  <?php
  $cta_bg = cdt_field('cta_bg');
  if ($cta_bg) :
  ?>
    <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url($cta_bg); ?>')"></div>
  <?php endif; ?>

  <div class="container">
    <div class="cta-banner__content reveal">
      <span class="eyebrow" style="color:var(--color-gold-lt)"><?php esc_html_e('Contacto & Reservas', 'casadeltorero'); ?></span>
      <h2 class="cta-banner__title"><?php echo nl2br(esc_html(cdt_field('cta_titulo', "Vejer os espera.\n¿Cuándo venís?"))); ?></h2>
      <p class="cta-banner__text"><?php echo esc_html(cdt_field('cta_texto', 'Cada estancia en La Casa del Torero es irrepetible. Olivos centenarios, cielos infinitos y el mar a 11 km. Reserva directamente y asegura vuestras fechas.')); ?></p>
      <div class="cta-banner__actions">
        <a href="#reservas" class="btn btn--primary"><?php esc_html_e('Reservar ahora', 'casadeltorero'); ?></a>
        <a href="mailto:<?php echo esc_attr(get_field('contact_email', 'option') ?: 'info@lacasadeltorero.com'); ?>" class="btn btn--outline"><?php esc_html_e('Escribirnos', 'casadeltorero'); ?></a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
