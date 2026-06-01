<?php get_header(); ?>

<!-- ════════════════════════════════════════
     HERO
════════════════════════════════════════ -->
<section class="hero" aria-label="La Casa del Torero, Vejer de la Frontera">

  <!-- Vídeo de fondo: sube tu MP4 a la Biblioteca de medios y actualiza la URL -->
  <div class="hero__video-wrap">
    <video
      autoplay muted loop playsinline
      poster="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-poster.jpg'); ?>"
      aria-hidden="true"
      preload="none"
    >
      <source src="<?php echo esc_url(get_theme_mod('hero_video_url', '')); ?>" type="video/mp4">
    </video>
    <!-- Fallback imagen si no hay vídeo -->
    <div class="hero__bg" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero.jpg'); ?>')"></div>
  </div>

  <div class="hero__overlay"></div>
  <div class="hero__deco" aria-hidden="true"></div>

  <div class="hero__content">
    <span class="hero__eyebrow">Casa Rural · Hotel Boutique · Vejer de la Frontera, Cádiz</span>
    <h1 class="hero__title">La Casa<br>del Torero</h1>
    <p class="hero__subtitle">Una finca histórica de 24 hectáreas entre olivos centenarios, a 11 km de las playas vírgenes de la Costa de la Luz.</p>
    <div class="hero__actions">
      <a href="#reservas" class="btn btn--primary">Reservar ahora</a>
      <a href="#la-casa" class="btn btn--outline">Descubrir la finca</a>
    </div>
  </div>

  <div class="hero__badge" aria-label="En días despejados se ve Marruecos">
    <strong>Marruecos visible</strong>
    en días despejados
  </div>

  <div class="hero__scroll" aria-hidden="true">Descubrir</div>
</section>


<!-- ════════════════════════════════════════
     INTRO STRIP
════════════════════════════════════════ -->
<div class="intro-strip">
  <div class="container">
    <div class="intro-strip__inner">
      <div class="intro-strip__item">
        <p class="intro-strip__label">Capacidad</p>
        <p class="intro-strip__value">Hasta 10 huéspedes</p>
      </div>
      <div class="intro-strip__item">
        <p class="intro-strip__label">Alquiler</p>
        <p class="intro-strip__value">Casa completa exclusiva</p>
      </div>
      <div class="intro-strip__item">
        <p class="intro-strip__label">Ubicación</p>
        <p class="intro-strip__value">Ronda, Málaga</p>
      </div>
    </div>
  </div>
</div>


<!-- ════════════════════════════════════════
     ABOUT — LA CASA
════════════════════════════════════════ -->
<section id="la-casa" class="about">
  <div class="container">
    <div class="about__inner">

      <div class="about__image-wrap reveal">
        <img
          class="about__image-main"
          src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-main.jpg'); ?>"
          alt="Fachada de La Casa del Torero"
          width="640"
          height="800"
          loading="lazy"
        >
        <img
          class="about__image-accent"
          src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-detail.jpg'); ?>"
          alt="Detalle interior"
          width="320"
          height="320"
          loading="lazy"
        >
      </div>

      <div class="about__content reveal reveal-delay-1">
        <span class="eyebrow">La Casa</span>
        <h2 class="about__title">Una joya en el corazón de Andalucía</h2>
        <p class="about__text">
          Situada en un enclave único, La Casa del Torero es una propiedad histórica rehabilitada con mimo y criterio donde conviven la arquitectura tradicional andaluza y los más altos estándares de confort contemporáneo.
        </p>
        <p class="about__text">
          Cada rincón ha sido diseñado para ofrecer una experiencia de alojamiento verdaderamente singular: espacios luminosos, materiales nobles y una atmósfera que invita a la desconexión total.
        </p>

        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <div class="about__detail-text">
            <strong>Casa completa en exclusiva</strong>
            <span>Disfrutad de toda la propiedad solo para vosotros</span>
          </div>
        </div>

        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <div class="about__detail-text">
            <strong>Check-in flexible</strong>
            <span>Nos adaptamos a vuestros horarios</span>
          </div>
        </div>

        <div class="about__detail">
          <svg class="about__detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <div class="about__detail-text">
            <strong>Atención personalizada</strong>
            <span>Siempre disponibles para lo que necesitéis</span>
          </div>
        </div>

        <a href="#espacios" class="btn btn--dark">Ver espacios</a>
      </div>

    </div>
  </div>
</section>


<!-- ════════════════════════════════════════
     SPACES
════════════════════════════════════════ -->
<section id="espacios" class="spaces">
  <div class="container">
    <header class="spaces__header reveal">
      <span class="eyebrow">Los Espacios</span>
      <h2 class="section-title">Cada rincón, una experiencia</h2>
      <p class="section-body">Habitaciones, salones y jardines concebidos para el descanso absoluto y el placer de estar.</p>
    </header>
  </div>

  <div class="spaces__grid">

    <div class="space-card reveal">
      <img
        class="space-card__img"
        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/space-suite.jpg'); ?>"
        alt="Suite principal"
        width="600"
        height="800"
        loading="lazy"
      >
      <div class="space-card__overlay">
        <span class="space-card__tag">Dormitorio</span>
        <h3 class="space-card__name">Suite Principal</h3>
        <p class="space-card__desc">Cama king-size, baño en suite con bañera exenta y vistas al campo.</p>
      </div>
    </div>

    <div class="space-card reveal reveal-delay-1">
      <img
        class="space-card__img"
        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/space-salon.jpg'); ?>"
        alt="Salón principal"
        width="600"
        height="800"
        loading="lazy"
      >
      <div class="space-card__overlay">
        <span class="space-card__tag">Salón</span>
        <h3 class="space-card__name">Gran Salón</h3>
        <p class="space-card__desc">Techos altos, chimenea de leña y sofás de diseño para los mejores momentos.</p>
      </div>
    </div>

    <div class="space-card reveal reveal-delay-2">
      <img
        class="space-card__img"
        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/space-patio.jpg'); ?>"
        alt="Patio andaluz"
        width="600"
        height="800"
        loading="lazy"
      >
      <div class="space-card__overlay">
        <span class="space-card__tag">Exterior</span>
        <h3 class="space-card__name">Patio Andaluz</h3>
        <p class="space-card__desc">Patio tradicional con piscina privada, pérgola y zona de comedor exterior.</p>
      </div>
    </div>

  </div>
</section>


<!-- ════════════════════════════════════════
     EXPERIENCE / AMENITIES
════════════════════════════════════════ -->
<section id="experiencias" class="experience">
  <div class="container">
    <div class="experience__inner">

      <div class="experience__content reveal">
        <span class="eyebrow">La Experiencia</span>
        <h2 class="experience__title">Todo lo que necesitáis está aquí</h2>
        <p class="experience__lead">
          Desde el momento en que cruzáis la puerta, nos ocupamos de que no os falte de nada. La casa está equipada al más alto nivel para que vuestra estancia sea perfecta.
        </p>

        <ul class="amenities-list">
          <li class="amenity">Piscina privada</li>
          <li class="amenity">Wifi de alta velocidad</li>
          <li class="amenity">Cocina totalmente equipada</li>
          <li class="amenity">Aire acondicionado</li>
          <li class="amenity">Chimenea de leña</li>
          <li class="amenity">Smart TV en todas las estancias</li>
          <li class="amenity">Ropa de cama de lujo</li>
          <li class="amenity">Terraza con vistas</li>
          <li class="amenity">Parking privado</li>
          <li class="amenity">Cuna y trona disponibles</li>
          <li class="amenity">Admite mascotas (consultar)</li>
          <li class="amenity">Zona de barbacoa</li>
        </ul>

        <a href="#reservas" class="btn btn--dark">Consultar disponibilidad</a>
      </div>

      <div class="experience__visual reveal reveal-delay-1">
        <div class="experience__image-grid">
          <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/exp-main.jpg'); ?>"
            alt="Interior de la casa"
            width="400"
            height="560"
            loading="lazy"
          >
          <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/exp-detail1.jpg'); ?>"
            alt="Detalle cocina"
            width="400"
            height="270"
            loading="lazy"
          >
          <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/exp-detail2.jpg'); ?>"
            alt="Detalle baño"
            width="400"
            height="270"
            loading="lazy"
          >
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ════════════════════════════════════════
     BOOKING — REDFORS
════════════════════════════════════════ -->
<section id="reservas" class="booking">
  <div class="container">
    <header class="booking__header reveal">
      <span class="eyebrow">Reservas</span>
      <h2 class="section-title">Comprueba disponibilidad</h2>
      <p>Reserva directamente y obtén las mejores condiciones. Pago seguro y confirmación inmediata.</p>
    </header>

    <div class="booking__engine reveal reveal-delay-1">
      <?php
      /*
       * Aquí va el shortcode del plugin Redfors Hotel.
       * Sustituye [redfors_booking] por el shortcode real de tu instalación.
       * Ejemplo habitual: [redfors id="1"] o [redfors_booking_engine]
       */
      if (shortcode_exists('redfors_booking')) {
          echo do_shortcode('[redfors_booking]');
      } else {
          // Placeholder visual hasta activar el plugin
          ?>
          <div style="text-align:center; padding: 3rem; color: #7A7065; font-family: 'Inter', sans-serif;">
            <p style="font-size:0.875rem; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:1rem;">Motor de reservas</p>
            <p style="font-size:1.5rem; font-family:'Cormorant Garamond',serif; margin-bottom:2rem;">Activa el plugin Redfors Hotel<br>para mostrar el motor de reservas aquí.</p>
            <p>Mientras tanto, puedes contactarnos en <a href="mailto:info@lacasadeltorero.com" style="color:#B8965A;">info@lacasadeltorero.com</a></p>
          </div>
          <?php
      }
      ?>
    </div>
  </div>
</section>


<!-- ════════════════════════════════════════
     TESTIMONIALS
════════════════════════════════════════ -->
<section class="testimonials">
  <div class="container">
    <header class="testimonials__header reveal">
      <span class="eyebrow">Opiniones</span>
      <h2 class="section-title">Lo que dicen nuestros huéspedes</h2>
    </header>

    <div class="testimonials__track">

      <div class="testimonial-card reveal">
        <p class="testimonial-card__stars">★★★★★</p>
        <p class="testimonial-card__text">Una casa absolutamente increíble. Los espacios son mágicos, la decoración impecable y la atención de los propietarios, diez sobre diez. Volveremos sin dudarlo.</p>
        <div class="testimonial-card__author">
          <div>
            <p class="testimonial-card__name">María G.</p>
            <p class="testimonial-card__origin">Madrid · Agosto 2024</p>
          </div>
        </div>
      </div>

      <div class="testimonial-card reveal reveal-delay-1">
        <p class="testimonial-card__stars">★★★★★</p>
        <p class="testimonial-card__text">Ronda ya es preciosa, pero La Casa del Torero le añade una capa de magia especial. La piscina, los patios, la luz... todo perfecto para desconectar.</p>
        <div class="testimonial-card__author">
          <div>
            <p class="testimonial-card__name">Carlos y Beatriz</p>
            <p class="testimonial-card__origin">Valencia · Julio 2024</p>
          </div>
        </div>
      </div>

      <div class="testimonial-card reveal reveal-delay-2">
        <p class="testimonial-card__stars">★★★★★</p>
        <p class="testimonial-card__text">We stayed for a week and it felt like living in a dream. The house is stunning, incredibly well-equipped and the location is perfect. Highly recommended.</p>
        <div class="testimonial-card__author">
          <div>
            <p class="testimonial-card__name">Sophie & James</p>
            <p class="testimonial-card__origin">London · May 2024</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ════════════════════════════════════════
     LOCATION
════════════════════════════════════════ -->
<section id="ubicacion" class="location">
  <div class="container">
    <div class="location__inner">

      <div class="location__content reveal">
        <span class="eyebrow">Ubicación</span>
        <h2 class="location__title">En el corazón de Ronda</h2>
        <p class="location__text">
          Situada en uno de los enclaves más espectaculares de Andalucía, La Casa del Torero está a pocos pasos del centro histórico de Ronda y a un paso de los mejores paisajes de la Serranía de Málaga.
        </p>

        <div class="location__points">
          <div class="location__point">
            <div class="location__point-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 0-8 8c0 5.333 8 14 8 14s8-8.667 8-14a8 8 0 0 0-8-8z"/></svg>
            </div>
            <div>
              <strong>Centro histórico de Ronda</strong>
              <span>A 5 minutos a pie</span>
            </div>
          </div>
          <div class="location__point">
            <div class="location__point-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            </div>
            <div>
              <strong>Puente Nuevo</strong>
              <span>A 8 minutos a pie</span>
            </div>
          </div>
          <div class="location__point">
            <div class="location__point-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </div>
            <div>
              <strong>Málaga capital</strong>
              <span>1 hora en coche</span>
            </div>
          </div>
          <div class="location__point">
            <div class="location__point-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div>
              <strong>Aeropuerto de Málaga</strong>
              <span>1h 15min en coche</span>
            </div>
          </div>
        </div>

        <a href="#contacto" class="btn btn--dark">Contactar</a>
      </div>

      <div class="location__map reveal reveal-delay-1">
        <!--
          Sustituye las coordenadas por las reales de la propiedad.
          También puedes usar Google Maps Embed API con tu API key.
        -->
        <iframe
          src="https://www.openstreetmap.org/export/embed.html?bbox=-5.1840%2C36.7400%2C-5.1600%2C36.7500&amp;layer=mapnik&amp;marker=36.7450%2C-5.1720"
          width="600"
          height="480"
          loading="lazy"
          title="Ubicación de La Casa del Torero en Ronda"
          allowfullscreen
        ></iframe>
      </div>

    </div>
  </div>
</section>


<!-- ════════════════════════════════════════
     CTA BANNER
════════════════════════════════════════ -->
<section class="cta-banner" id="contacto">
  <div class="cta-banner__bg" role="img" aria-label="Vista de la propiedad"></div>
  <div class="cta-banner__overlay"></div>
  <div class="container">
    <div class="cta-banner__content reveal">
      <h2 class="cta-banner__title">¿Listo para vivir<br>la experiencia?</h2>
      <p class="cta-banner__text">Cada estancia en La Casa del Torero es única. Reserva ahora y asegura tus fechas antes de que se agoten.</p>
      <div class="cta-banner__actions">
        <a href="#reservas" class="btn btn--primary">Reservar ahora</a>
        <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@lacasadeltorero.com')); ?>" class="btn btn--outline">Escribirnos</a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
