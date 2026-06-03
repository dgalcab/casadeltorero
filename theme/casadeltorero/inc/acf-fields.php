<?php
defined('ABSPATH') || exit;

if (!function_exists('acf_add_local_field_group')) {
    return;
}

add_action('acf/init', function () {

    /* ══════════════════════════════════════════════
       GROUP 1 — Options Page: Ajustes globales
    ══════════════════════════════════════════════ */
    acf_add_local_field_group([
        'key'      => 'group_options_global',
        'title'    => 'Ajustes globales',
        'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'casadeltorero-settings']]],
        'fields'   => [

            // Tab: Logo
            ['key' => 'field_tab_logo', 'label' => 'Logo', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_logo_white', 'label' => 'Logo blanco (sobre fondos oscuros)', 'name' => 'logo_white', 'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_logo_dark',  'label' => 'Logo oscuro (sobre fondos claros)',  'name' => 'logo_dark',  'type' => 'image', 'return_format' => 'array'],

            // Tab: Contacto
            ['key' => 'field_tab_contacto', 'label' => 'Contacto', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_contact_phone',   'label' => 'Teléfono',  'name' => 'contact_phone',   'type' => 'text',     'default_value' => '+34615508168'],
            ['key' => 'field_contact_email',   'label' => 'Email',     'name' => 'contact_email',   'type' => 'email',    'default_value' => 'info@lacasadeltorero.com'],
            ['key' => 'field_contact_address', 'label' => 'Dirección', 'name' => 'contact_address', 'type' => 'textarea', 'rows' => 3],

            // Tab: Redes sociales
            ['key' => 'field_tab_social', 'label' => 'Redes sociales', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_social_instagram', 'label' => 'Instagram', 'name' => 'social_instagram', 'type' => 'url'],
            ['key' => 'field_social_facebook',  'label' => 'Facebook',  'name' => 'social_facebook',  'type' => 'url'],
            ['key' => 'field_social_whatsapp',  'label' => 'WhatsApp',  'name' => 'social_whatsapp',  'type' => 'text',
                'default_value' => '34615508168', 'instructions' => 'Solo números, sin + ni espacios'],

            // Tab: Prestige bar
            ['key' => 'field_tab_prestige', 'label' => 'Prestige bar', 'name' => '', 'type' => 'tab'],
            [
                'key' => 'field_prestige_items', 'label' => 'Plataformas prestige', 'name' => 'prestige_items',
                'type' => 'repeater', 'button_label' => 'Añadir plataforma',
                'sub_fields' => [
                    ['key' => 'field_prestige_name',      'label' => 'Nombre',      'name' => 'prestige_name',      'type' => 'text'],
                    ['key' => 'field_prestige_url',       'label' => 'URL',         'name' => 'prestige_url',       'type' => 'url'],
                    ['key' => 'field_prestige_logo',      'label' => 'Logo',        'name' => 'prestige_logo',      'type' => 'image', 'return_format' => 'array'],
                    ['key' => 'field_prestige_text_only', 'label' => 'Solo texto',  'name' => 'prestige_text_only', 'type' => 'true_false',
                        'instructions' => 'Activa si no hay logo disponible'],
                ],
            ],

            // Tab: Testimonios
            ['key' => 'field_tab_testimonios', 'label' => 'Testimonios', 'name' => '', 'type' => 'tab'],
            [
                'key' => 'field_testimonials', 'label' => 'Testimonios', 'name' => 'testimonials',
                'type' => 'repeater', 'button_label' => 'Añadir testimonio',
                'sub_fields' => [
                    ['key' => 'field_testimonial_text',     'label' => 'Texto',      'name' => 'testimonial_text',     'type' => 'textarea'],
                    ['key' => 'field_testimonial_author',   'label' => 'Autor',      'name' => 'testimonial_author',   'type' => 'text'],
                    ['key' => 'field_testimonial_origin',   'label' => 'Origen',     'name' => 'testimonial_origin',   'type' => 'text'],
                    ['key' => 'field_testimonial_platform', 'label' => 'Plataforma', 'name' => 'testimonial_platform', 'type' => 'select',
                        'choices' => ['booking' => 'Booking.com', 'tripadvisor' => 'TripAdvisor']],
                    ['key' => 'field_testimonial_score',    'label' => 'Puntuación', 'name' => 'testimonial_score',    'type' => 'text'],
                ],
            ],

            // Tab: FAQ
            ['key' => 'field_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab'],
            [
                'key' => 'field_faq_items', 'label' => 'Preguntas frecuentes', 'name' => 'faq_items',
                'type' => 'repeater', 'button_label' => 'Añadir pregunta',
                'sub_fields' => [
                    ['key' => 'field_faq_question', 'label' => 'Pregunta', 'name' => 'faq_question', 'type' => 'text'],
                    ['key' => 'field_faq_answer',   'label' => 'Respuesta','name' => 'faq_answer',   'type' => 'textarea'],
                ],
            ],
        ],
    ]);

    /* ══════════════════════════════════════════════
       GROUP 2 — Home: Hero
    ══════════════════════════════════════════════ */
    acf_add_local_field_group([
        'key'      => 'group_home_hero',
        'title'    => 'Home — Hero',
        'location' => [
            [['param' => 'page_template', 'operator' => '==', 'value' => 'front-page.php']],
            [['param' => 'page',          'operator' => '==', 'value' => 'front_page']],
        ],
        'fields' => [
            ['key' => 'field_hero_video',       'label' => 'Vídeo hero',    'name' => 'hero_video',       'type' => 'file',     'return_format' => 'url', 'mime_types' => 'mp4'],
            ['key' => 'field_hero_eyebrow',     'label' => 'Eyebrow',       'name' => 'hero_eyebrow',     'type' => 'text',     'default_value' => 'Casa Rural · Hotel Boutique · Vejer, Cádiz'],
            ['key' => 'field_hero_title',       'label' => 'Título',        'name' => 'hero_title',       'type' => 'text',     'default_value' => 'La Casa del Torero'],
            ['key' => 'field_hero_subtitle',    'label' => 'Subtítulo',     'name' => 'hero_subtitle',    'type' => 'textarea', 'default_value' => 'Una finca histórica de 24 hectáreas entre olivos centenarios, a 11 km de las playas vírgenes de la Costa de la Luz.'],
            ['key' => 'field_hero_cta1_text',   'label' => 'CTA 1 texto',   'name' => 'hero_cta1_text',   'type' => 'text',     'default_value' => 'Reservar habitación'],
            ['key' => 'field_hero_cta1_url',    'label' => 'CTA 1 URL',     'name' => 'hero_cta1_url',    'type' => 'text',     'default_value' => '#habitaciones'],
            ['key' => 'field_hero_cta2_text',   'label' => 'CTA 2 texto',   'name' => 'hero_cta2_text',   'type' => 'text',     'default_value' => 'Alquilar la casa completa'],
            ['key' => 'field_hero_cta2_url',    'label' => 'CTA 2 URL',     'name' => 'hero_cta2_url',    'type' => 'text',     'default_value' => '#casa-completa'],
            ['key' => 'field_hero_badge_title', 'label' => 'Badge título',  'name' => 'hero_badge_title', 'type' => 'text',     'default_value' => 'Marruecos visible'],
            ['key' => 'field_hero_badge_text',  'label' => 'Badge texto',   'name' => 'hero_badge_text',  'type' => 'text',     'default_value' => 'en días despejados'],
        ],
    ]);

    /* ══════════════════════════════════════════════
       GROUP 3 — Home: Secciones
    ══════════════════════════════════════════════ */
    acf_add_local_field_group([
        'key'      => 'group_home_sections',
        'title'    => 'Home — Secciones',
        'location' => [
            [['param' => 'page_template', 'operator' => '==', 'value' => 'front-page.php']],
            [['param' => 'page',          'operator' => '==', 'value' => 'front_page']],
        ],
        'fields' => [
            // Tab: Intro Strip
            ['key' => 'field_tab_intro', 'label' => 'Intro Strip', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_intro_item_1_label', 'label' => 'Item 1 etiqueta', 'name' => 'intro_item_1_label', 'type' => 'text', 'default_value' => 'Finca'],
            ['key' => 'field_intro_item_1_value', 'label' => 'Item 1 valor',    'name' => 'intro_item_1_value', 'type' => 'text', 'default_value' => '24 hectáreas'],
            ['key' => 'field_intro_item_2_label', 'label' => 'Item 2 etiqueta', 'name' => 'intro_item_2_label', 'type' => 'text', 'default_value' => 'Playas'],
            ['key' => 'field_intro_item_2_value', 'label' => 'Item 2 valor',    'name' => 'intro_item_2_value', 'type' => 'text', 'default_value' => '11 km · Costa de la Luz'],
            ['key' => 'field_intro_item_3_label', 'label' => 'Item 3 etiqueta', 'name' => 'intro_item_3_label', 'type' => 'text', 'default_value' => 'Modalidades'],
            ['key' => 'field_intro_item_3_value', 'label' => 'Item 3 valor',    'name' => 'intro_item_3_value', 'type' => 'text', 'default_value' => 'Por habitación · Casa completa'],
            ['key' => 'field_intro_item_4_label', 'label' => 'Item 4 etiqueta', 'name' => 'intro_item_4_label', 'type' => 'text', 'default_value' => 'Ubicación'],
            ['key' => 'field_intro_item_4_value', 'label' => 'Item 4 valor',    'name' => 'intro_item_4_value', 'type' => 'text', 'default_value' => 'Vejer de la Frontera, Cádiz'],

            // Tab: Modalidades
            ['key' => 'field_tab_modality', 'label' => 'Modalidades', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_modality_title',          'label' => 'Título',                     'name' => 'modality_title',          'type' => 'text',     'default_value' => '¿Cómo quieres vivirlo?'],
            ['key' => 'field_modality_subtitle',       'label' => 'Subtítulo',                  'name' => 'modality_subtitle',       'type' => 'textarea'],
            ['key' => 'field_modality_rooms_price',    'label' => 'Precio por habitación',      'name' => 'modality_rooms_price',    'type' => 'text',     'default_value' => 'Desde 140 €'],
            ['key' => 'field_modality_rooms_features', 'label' => 'Características habitación', 'name' => 'modality_rooms_features', 'type' => 'textarea', 'instructions' => 'Una característica por línea'],
            ['key' => 'field_modality_house_price',    'label' => 'Precio casa completa',       'name' => 'modality_house_price',    'type' => 'text',     'default_value' => 'Desde 50 €'],
            ['key' => 'field_modality_house_features', 'label' => 'Características casa',       'name' => 'modality_house_features', 'type' => 'textarea', 'instructions' => 'Una característica por línea'],

            // Tab: La Casa
            ['key' => 'field_tab_about', 'label' => 'La Casa', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_about_eyebrow',      'label' => 'Eyebrow',          'name' => 'about_eyebrow',      'type' => 'text'],
            ['key' => 'field_about_title',        'label' => 'Título',           'name' => 'about_title',        'type' => 'text'],
            ['key' => 'field_about_text_1',       'label' => 'Texto 1',          'name' => 'about_text_1',       'type' => 'wysiwyg'],
            ['key' => 'field_about_text_2',       'label' => 'Texto 2',          'name' => 'about_text_2',       'type' => 'wysiwyg'],
            ['key' => 'field_about_image_main',   'label' => 'Imagen principal', 'name' => 'about_image_main',   'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_about_image_accent', 'label' => 'Imagen acento',    'name' => 'about_image_accent', 'type' => 'image', 'return_format' => 'array'],

            // Tab: La Finca
            ['key' => 'field_tab_finca', 'label' => 'La Finca', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_finca_eyebrow', 'label' => 'Eyebrow', 'name' => 'finca_eyebrow', 'type' => 'text'],
            ['key' => 'field_finca_title',   'label' => 'Título',   'name' => 'finca_title',   'type' => 'text'],
            ['key' => 'field_finca_text',    'label' => 'Texto',    'name' => 'finca_text',    'type' => 'wysiwyg'],
            ['key' => 'field_finca_image',   'label' => 'Imagen',   'name' => 'finca_image',   'type' => 'image', 'return_format' => 'array'],
            [
                'key' => 'field_finca_stats', 'label' => 'Estadísticas', 'name' => 'finca_stats',
                'type' => 'repeater',
                'sub_fields' => [
                    ['key' => 'field_finca_stat_value', 'label' => 'Valor',    'name' => 'finca_stat_value', 'type' => 'text'],
                    ['key' => 'field_finca_stat_label', 'label' => 'Etiqueta', 'name' => 'finca_stat_label', 'type' => 'text'],
                ],
            ],

            // Tab: Gastronomía
            ['key' => 'field_tab_gastro', 'label' => 'Gastronomía', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_gastro_eyebrow',  'label' => 'Eyebrow',         'name' => 'gastro_eyebrow',  'type' => 'text',     'default_value' => 'Gastronomía'],
            ['key' => 'field_gastro_title',    'label' => 'Título',          'name' => 'gastro_title',    'type' => 'text'],
            ['key' => 'field_gastro_text',     'label' => 'Texto',           'name' => 'gastro_text',     'type' => 'wysiwyg'],
            ['key' => 'field_gastro_features', 'label' => 'Características', 'name' => 'gastro_features', 'type' => 'textarea', 'instructions' => 'Una por línea'],
            ['key' => 'field_gastro_image_1',  'label' => 'Imagen 1',        'name' => 'gastro_image_1',  'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_gastro_image_2',  'label' => 'Imagen 2',        'name' => 'gastro_image_2',  'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_gastro_image_3',  'label' => 'Imagen 3',        'name' => 'gastro_image_3',  'type' => 'image', 'return_format' => 'array'],

            // Tab: Experiencias
            ['key' => 'field_tab_exp', 'label' => 'Experiencias', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_exp_title',     'label' => 'Título',       'name' => 'exp_title',     'type' => 'text'],
            ['key' => 'field_exp_lead',      'label' => 'Lead',         'name' => 'exp_lead',      'type' => 'textarea'],
            ['key' => 'field_exp_amenities', 'label' => 'Amenidades',   'name' => 'exp_amenities', 'type' => 'textarea', 'instructions' => 'Una amenidad por línea'],
            ['key' => 'field_exp_image_1',   'label' => 'Imagen 1',     'name' => 'exp_image_1',   'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_exp_image_2',   'label' => 'Imagen 2',     'name' => 'exp_image_2',   'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_exp_image_3',   'label' => 'Imagen 3',     'name' => 'exp_image_3',   'type' => 'image', 'return_format' => 'array'],

            // Tab: Galería
            ['key' => 'field_tab_gallery', 'label' => 'Galería', 'name' => '', 'type' => 'tab'],
            [
                'key' => 'field_gallery_items', 'label' => 'Imágenes galería', 'name' => 'gallery_items',
                'type' => 'repeater',
                'sub_fields' => [
                    ['key' => 'field_gallery_image', 'label' => 'Imagen', 'name' => 'gallery_image', 'type' => 'image', 'return_format' => 'array'],
                    ['key' => 'field_gallery_alt',   'label' => 'Alt',    'name' => 'gallery_alt',   'type' => 'text'],
                ],
            ],

            // Tab: Reservas
            ['key' => 'field_tab_booking', 'label' => 'Reservas', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_booking_title',       'label' => 'Título',               'name' => 'booking_title',       'type' => 'text',     'default_value' => 'Comprueba disponibilidad'],
            ['key' => 'field_booking_text',        'label' => 'Texto',                'name' => 'booking_text',        'type' => 'textarea'],
            ['key' => 'field_booking_engine_code', 'label' => 'Código motor Redfors', 'name' => 'booking_engine_code', 'type' => 'textarea',
                'instructions' => 'Pega aquí el código del motor de reservas Redfors'],

            // Tab: Ubicación
            ['key' => 'field_tab_location', 'label' => 'Ubicación', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_location_title',   'label' => 'Título',      'name' => 'location_title',   'type' => 'text'],
            ['key' => 'field_location_text',    'label' => 'Texto',       'name' => 'location_text',    'type' => 'wysiwyg'],
            ['key' => 'field_location_map_url', 'label' => 'URL del mapa','name' => 'location_map_url', 'type' => 'url',
                'instructions' => 'URL del embed de Google Maps'],
            [
                'key' => 'field_location_distances', 'label' => 'Distancias', 'name' => 'location_distances',
                'type' => 'repeater',
                'sub_fields' => [
                    ['key' => 'field_distance_place', 'label' => 'Lugar',     'name' => 'distance_place', 'type' => 'text'],
                    ['key' => 'field_distance_km',    'label' => 'Distancia', 'name' => 'distance_km',    'type' => 'text'],
                ],
            ],

            // Tab: CTA Banner
            ['key' => 'field_tab_cta', 'label' => 'CTA Banner', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_cta_title',    'label' => 'Título',     'name' => 'cta_title',    'type' => 'text'],
            ['key' => 'field_cta_text',     'label' => 'Texto',      'name' => 'cta_text',     'type' => 'textarea'],
            ['key' => 'field_cta_btn_text', 'label' => 'Botón texto','name' => 'cta_btn_text', 'type' => 'text'],
            ['key' => 'field_cta_btn_url',  'label' => 'Botón URL',  'name' => 'cta_btn_url',  'type' => 'text'],
        ],
    ]);

    /* ══════════════════════════════════════════════
       GROUP 4 — Habitación CPT
    ══════════════════════════════════════════════ */
    acf_add_local_field_group([
        'key'      => 'group_habitacion',
        'title'    => 'Habitación',
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'habitacion']]],
        'fields'   => [
            ['key' => 'field_hab_eyebrow',          'label' => 'Tipo / Eyebrow',       'name' => 'hab_eyebrow',          'type' => 'text',     'instructions' => 'Ej: Suite, Habitación doble...'],
            ['key' => 'field_hab_size',             'label' => 'Superficie',           'name' => 'hab_size',             'type' => 'text',     'instructions' => 'Ej: 50 m²'],
            ['key' => 'field_hab_capacity',         'label' => 'Capacidad',            'name' => 'hab_capacity',         'type' => 'text',     'instructions' => 'Ej: Hasta 4 personas'],
            ['key' => 'field_hab_price',            'label' => 'Precio',               'name' => 'hab_price',            'type' => 'text',     'instructions' => 'Ej: Desde 165 € / noche'],
            ['key' => 'field_hab_description_long', 'label' => 'Descripción completa', 'name' => 'hab_description_long', 'type' => 'wysiwyg'],
            [
                'key' => 'field_hab_features', 'label' => 'Características', 'name' => 'hab_features',
                'type' => 'repeater', 'button_label' => 'Añadir característica',
                'sub_fields' => [
                    ['key' => 'field_hab_feature', 'label' => 'Característica', 'name' => 'hab_feature', 'type' => 'text'],
                ],
            ],
            [
                'key' => 'field_hab_gallery', 'label' => 'Galería', 'name' => 'hab_gallery',
                'type' => 'repeater', 'button_label' => 'Añadir foto',
                'sub_fields' => [
                    ['key' => 'field_hab_image',     'label' => 'Imagen', 'name' => 'hab_image',     'type' => 'image', 'return_format' => 'array'],
                    ['key' => 'field_hab_image_alt', 'label' => 'Alt',    'name' => 'hab_image_alt', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_hab_ohbe_id', 'label' => 'OHBE acco_id', 'name' => 'hab_ohbe_id', 'type' => 'text',
                'instructions' => 'ID de la habitación en el motor de reservas OHBE (acco_id). Doble=14, Doble Superior=13, Suite=16, Apartamento=15'],
        ],
    ]);

});
