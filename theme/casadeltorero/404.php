<?php get_header(); ?>

<main id="main" class="page-404">
  <div class="page-404__inner">
    <p class="page-404__code">404</p>
    <h1 class="page-404__title">Página no encontrada</h1>
    <p class="page-404__text">Lo sentimos, la página que buscas no existe o ha sido movida.<br>Quizás quieras volver al inicio y explorar La Casa del Torero.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--gold">Volver al inicio</a>
  </div>
</main>

<?php get_footer(); ?>
