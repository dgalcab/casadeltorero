<?php
/**
 * ACF Pro — Registro de todos los campos del tema.
 *
 * Estructura:
 *  - Options Page  : ajustes globales (logo, contacto, redes)
 *  - Front Page    : hero, about, finca, espacios (repeater), experiencias,
 *                    testimonios (repeater), ubicación (repeater), CTA
 */
defined('ABSPATH') || exit;

add_action('acf/init', function () {

    if (!function_exists('acf_add_local_field_group')) return;

    /* ═══════════════════════════════════════════════
       OPTIONS PAGE — Ajustes globales
    ═══════════════════════════════════════════════ */
    acf_add_local_field_group([
        'key'      => 'group_options',
        'title'    => 'Ajustes globales',
        'location' => [[ ['param' => 'options_page', 'operator' => '==', 'value' => 'casadeltorero-settings'] ]],
        'fields'   => [

            // ── Logo
            ['key' => 'field_logo_white',  'label' => 'Logo blanco (header + footer)',  'name' => 'logo_white',  'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'SVG o PNG transparente. Se usa sobre fondos oscuros.'],
            ['key' => 'field_logo_dark',   'label' => 'Logo oscuro (header al hacer scroll)', 'name' => 'logo_dark', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Versión oscura/negra del logo para el header blanco.'],

            // ── Contacto
            ['key' => 'field_opt_tab_contact', 'label' => 'Contacto', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_contact_phone',   'label' => 'Teléfono',      'name' => 'contact_phone',   'type' => 'text',     'default_value' => '+34 600 000 000'],
            ['key' => 'field_contact_email',   'label' => 'Email',          'name' => 'contact_email',   'type' => 'email',    'default_value' => 'info@lacasadeltorero.com'],
            ['key' => 'field_contact_whatsapp','label' => 'WhatsApp (solo número, sin +)', 'name' => 'contact_whatsapp', 'type' => 'text', 'default_value' => '34600000000'],
            ['key' => 'field_contact_address', 'label' => 'Dirección',      'name' => 'contact_address', 'type' => 'textarea', 'rows' => 3, 'default_value' => "Vejer de la Frontera\nCádiz, Andalucía · España"],

            // ── Redes sociales
            ['key' => 'field_opt_tab_social', 'label' => 'Redes sociales', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_social_instagram', 'label' => 'Instagram URL', 'name' => 'social_instagram', 'type' => 'url'],
            ['key' => 'field_social_facebook',  'label' => 'Facebook URL',  'name' => 'social_facebook',  'type' => 'url'],
            ['key' => 'field_social_tiktok',    'label' => 'TikTok URL',    'name' => 'social_tiktok',    'type' => 'url'],

            // ── SEO
            ['key' => 'field_opt_tab_seo', 'label' => 'SEO', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_seo_description', 'label' => 'Meta description (ES)', 'name' => 'seo_description', 'type' => 'textarea', 'rows' => 3,
             'default_value' => 'Casa rural de alquiler completo en Vejer, Cádiz. Finca histórica de 24 hectáreas, piscina, jacuzzi y vistas a la Costa de la Luz.'],
        ],
    ]);


    /* ═══════════════════════════════════════════════
       FRONT PAGE — Todas las secciones
    ═══════════════════════════════════════════════ */
    acf_add_local_field_group([
        'key'      => 'group_frontpage',
        'title'    => 'Contenido — Portada',
        'location' => [[ ['param' => 'page_type', 'operator' => '==', 'value' => 'front_page'] ]],
        'menu_order' => 0,
        'fields' => [

            /* ── HERO ── */
            ['key' => 'field_fp_tab_hero', 'label' => '🎬 Hero', 'name' => '', 'type' => 'tab'],

            ['key' => 'field_hero_video', 'label' => 'Vídeo de fondo (MP4)',
             'name' => 'hero_video', 'type' => 'file',
             'return_format' => 'url', 'mime_types' => 'mp4,webm',
             'instructions' => 'Sube un vídeo MP4 en 1920×1080. Máx. recomendado: 20 MB. Sin audio.'],

            ['key' => 'field_hero_poster', 'label' => 'Imagen de carga del vídeo (poster)',
             'name' => 'hero_poster', 'type' => 'image',
             'return_format' => 'url', 'preview_size' => 'medium',
             'instructions' => 'Se muestra mientras carga el vídeo. Usa una foto bonita de la finca.'],

            ['key' => 'field_hero_fallback', 'label' => 'Imagen de fondo (fallback sin vídeo)',
             'name' => 'hero_fallback', 'type' => 'image',
             'return_format' => 'url', 'preview_size' => 'medium'],

            ['key' => 'field_hero_title',    'label' => 'Título hero',    'name' => 'hero_title',    'type' => 'text',     'default_value' => 'La Casa del Torero'],
            ['key' => 'field_hero_subtitle', 'label' => 'Subtítulo hero', 'name' => 'hero_subtitle', 'type' => 'textarea', 'rows' => 2,
             'default_value' => 'Una finca histórica de 24 hectáreas entre olivos centenarios, a 11 km de las playas vírgenes de la Costa de la Luz.'],


            /* ── LA CASA ── */
            ['key' => 'field_fp_tab_casa', 'label' => '🏠 La Casa', 'name' => '', 'type' => 'tab'],

            ['key' => 'field_casa_foto_principal', 'label' => 'Foto principal (vertical 4:5)',
             'name' => 'casa_foto_principal', 'type' => 'image',
             'return_format' => 'array', 'preview_size' => 'medium',
             'instructions' => 'Recomendado: 800×1000 px. Fachada o interior principal.'],

            ['key' => 'field_casa_foto_detalle', 'label' => 'Foto detalle (cuadrada, superpuesta)',
             'name' => 'casa_foto_detalle', 'type' => 'image',
             'return_format' => 'array', 'preview_size' => 'medium',
             'instructions' => 'Recomendado: 600×600 px. Detalle de interior, patio o jardín.'],

            ['key' => 'field_casa_titulo',  'label' => 'Título sección La Casa', 'name' => 'casa_titulo',  'type' => 'text',
             'default_value' => 'Un enclave único entre el pueblo blanco y el campo andaluz'],
            ['key' => 'field_casa_texto1',  'label' => 'Párrafo 1', 'name' => 'casa_texto1', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
            ['key' => 'field_casa_texto2',  'label' => 'Párrafo 2', 'name' => 'casa_texto2', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],


            /* ── LA FINCA ── */
            ['key' => 'field_fp_tab_finca', 'label' => '🌿 La Finca', 'name' => '', 'type' => 'tab'],

            ['key' => 'field_finca_foto', 'label' => 'Foto finca (vertical 4:5)',
             'name' => 'finca_foto', 'type' => 'image',
             'return_format' => 'array', 'preview_size' => 'medium',
             'instructions' => 'Foto aérea, olivos, plaza de tentación o panorámica del campo.'],

            ['key' => 'field_finca_titulo', 'label' => 'Título',  'name' => 'finca_titulo', 'type' => 'text',
             'default_value' => 'Historia viva en 24 hectáreas de campo abierto'],
            ['key' => 'field_finca_texto1', 'label' => 'Párrafo 1', 'name' => 'finca_texto1', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
            ['key' => 'field_finca_texto2', 'label' => 'Párrafo 2', 'name' => 'finca_texto2', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],


            /* ── ESPACIOS (Repeater) ── */
            ['key' => 'field_fp_tab_espacios', 'label' => '🛏 Espacios', 'name' => '', 'type' => 'tab'],

            [
                'key'        => 'field_espacios',
                'label'      => 'Habitaciones y espacios',
                'name'       => 'espacios',
                'type'       => 'repeater',
                'layout'     => 'block',
                'button_label' => '+ Añadir espacio',
                'instructions' => 'Arrastra para reordenar. Recomendado: mínimo 3 espacios.',
                'sub_fields' => [
                    ['key' => 'field_espacio_foto',      'label' => 'Foto (3:4 vertical)', 'name' => 'foto',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Recomendado: 800×1067 px'],
                    ['key' => 'field_espacio_tag',       'label' => 'Etiqueta (ej: Suite / Habitación / Exterior)', 'name' => 'tag', 'type' => 'text'],
                    ['key' => 'field_espacio_nombre',    'label' => 'Nombre del espacio',  'name' => 'nombre',    'type' => 'text'],
                    ['key' => 'field_espacio_tamanyo',   'label' => 'Tamaño / capacidad (ej: 50 m² · Hasta 4 personas)', 'name' => 'tamanyo', 'type' => 'text'],
                    ['key' => 'field_espacio_descripcion','label' => 'Descripción breve',  'name' => 'descripcion','type' => 'textarea', 'rows' => 2],
                ],
            ],


            /* ── EXPERIENCIAS ── */
            ['key' => 'field_fp_tab_exp', 'label' => '✨ Experiencias', 'name' => '', 'type' => 'tab'],

            ['key' => 'field_exp_foto_grande', 'label' => 'Foto grande (izquierda)',
             'name' => 'exp_foto_grande', 'type' => 'image',
             'return_format' => 'array', 'preview_size' => 'medium',
             'instructions' => 'Recomendado: 600×800 px. Salón, chimenea o zona de estar.'],

            ['key' => 'field_exp_foto_2', 'label' => 'Foto derecha arriba',
             'name' => 'exp_foto_2', 'type' => 'image',
             'return_format' => 'array', 'preview_size' => 'medium',
             'instructions' => 'Recomendado: 600×390 px. Piscina, desayuno o jacuzzi.'],

            ['key' => 'field_exp_foto_3', 'label' => 'Foto derecha abajo',
             'name' => 'exp_foto_3', 'type' => 'image',
             'return_format' => 'array', 'preview_size' => 'medium',
             'instructions' => 'Recomendado: 600×390 px. Huerto, detalle o exterior.'],

            [
                'key'        => 'field_amenities',
                'label'      => 'Lista de servicios / amenities',
                'name'       => 'amenities',
                'type'       => 'repeater',
                'layout'     => 'table',
                'button_label' => '+ Añadir servicio',
                'sub_fields' => [
                    ['key' => 'field_amenity_texto', 'label' => 'Servicio', 'name' => 'texto', 'type' => 'text'],
                ],
            ],


            /* ── GALERÍA ── */
            ['key' => 'field_fp_tab_galeria', 'label' => '📷 Galería', 'name' => '', 'type' => 'tab'],

            ['key' => 'field_galeria',
             'label' => 'Galería de fotos (arrastra para ordenar)',
             'name'  => 'galeria',
             'type'  => 'gallery',
             'return_format' => 'array',
             'preview_size'  => 'medium',
             'insert'        => 'append',
             'instructions'  => 'Sube todas las fotos de la casa. Arrastra para reordenar. Se mostrarán en la galería de la web.',
            ],


            /* ── TESTIMONIOS (Repeater) ── */
            ['key' => 'field_fp_tab_testimonios', 'label' => '⭐ Testimonios', 'name' => '', 'type' => 'tab'],

            [
                'key'        => 'field_testimonios',
                'label'      => 'Opiniones de huéspedes',
                'name'       => 'testimonios',
                'type'       => 'repeater',
                'layout'     => 'block',
                'button_label' => '+ Añadir testimonio',
                'sub_fields' => [
                    ['key' => 'field_test_texto',     'label' => 'Texto de la opinión', 'name' => 'texto',     'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_test_nombre',    'label' => 'Nombre',              'name' => 'nombre',    'type' => 'text'],
                    ['key' => 'field_test_origen',    'label' => 'Ciudad y fecha',      'name' => 'origen',    'type' => 'text',     'placeholder' => 'Madrid · Agosto 2024'],
                    ['key' => 'field_test_plataforma','label' => 'Plataforma',          'name' => 'plataforma','type' => 'select',
                     'choices' => ['Tripadvisor' => 'Tripadvisor', 'Booking.com' => 'Booking.com', 'Airbnb' => 'Airbnb', 'Google' => 'Google', 'Directo' => 'Directo']],
                    ['key' => 'field_test_estrellas', 'label' => 'Estrellas',           'name' => 'estrellas', 'type' => 'select',
                     'choices' => ['5' => '★★★★★', '4' => '★★★★', '3' => '★★★'], 'default_value' => '5'],
                ],
            ],


            /* ── UBICACIÓN ── */
            ['key' => 'field_fp_tab_ubicacion', 'label' => '📍 Ubicación', 'name' => '', 'type' => 'tab'],

            ['key' => 'field_ubicacion_titulo', 'label' => 'Título sección', 'name' => 'ubicacion_titulo', 'type' => 'text',
             'default_value' => 'Vejer — el pueblo blanco más bello de Cádiz'],
            ['key' => 'field_ubicacion_texto',  'label' => 'Texto descriptivo', 'name' => 'ubicacion_texto', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_map_embed',        'label' => 'Código embed del mapa (iframe)', 'name' => 'map_embed', 'type' => 'textarea', 'rows' => 4,
             'instructions' => 'Pega el código <iframe> de Google Maps o OpenStreetMap.'],

            [
                'key'        => 'field_puntos_ubicacion',
                'label'      => 'Puntos de interés',
                'name'       => 'puntos_ubicacion',
                'type'       => 'repeater',
                'layout'     => 'table',
                'button_label' => '+ Añadir punto',
                'sub_fields' => [
                    ['key' => 'field_punto_nombre',   'label' => 'Lugar',    'name' => 'nombre',   'type' => 'text'],
                    ['key' => 'field_punto_distancia','label' => 'Distancia','name' => 'distancia','type' => 'text', 'placeholder' => '11 km · 15 min'],
                ],
            ],


            /* ── CTA BANNER ── */
            ['key' => 'field_fp_tab_cta', 'label' => '📣 CTA Banner', 'name' => '', 'type' => 'tab'],

            ['key' => 'field_cta_bg',    'label' => 'Imagen de fondo del banner', 'name' => 'cta_bg',    'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'],
            ['key' => 'field_cta_titulo','label' => 'Título',                      'name' => 'cta_titulo','type' => 'text',  'default_value' => "Vejer os espera.\n¿Cuándo venís?"],
            ['key' => 'field_cta_texto', 'label' => 'Texto',                       'name' => 'cta_texto', 'type' => 'textarea', 'rows' => 2],
        ],
    ]);

});
