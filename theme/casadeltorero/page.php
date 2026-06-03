<?php get_header(); ?>

<style>
.page-hero-simple { background: var(--blue); padding: clamp(5rem,8vw,8rem) 0 clamp(3rem,5vw,5rem); text-align: center; }
.page-hero-simple h1 { font-family: var(--serif); font-size: clamp(2.5rem,5vw,4rem); color: var(--white); font-weight: 300; }
.page-hero-simple .eyebrow { color: var(--gold-lt); display: block; margin-bottom: 1rem; }
.page-body-wrap { background: var(--white); padding: var(--py) 0; }
.page-body { max-width: 780px; margin-inline: auto; padding: 0 1.5rem; }
.page-body h2, .page-body h3 { font-family: var(--serif); color: var(--text); margin: 2rem 0 .75rem; }
.page-body p { font-size: 1.0625rem; line-height: 1.85; color: var(--text); margin-bottom: 1.25rem; }
.page-body ul, .page-body ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
.page-body li { line-height: 1.75; margin-bottom: .4rem; color: var(--text); }
.page-body a { color: var(--gold); }
.page-body a:hover { color: var(--blue); }
</style>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<section class="page-hero-simple" aria-label="<?php echo esc_attr(get_the_title()); ?>">
  <div class="container">
    <span class="eyebrow">La Casa del Torero</span>
    <h1 class="reveal"><?php the_title(); ?></h1>
  </div>
</section>

<div class="page-body-wrap">
  <main id="main" class="page-body reveal">
    <?php the_content(); ?>
  </main>
</div>

<?php endwhile; endif; ?>

<!-- CTA -->
<section class="cta-banner" aria-label="Reserva tu estancia">
  <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/casa/aerea.jpg')"></div>
  <div class="container cta-banner__inner reveal">
    <span class="eyebrow">Reserva directa</span>
    <h2 class="cta-banner__title">¿Listo para reservar?</h2>
    <div class="gold-rule"></div>
    <p class="cta-banner__text">Comprueba disponibilidad y reserva directamente con nosotros, sin intermediarios y con las mejores condiciones.</p>
    <div class="cta-banner__actions">
      <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold">Ver disponibilidad</a>
      <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn--ghost">Contactar</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
