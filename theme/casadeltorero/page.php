<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<section class="page-hero">
  <?php if (has_post_thumbnail()) : ?>
    <div class="page-hero__img">
      <?php the_post_thumbnail('hero', ['loading' => 'lazy', 'alt' => esc_attr(get_the_title())]); ?>
    </div>
  <?php endif; ?>
  <div class="page-hero__content">
    <div class="container">
      <h1 class="page-hero__title"><?php the_title(); ?></h1>
    </div>
  </div>
</section>

<main id="main" class="page-content">
  <div class="container">
    <div class="page-content__body">
      <?php the_content(); ?>
    </div>
  </div>
</main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
