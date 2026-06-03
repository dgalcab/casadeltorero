<?php
/**
 * Minimal wrapper for OHBE booking engine pages (?ohbe=booking).
 * Keeps our header/footer while letting the plugin render its full UI.
 */
get_header(); ?>

<style>
.ohbe-page-wrap {
  background: var(--cream);
  min-height: 60vh;
  padding: 2rem 0 4rem;
}
.ohbe-page-wrap .container {
  max-width: 1100px;
}
/* Keep our header visible above the plugin UI */
.ohbe-page-wrap > * {
  position: relative;
  z-index: 1;
}
</style>

<div class="ohbe-page-wrap">
  <div class="container">
    <?php echo do_shortcode('[ohbe_search]'); ?>
  </div>
</div>

<?php get_footer(); ?>
