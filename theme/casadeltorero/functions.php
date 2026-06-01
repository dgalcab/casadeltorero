<?php
defined('ABSPATH') || exit;

/* ── Theme setup ── */
add_action('after_setup_theme', function () {
    load_theme_textdomain('casadeltorero', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Menú principal', 'casadeltorero'),
        'footer'  => __('Menú footer', 'casadeltorero'),
    ]);
});

/* ── Enqueue assets ── */
add_action('wp_enqueue_scripts', function () {
    $ver = wp_get_theme()->get('Version');
    $uri = get_template_directory_uri();

    // Google Fonts
    wp_enqueue_style(
        'casadeltorero-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Inter:wght@400;500;600&display=swap',
        [],
        null
    );

    wp_enqueue_style('casadeltorero-main', $uri . '/assets/css/main.css', ['casadeltorero-fonts'], $ver);
    wp_enqueue_script('casadeltorero-main', $uri . '/assets/js/main.js', [], $ver, true);
});

/* ── Widget areas ── */
add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __('Footer — Columna derecha', 'casadeltorero'),
        'id'            => 'footer-widget',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ]);
});

/* ── Image sizes ── */
add_action('after_setup_theme', function () {
    add_image_size('hero',        1920, 1080, true);
    add_image_size('space-card',   800, 1066, true);
    add_image_size('experience',   800,  600, true);
});

/* ── ACF options page (if ACF Pro available) ── */
add_action('init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Ajustes del tema',
            'menu_title' => 'Ajustes tema',
            'menu_slug'  => 'casadeltorero-settings',
            'capability' => 'edit_posts',
        ]);
    }
});

/* ── Excerpt length ── */
add_filter('excerpt_length', fn() => 24, 999);

/* ── Customizer ── */
require get_template_directory() . '/inc/customizer.php';
