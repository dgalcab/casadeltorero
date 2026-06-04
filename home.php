<?php get_header(); ?>

<style>
.blog-archive { background: var(--cream); }
.blog-archive .container { padding-top: var(--py); padding-bottom: var(--py); }
.blog-intro { background: var(--white); border-bottom: 1px solid var(--border); }
.blog-intro .container { padding-top: 4rem; padding-bottom: 4rem; }
.blog-intro__inner { max-width: 820px; margin: 0 auto; text-align: center; }
.blog-intro__title { font-family: var(--serif); font-size: clamp(1.5rem,3vw,2.1rem); line-height: 1.25; margin: 1rem 0 1.25rem; color: var(--blue); }
.blog-intro__body { text-align: left; margin-top: 2rem; display: grid; gap: 1.25rem; }
.blog-intro__body p { font-size: .95rem; line-height: 1.85; color: var(--text); }
.blog-intro__body strong { color: var(--blue); font-weight: 600; }
.blog-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 2rem; padding: var(--py) 0; }
.blog-card { background: var(--white); display: flex; flex-direction: column; transition: box-shadow var(--ease); }
.blog-card:hover { box-shadow: 0 12px 40px rgba(0,0,0,.1); }
.blog-card__img { width: 100%; aspect-ratio: 16/10; object-fit: cover; display: block; overflow: hidden; }
.blog-card__img img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s ease; }
.blog-card:hover .blog-card__img img { transform: scale(1.04); }
.blog-card__body { padding: 1.75rem; display: flex; flex-direction: column; flex: 1; }
.blog-card__cat { font-family: var(--sans); font-size: .6rem; letter-spacing: .22em; text-transform: uppercase; color: var(--gold); margin-bottom: .75rem; }
.blog-card__title { font-family: var(--serif); font-size: 1.35rem; line-height: 1.3; margin-bottom: .75rem; }
.blog-card__title a { color: var(--text); text-decoration: none; }
.blog-card__title a:hover { color: var(--gold); }
.blog-card__excerpt { font-size: .875rem; color: var(--muted); line-height: 1.7; flex: 1; margin-bottom: 1.25rem; }
.blog-card__meta { display: flex; justify-content: space-between; align-items: center; font-size: .75rem; color: var(--muted); }
.blog-card__more { color: var(--gold); text-decoration: none; font-weight: 500; letter-spacing: .04em; }
.blog-card__more:hover { color: var(--blue); }
.blog-archive .wp-pagenavi, .blog-archive .navigation { text-align: center; padding: 2rem 0 var(--py); }
.blog-archive .nav-links { display: flex; justify-content: center; gap: 1rem; }
.blog-archive .nav-links a, .blog-archive .nav-links span { font-family: var(--sans); font-size: .75rem; letter-spacing: .12em; text-transform: uppercase; color: var(--muted); border: 1px solid var(--border); padding: .6rem 1.1rem; transition: color var(--ease), border-color var(--ease); }
.blog-archive .nav-links a:hover { color: var(--gold); border-color: var(--gold); }
.blog-archive .nav-links .current { color: var(--gold); border-color: var(--gold); }
@media(max-width:1024px){ .blog-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:640px){ .blog-grid { grid-template-columns: 1fr; } }
</style>

<section class="page-hero" style="--hero-bg:url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/casa/piscina.jpg')">
  <div class="container page-hero__inner">
    <span class="eyebrow">Inspiración · Experiencias · Guías</span>
    <h1>El Blog</h1>
    <div class="gold-rule"></div>
  </div>
</section>

<main class="blog-archive">

  <!-- ── Intro editorial SEO ── -->
  <div class="blog-intro">
    <div class="container">
      <div class="blog-intro__inner reveal">
        <span class="eyebrow">Casa rural de lujo · Vejer de la Frontera, Cádiz</span>
        <h2 class="blog-intro__title">La Casa del Torero: una finca histórica en el corazón de Andalucía</h2>
        <div class="gold-rule"></div>
        <div class="blog-intro__body">
          <p><strong>La Casa del Torero</strong> es una <strong>casa rural de lujo en Vejer de la Frontera</strong> con 24 hectáreas de campo abierto entre olivos centenarios, a tan solo 11 km de las playas vírgenes de la Costa de la Luz. Una finca histórica diseñada por un torero, hoy reconvertida en un alojamiento boutique que combina la autenticidad andaluza con el confort más cuidado.</p>
          <p>La finca ofrece cuatro espacios únicos — la <strong>Suite del Torero</strong>, la <strong>Habitación Doble Superior</strong>, la <strong>Habitación Doble</strong> y el <strong>Apartamento independiente</strong> — todos con desayuno continental incluido, terraza privada y vistas al campo. También es posible <strong>alquilar la casa completa</strong> para celebraciones, retiros o escapadas en grupo de hasta 10 personas con total exclusividad.</p>
          <p>A 15 minutos de playas como El Palmar, Zahora o Caños de Meca, y a un paso del casco histórico de Vejer — uno de los pueblos más bonitos de España —, La Casa del Torero es el punto de partida perfecto para descubrir la Costa de la Luz, la gastronomía de la Bahía de Cádiz y los paisajes únicos de la sierra del Aljibe. En este blog encontrarás inspiración para tu estancia: qué ver, qué comer, qué vivir.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Grid -->
  <div class="container">
    <?php if ( have_posts() ) : ?>
    <div class="blog-grid">
      <?php while ( have_posts() ) : the_post(); ?>
      <article class="blog-card reveal" id="post-<?php the_ID(); ?>">

        <!-- Featured image -->
        <div class="blog-card__img">
          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
              <?php the_post_thumbnail( 'large', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
            </a>
          <?php else : ?>
            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/galeria/g01.jpg' ); ?>"
                   alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
            </a>
          <?php endif; ?>
        </div>

        <!-- Body -->
        <div class="blog-card__body">

          <!-- Category -->
          <?php
          $cats = get_the_category();
          if ( $cats ) :
          ?>
          <span class="blog-card__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
          <?php endif; ?>

          <!-- Title -->
          <h2 class="blog-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>

          <!-- Excerpt -->
          <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 22, '…' ); ?></p>

          <!-- Meta -->
          <div class="blog-card__meta">
            <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date( 'j M Y' ); ?></time>
            <a href="<?php the_permalink(); ?>" class="blog-card__more">Leer más →</a>
          </div>

        </div>
      </article>
      <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Paginación del blog">
      <?php the_posts_pagination( [
        'mid_size'  => 2,
        'prev_text' => '← Anterior',
        'next_text' => 'Siguiente →',
      ] ); ?>
    </nav>

    <?php else : ?>
    <p style="text-align:center; padding: var(--py) 0; color: var(--muted);">
      Próximamente publicaremos artículos sobre Vejer, la Costa de la Luz y las mejores experiencias de la zona.
    </p>
    <?php endif; ?>
  </div>

</main>

<?php get_footer(); ?>
