<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="site-header<?php echo is_front_page() ? '' : ' solid'; ?>">
  <div class="container">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="La Casa del Torero">
      <?php get_template_part('inc/logo'); ?>
      <span class="site-logo__name">La Casa del Torero<em>Vejer · Cádiz</em></span>
    </a>

    <button class="nav-toggle" id="navToggle" aria-label="Abrir menú" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

    <nav class="primary-nav" id="primaryNav" role="navigation" aria-label="Menú principal">
      <?php
      wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'primary-nav__list',
          'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
          'depth'          => 1,
          'fallback_cb'    => function () {
              echo '<ul class="primary-nav__list">';
              echo '<li><a href="' . esc_url(home_url('/#habitaciones')) . '">Habitaciones</a></li>';
              echo '<li><a href="' . esc_url(home_url('/#la-casa')) . '">La Casa</a></li>';
              echo '<li><a href="' . esc_url(home_url('/#gastronomia')) . '">Gastronomía</a></li>';
              echo '<li><a href="' . esc_url(home_url('/#experiencias')) . '">Experiencias</a></li>';
              echo '<li><a href="' . esc_url(home_url('/#ubicacion')) . '">Ubicación</a></li>';
              echo '</ul>';
          },
      ]);
      ?>
      <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold nav-cta">Reservar</a>
    </nav>
  </div>
</header>
