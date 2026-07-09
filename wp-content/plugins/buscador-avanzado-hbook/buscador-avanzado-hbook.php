<?php
/**
 * Plugin Name:       Buscador Avanzado para HBook
 * Plugin URI:        https://www.lacasadeltorero.com
 * Description:       Sistema de filtrado avanzado y combinable en tiempo real (estilo Booking.com) para alojamientos gestionados con el plugin de reservas HBook. Shortcode: [buscador_avanzado_hbook]
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            La Casa del Torero
 * Text Domain:       buscador-avanzado-hbook
 * Domain Path:       /languages
 * License:           GPL v2 or later
 */

defined('ABSPATH') || exit;

define('BAH_VERSION', '1.0.0');
define('BAH_FILE', __FILE__);
define('BAH_PATH', plugin_dir_path(__FILE__));
define('BAH_URL', plugin_dir_url(__FILE__));
define('BAH_BASENAME', plugin_basename(__FILE__));

/**
 * Autocarga simple de las clases del plugin.
 */
spl_autoload_register(function ($class) {
    if (strpos($class, 'BAH_') !== 0) {
        return;
    }

    $file = BAH_PATH . 'includes/class-' . strtolower(str_replace('_', '-', $class)) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

/**
 * Arranque del plugin una vez que todos los plugins están cargados,
 * para poder detectar con seguridad el CPT y las taxonomías de HBook.
 */
function bah_init_plugin()
{
    load_plugin_textdomain('buscador-avanzado-hbook', false, dirname(BAH_BASENAME) . '/languages');

    BAH_Resolver::instance();
    BAH_Settings::instance();
    BAH_Shortcode::instance();
    BAH_Ajax::instance();
}
add_action('plugins_loaded', 'bah_init_plugin');

/**
 * Aviso en el admin si, tras el auto-detectado, no se encuentra ningún
 * post type con alojamientos publicados (ayuda a diagnosticar la integración).
 */
add_action('admin_notices', function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    $screen = get_current_screen();
    if (!$screen || strpos($screen->id, 'buscador-avanzado-hbook') === false) {
        return;
    }

    $post_type = BAH_Resolver::instance()->get_post_type();

    if (!post_type_exists($post_type)) {
        printf(
            '<div class="notice notice-warning"><p>%s</p></div>',
            sprintf(
                /* translators: %s: nombre del post type buscado */
                esc_html__('Buscador Avanzado HBook: no se ha encontrado el tipo de contenido "%s". Revisa que el plugin HBook esté activo o ajusta el tipo de contenido manualmente en los ajustes de abajo.', 'buscador-avanzado-hbook'),
                esc_html($post_type)
            )
        );
    }
});
