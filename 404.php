<?php get_header(); ?>

<style>
.page-404 { min-height: 100vh; background: var(--blue); display: flex; align-items: center; justify-content: center; text-align: center; padding: 4rem 2rem; }
.page-404__inner { max-width: 540px; }
.page-404__num { font-family: var(--serif); font-size: clamp(6rem,15vw,12rem); font-weight: 300; color: var(--gold); line-height: 1; margin-bottom: 1rem; opacity: .7; }
.page-404 h1 { font-family: var(--serif); font-size: clamp(1.75rem,3vw,2.5rem); color: var(--white); margin-bottom: 1rem; font-weight: 300; }
.page-404 p { color: rgba(255,255,255,.55); line-height: 1.7; margin-bottom: 2.5rem; }
</style>

<main id="main" class="page-404">
  <div class="page-404__inner">
    <p class="page-404__num">404</p>
    <h1><?php esc_html_e('Página no encontrada', 'casadeltorero'); ?></h1>
    <p><?php esc_html_e('Lo sentimos, la página que buscas no existe o ha sido movida. Quizás quieras volver al inicio y explorar La Casa del Torero.', 'casadeltorero'); ?></p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--gold"><?php esc_html_e('Volver al inicio', 'casadeltorero'); ?></a>
  </div>
</main>

<?php get_footer(); ?>
