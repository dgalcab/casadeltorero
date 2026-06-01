<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" role="banner">
  <div class="container">

    <!-- Logo: blanco sobre hero, oscuro al hacer scroll -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php bloginfo('name'); ?> — Inicio">
      <?php
      $logo_white = function_exists('get_field') ? get_field('logo_white', 'option') : null;
      $logo_dark  = function_exists('get_field') ? get_field('logo_dark',  'option') : null;

      if ($logo_white && !empty($logo_white['url'])) :
      ?>
        <!-- Logo blanco — visible sobre el hero oscuro -->
        <img
          class="logo logo--white"
          src="<?php echo esc_url($logo_white['url']); ?>"
          alt="<?php bloginfo('name'); ?>"
          width="<?php echo esc_attr($logo_white['width'] ?? ''); ?>"
          height="<?php echo esc_attr($logo_white['height'] ?? ''); ?>"
        >
        <?php if ($logo_dark && !empty($logo_dark['url'])) : ?>
        <!-- Logo oscuro — visible cuando el header se vuelve blanco -->
        <img
          class="logo logo--dark"
          src="<?php echo esc_url($logo_dark['url']); ?>"
          alt="<?php bloginfo('name'); ?>"
          width="<?php echo esc_attr($logo_dark['width'] ?? ''); ?>"
          height="<?php echo esc_attr($logo_dark['height'] ?? ''); ?>"
        >
        <?php endif; ?>
      <?php elseif (has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <span class="logo-text">
          <?php bloginfo('name'); ?>
          <small><?php bloginfo('description'); ?></small>
        </span>
      <?php endif; ?>
    </a>

    <button class="nav-toggle" aria-label="<?php esc_attr_e('Abrir menú', 'casadeltorero'); ?>" aria-expanded="false" aria-controls="primary-nav">
      <span></span><span></span><span></span>
    </button>

    <nav id="primary-nav" class="primary-nav" role="navigation" aria-label="<?php esc_attr_e('Menú principal', 'casadeltorero'); ?>">
      <?php
      wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'fallback_cb'    => function () {
              $pages = [
                  '#la-casa'       => __('La Casa',      'casadeltorero'),
                  '#la-finca'      => __('La Finca',     'casadeltorero'),
                  '#espacios'      => __('Espacios',     'casadeltorero'),
                  '#experiencias'  => __('Experiencias', 'casadeltorero'),
                  '#ubicacion'     => __('Ubicación',    'casadeltorero'),
              ];
              foreach ($pages as $url => $label) {
                  printf('<a href="%s">%s</a>', esc_attr($url), esc_html($label));
              }
          },
      ]);
      ?>
      <a href="#reservas" class="nav-cta"><?php esc_html_e('Reservar', 'casadeltorero'); ?></a>
    </nav>

  </div>
</header>
