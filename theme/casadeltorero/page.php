<?php get_header(); ?>

<main id="main" class="site-main" style="padding-top: 100px;">
  <div class="container" style="padding-top: var(--section-py); padding-bottom: var(--section-py); max-width: 800px;">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article <?php post_class(); ?>>
        <h1 style="font-family: var(--font-serif); font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 2rem;"><?php the_title(); ?></h1>
        <div class="entry-content" style="font-size: 1.0625rem; line-height: 1.8; color: var(--color-muted);"><?php the_content(); ?></div>
      </article>
    <?php endwhile; endif; ?>
  </div>
</main>

<?php get_footer(); ?>
