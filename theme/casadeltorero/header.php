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

    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php bloginfo('name'); ?>">
      <?php
      if (has_custom_logo()) {
          the_custom_logo();
      } else {
          echo esc_html(get_bloginfo('name'));
          echo '<span>' . esc_html(get_bloginfo('description')) . '</span>';
      }
      ?>
    </a>

    <button class="nav-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="primary-nav">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav id="primary-nav" class="primary-nav" role="navigation" aria-label="Menú principal">
      <?php
      wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'fallback_cb'    => function () {
              $pages = [
                  '#la-casa'  => 'La Casa',
                  '#espacios' => 'Espacios',
                  '#reservas' => 'Reservas',
                  '#ubicacion'=> 'Ubicación',
                  '#contacto' => 'Contacto',
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
