<?php
/**
 * Template Name: Motor de Reservas (OHBE)
 * Página contenedora para los resultados del motor de reservas Redforts.
 * Slug recomendado: ohbe
 */
get_header(); ?>

<style>
.ohbe-container {
  background: var(--cream);
  min-height: 70vh;
  padding: 2rem 0 4rem;
}
.ohbe-container .container {
  max-width: 1140px;
}
</style>

<div class="ohbe-container">
  <div class="container">
    <?php echo do_shortcode('[ohbe_search]'); ?>
  </div>
</div>

<?php get_footer(); ?>
