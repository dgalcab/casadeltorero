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
    add_image_size('hero',              1920, 1080, true);
    add_image_size('space-card',         800, 1066, true);
    add_image_size('experience',         800,  600, true);
    add_image_size('habitacion-gallery', 1200,  900, true);
});

/* ── CPT: Habitacion ── */
add_action('init', function () {
    register_post_type('habitacion', [
        'labels' => [
            'name'               => __('Habitaciones', 'casadeltorero'),
            'singular_name'      => __('Habitación', 'casadeltorero'),
            'add_new'            => __('Añadir habitación', 'casadeltorero'),
            'add_new_item'       => __('Añadir habitación', 'casadeltorero'),
            'edit_item'          => __('Editar habitación', 'casadeltorero'),
            'view_item'          => __('Ver habitación', 'casadeltorero'),
            'all_items'          => __('Todas las habitaciones', 'casadeltorero'),
            'search_items'       => __('Buscar habitaciones', 'casadeltorero'),
            'not_found'          => __('No se encontraron habitaciones', 'casadeltorero'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'has_archive'  => true,
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'rewrite'      => ['slug' => 'habitaciones'],
        'menu_icon'    => 'dashicons-bed',
        'menu_position' => 5,
    ]);
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

/* ══════════════════════════════════════════════
   SEO
══════════════════════════════════════════════ */

/* Preconectar con Google Fonts para adelantar la carga de tipografía */
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1);

/* No indexar la página 404 */
add_action('wp_head', function () {
    if (is_404()) {
        echo '<meta name="robots" content="noindex,follow">' . "\n";
    }
}, 1);

/**
 * ¿Hay un plugin SEO dedicado activo? Si lo hay, ese plugin ya gestiona
 * meta description, Open Graph y Twitter Card — el tema no debe duplicar
 * ni pisar sus etiquetas.
 */
function casadeltorero_has_seo_plugin() {
    return defined('WPSEO_VERSION')                // Yoast SEO
        || defined('RANK_MATH_VERSION')             // Rank Math
        || class_exists('RankMath')
        || defined('SEOPRESS_VERSION')              // SEOPress
        || defined('AIOSEO_VERSION')                // All in One SEO (v4+)
        || defined('AIOSEOP_VERSION');               // All in One SEO Pack (legado)
}

/**
 * Título, descripción, imagen y tipo Open Graph para la vista actual.
 * Devuelve null en vistas que no necesitan estas etiquetas (404, búsqueda...).
 */
function casadeltorero_seo_meta() {
    $has_acf       = function_exists('get_field');
    $site          = get_bloginfo('name');
    $img_base      = get_template_directory_uri() . '/assets/img';
    $default_image = $img_base . '/casa/aerea.jpg';

    if (is_front_page()) {
        $desc = ($has_acf ? get_field('hero_subtitle') : '') ?: 'Casa rural de lujo en Vejer de la Frontera, Cádiz. Finca histórica de 24 hectáreas entre olivos centenarios, a 11 km de las playas vírgenes de la Costa de la Luz.';
        return [
            'title'       => $site . ' — Casa rural de lujo en Vejer de la Frontera, Cádiz',
            'description' => $desc,
            'image'       => $default_image,
            'type'        => 'website',
            'url'         => home_url('/'),
        ];
    }

    if (is_singular('habitacion')) {
        $eyebrow = $has_acf ? get_field('hab_eyebrow') : '';
        $size    = $has_acf ? get_field('hab_size')    : '';
        $price   = $has_acf ? get_field('hab_price')   : '';
        $desc    = ($eyebrow ?: get_the_title()) . ' en La Casa del Torero, Vejer de la Frontera. '
                 . implode('. ', array_filter([$size, $price]))
                 . ($size || $price ? '. ' : '')
                 . 'Terraza privada, desayuno incluido y acceso a 24 hectáreas de campo.';
        return [
            'title'       => get_the_title() . ' — ' . $site,
            'description' => $desc,
            'image'       => get_the_post_thumbnail_url(get_the_ID(), 'hero') ?: $default_image,
            'type'        => 'website',
            'url'         => get_permalink(),
        ];
    }

    if (is_singular('post')) {
        $desc = get_the_excerpt() ?: wp_trim_words(wp_strip_all_tags(get_the_content()), 30);
        return [
            'title'       => get_the_title() . ' — ' . $site,
            'description' => wp_strip_all_tags($desc),
            'image'       => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: ($img_base . '/galeria/g01.jpg'),
            'type'        => 'article',
            'url'         => get_permalink(),
        ];
    }

    if (is_post_type_archive('habitacion')) {
        return [
            'title'       => 'Las Habitaciones — ' . $site,
            'description' => 'Descubre las habitaciones de La Casa del Torero: Suite del Torero, Doble Superior, Habitación Doble y Apartamento Panorámico, en una finca de 24 hectáreas en Vejer de la Frontera, Cádiz.',
            'image'       => $img_base . '/espacios/hab-slide-1.jpg',
            'type'        => 'website',
            'url'         => get_post_type_archive_link('habitacion'),
        ];
    }

    if (is_home()) {
        $blog_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/');
        return [
            'title'       => 'Blog — ' . $site,
            'description' => 'Inspiración, guías y experiencias sobre Vejer de la Frontera, la Costa de la Luz y La Casa del Torero.',
            'image'       => $img_base . '/casa/piscina.jpg',
            'type'        => 'website',
            'url'         => $blog_url,
        ];
    }

    if (is_page()) {
        $per_template = [
            'template-contact.php' => [
                'title'       => 'Contacto — ' . $site,
                'description' => 'Contacta con La Casa del Torero en Vejer de la Frontera, Cádiz. Reservas, consultas o información general — respondemos en menos de 24 horas.',
                'image'       => $img_base . '/casa/aerea.jpg',
            ],
            'template-reservas.php' => [
                'title'       => 'Reservas — ' . $site,
                'description' => 'Reserva directamente tu estancia en La Casa del Torero, Vejer de la Frontera. Mejor precio garantizado, confirmación inmediata y sin intermediarios.',
                'image'       => $img_base . '/casa/piscina.jpg',
            ],
            'template-habitaciones.php' => [
                'title'       => 'Las Habitaciones — ' . $site,
                'description' => 'Cuatro espacios únicos en La Casa del Torero: cada uno con terraza privada, vistas a Vejer y acceso al campo. Desayuno continental incluido.',
                'image'       => $img_base . '/espacios/hab-slide-1.jpg',
            ],
        ];
        $tpl = get_page_template_slug();
        if (isset($per_template[$tpl])) {
            $m = $per_template[$tpl];
            return [
                'title'       => $m['title'],
                'description' => $m['description'],
                'image'       => $m['image'],
                'type'        => 'website',
                'url'         => get_permalink(),
            ];
        }

        $desc = get_the_excerpt() ?: wp_trim_words(wp_strip_all_tags(get_the_content()), 30);
        return [
            'title'       => get_the_title() . ' — ' . $site,
            'description' => $desc ?: ('Página de ' . $site . ', casa rural de lujo en Vejer de la Frontera, Cádiz.'),
            'image'       => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : $default_image,
            'type'        => 'website',
            'url'         => get_permalink(),
        ];
    }

    return null;
}

/* Meta description + Open Graph + Twitter Card */
add_action('wp_head', function () {
    if (casadeltorero_has_seo_plugin()) return;

    $meta = casadeltorero_seo_meta();
    if (!$meta) return;

    $description = wp_strip_all_tags($meta['description']);

    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";

    echo '<meta property="og:type" content="' . esc_attr($meta['type']) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:locale" content="es_ES">' . "\n";
    if (is_front_page()) {
        echo '<meta property="og:locale:alternate" content="en_GB">' . "\n";
        echo '<meta property="og:locale:alternate" content="fr_FR">' . "\n";
    }
    echo '<meta property="og:url" content="' . esc_url($meta['url']) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($meta['title']) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($meta['image']) . '">' . "\n";

    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($meta['title']) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($meta['image']) . '">' . "\n";
}, 1);

/* ── Schema.org JSON-LD para SEO local y de alojamiento ── */
add_action('wp_head', function () {
    if (!is_front_page()) return;
    $has_acf = function_exists('get_field');

    /* sameAs: redes sociales + menciones de prensa ya mostradas en la franja de prestigio */
    $default_prestige_urls = [
        'https://www.rusticae.com/hotel/la-casa-del-torero-10850',
        'https://www.traveler.es/naturaleza/galerias/las-mejores-casas-rurales-para-pasar-el-verano-con-piscina-vistas/2660',
        'https://www.secretplaces.com/vejer-de-la-frontera-boutique-hotels/la-casa-del-torero',
        'https://cosy-places.com/la-casa-del-torero/',
        'https://www.thehotelguru.com/best-hotels-in/spain/vejer-de-la-frontera',
        'https://www.furtherafield.com/properties/la-casa-del-torerovejer-de-la-frontera-andalucia/',
        'https://www.gay-sejour.com/en/a-10039/la-casa-del-torero--vejer-de-la-frontera.html',
    ];
    $prestige_items = $has_acf ? get_field('prestige_items', 'option') : null;
    $prestige_urls  = $default_prestige_urls;
    if ($prestige_items && is_array($prestige_items)) {
        $prestige_urls = array_values(array_filter(array_map(fn($i) => $i['prestige_url'] ?? '', $prestige_items), fn($u) => $u && $u !== '#'));
    }
    $social_instagram = ($has_acf ? get_field('social_instagram', 'option') : '') ?: 'https://www.instagram.com/casadeltorerovejer/';
    $social_facebook  = ($has_acf ? get_field('social_facebook', 'option')  : '') ?: 'https://www.facebook.com/casadeltorerovejer';
    $same_as = array_values(array_unique(array_merge([$social_instagram, $social_facebook], $prestige_urls)));

    $schema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'LodgingBusiness',
        'name'            => 'La Casa del Torero',
        'description'     => 'Casa rural de alquiler completo en Vejer, Cádiz. Finca histórica de 24 hectáreas entre olivos centenarios, piscina, jacuzzi y vistas a la Costa de la Luz.',
        'url'             => home_url('/'),
        'telephone'       => ($has_acf ? get_field('contact_phone', 'option') : '') ?: '+34615508168',
        'email'           => ($has_acf ? get_field('contact_email', 'option') : '') ?: 'info@lacasadeltorero.com',
        'sameAs'          => $same_as,
        'address'         => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'DS Abejaruco, Pol. 65 Parc. 85, Cañada Ancha',
            'postalCode'      => '11150',
            'addressLocality' => 'Vejer de la Frontera',
            'addressRegion'   => 'Cádiz',
            'addressCountry'  => 'ES',
        ],
        'geo'             => ['@type' => 'GeoCoordinates', 'latitude' => '36.27762390730022', 'longitude' => '-5.953142849633493'],
        'amenityFeature'  => [
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Piscina exterior', 'value' => true],
            ['@type' => 'LocationFeatureSpecification', 'name' => 'WiFi gratuito', 'value' => true],
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Parking gratuito', 'value' => true],
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Aire acondicionado', 'value' => true],
        ],
        /* Misma puntuación que se muestra en la sección de testimonios (Booking.com · 117 opiniones) */
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '9.9',
            'bestRating'  => '10',
            'worstRating' => '1',
            'ratingCount' => '117',
        ],
        'numberOfRooms'   => 4,
    ];
    printf('<script type="application/ld+json">%s</script>' . "\n", wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
});

/* ── Schema.org JSON-LD: migas de pan ── */
add_action('wp_head', function () {
    if (is_front_page() || is_404() || is_search()) return;

    $items = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => home_url('/')],
    ];

    if (is_singular('habitacion')) {
        $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Habitaciones', 'item' => get_post_type_archive_link('habitacion')];
        $items[] = ['@type' => 'ListItem', 'position' => 3, 'name' => get_the_title(), 'item' => get_permalink()];
    } elseif (is_post_type_archive('habitacion')) {
        $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Habitaciones', 'item' => get_post_type_archive_link('habitacion')];
    } elseif (is_singular('post')) {
        $blog_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/');
        $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $blog_url];
        $items[] = ['@type' => 'ListItem', 'position' => 3, 'name' => get_the_title(), 'item' => get_permalink()];
    } elseif (is_home()) {
        $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => get_permalink()];
    } elseif (is_page()) {
        $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => get_the_title(), 'item' => get_permalink()];
    } else {
        return;
    }

    $schema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
    printf('<script type="application/ld+json">%s</script>' . "\n", wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
});

/* ── Excerpt length ── */
add_filter('excerpt_length', fn() => 24, 999);

/* ── Customizer ── */
require get_template_directory() . '/inc/customizer.php';

/* ── ACF Pro: campos del tema ── */
require get_template_directory() . '/inc/acf-fields.php';

/* ══════════════════════════════════════════════
   SEGURIDAD
══════════════════════════════════════════════ */

/* Ocultar versión de WordPress */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/* Desactivar XML-RPC */
add_filter('xmlrpc_enabled', '__return_false');
add_filter('xmlrpc_methods', function () { return []; });

/* Eliminar cabeceras que revelan info del servidor */
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_resource_hints', 2);
add_filter('x_pingback', '__return_false');
header_remove('X-Powered-By');

/* Desactivar comentarios globalmente */
add_action('init', function () {
    foreach (get_post_types() as $pt) {
        if (post_type_supports($pt, 'comments')) {
            remove_post_type_support($pt, 'comments');
            remove_post_type_support($pt, 'trackbacks');
        }
    }
});
add_filter('comments_open',   '__return_false', 20, 2);
add_filter('pings_open',      '__return_false', 20, 2);
add_filter('comments_array',  '__return_empty_array', 10, 2);
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
});

/* Proteger la pantalla de login: limitar intentos fallidos vía cookie */
add_action('wp_login_failed', function ($user_login) {
    $ip  = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $key = 'login_fail_' . md5($ip);
    $count = (int) get_transient($key);
    set_transient($key, $count + 1, 15 * MINUTE_IN_SECONDS);
});
add_filter('authenticate', function ($user, $username, $password) {
    if (empty($username) && empty($password)) return $user;
    $ip    = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $key   = 'login_fail_' . md5($ip);
    $count = (int) get_transient($key);
    if ($count >= 5) {
        return new WP_Error('too_many_attempts', __('Demasiados intentos fallidos. Espera 15 minutos.'));
    }
    return $user;
}, 30, 3);

/* Manejador del formulario de contacto */
add_action('admin_post_nopriv_casadeltorero_contact', 'casadeltorero_handle_contact');
add_action('admin_post_casadeltorero_contact',        'casadeltorero_handle_contact');
function casadeltorero_handle_contact() {
    /* Verificar nonce */
    if (!isset($_POST['_contact_nonce']) || !wp_verify_nonce($_POST['_contact_nonce'], 'casadeltorero_contact')) {
        wp_die('Solicitud no válida.', 403);
    }

    /* Límite de envíos por IP: máximo 5 cada 15 minutos */
    $ip      = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $rl_key  = 'contact_rl_' . md5($ip);
    $rl_count = (int) get_transient($rl_key);
    if ($rl_count >= 5) {
        wp_die('Demasiadas solicitudes. Espera unos minutos antes de volver a escribirnos.', 429);
    }
    set_transient($rl_key, $rl_count + 1, 15 * MINUTE_IN_SECONDS);

    /* Honeypot antispam */
    if (!empty($_POST['cf_website'])) {
        wp_redirect(home_url('/contacto/?sent=1'));
        exit;
    }

    /* Tiempo mínimo de relleno: un bot que envía el formulario al instante
       tarda menos de 3 segundos en "rellenarlo". Fallamos en silencio,
       igual que el honeypot, para no delatar el filtro. */
    $submitted_at = (int) ($_POST['cf_ts'] ?? 0);
    $elapsed      = time() - $submitted_at;
    if ($submitted_at <= 0 || $elapsed < 3 || $elapsed > 3 * HOUR_IN_SECONDS) {
        wp_redirect(home_url('/contacto/?sent=1'));
        exit;
    }

    /* Sanitizar */
    $name    = sanitize_text_field($_POST['cf_name']    ?? '');
    $email   = sanitize_email($_POST['cf_email']        ?? '');
    $phone   = sanitize_text_field($_POST['cf_phone']   ?? '');
    $guests  = sanitize_text_field($_POST['cf_guests']  ?? '');
    $checkin = sanitize_text_field($_POST['cf_checkin'] ?? '');
    $checkout= sanitize_text_field($_POST['cf_checkout']?? '');
    $message = sanitize_textarea_field($_POST['cf_message'] ?? '');

    /* Validar campos obligatorios */
    if (empty($name) || !is_email($email)) {
        wp_redirect(home_url('/contacto/?error=1'));
        exit;
    }

    /* Enviar email */
    $to      = get_option('admin_email');
    $subject = 'Nueva consulta de ' . $name . ' — La Casa del Torero';
    $body    = "Nombre: $name\nEmail: $email\nTeléfono: $phone\n"
             . "Personas: $guests\nLlegada: $checkin\nSalida: $checkout\n\n$message";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . preg_replace('/[\r\n\t]/', '', $name) . ' <' . $email . '>',
    ];
    wp_mail($to, $subject, $body, $headers);

    wp_redirect(home_url('/contacto/?sent=1'));
    exit;
}
