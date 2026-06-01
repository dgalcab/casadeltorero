<?php get_header(); ?>

<main id="main" class="site-main" style="padding-top: 100px;">
  <div class="container" style="padding-top: var(--section-py); padding-bottom: var(--section-py);">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
      </article>
    <?php endwhile; endif; ?>
  </div>
</main>

<?php get_footer(); ?>
