<?php
/**
 * Opciones del Customizer de WordPress.
 * Aparecen en Apariencia → Personalizar.
 */
defined('ABSPATH') || exit;

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {

    // ── Sección: Contacto & Redes ──
    $wp_customize->add_section('casadeltorero_contact', [
        'title'    => __('Contacto y redes sociales', 'casadeltorero'),
        'priority' => 30,
    ]);

    $fields = [
        'contact_address'   => ['Dirección',          'textarea', 'Calle Ejemplo, 1<br>29400 Ronda, Málaga'],
        'contact_phone'     => ['Teléfono',            'text',     '+34 600 000 000'],
        'contact_email'     => ['Email',               'text',     'info@lacasadeltorero.com'],
        'contact_whatsapp'  => ['WhatsApp (solo nº)',  'text',     '34600000000'],
        'social_instagram'  => ['Instagram URL',       'url',      'https://instagram.com/lacasadeltorero'],
        'social_facebook'   => ['Facebook URL',        'url',      'https://facebook.com/lacasadeltorero'],
    ];

    foreach ($fields as $id => [$label, $type, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'wp_kses_post']);
        $control_args = [
            'label'   => $label,
            'section' => 'casadeltorero_contact',
            'type'    => $type,
        ];
        if ($type === 'textarea') {
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, $id, $control_args));
        } else {
            $wp_customize->add_control($id, $control_args);
        }
    }

    // ── Sección: Textos Hero ──
    $wp_customize->add_section('casadeltorero_hero', [
        'title'    => __('Hero — Portada', 'casadeltorero'),
        'priority' => 20,
    ]);

    $hero_fields = [
        'hero_video_url' => ['Vídeo de fondo (URL MP4)', 'text', ''],
        'hero_eyebrow'   => ['Subtítulo pequeño',  'text',     'Casa Rural · Hotel Boutique · Vejer, Cádiz'],
        'hero_title'     => ['Título principal',   'text',     'La Casa del Torero'],
        'hero_subtitle'  => ['Texto descriptivo',  'textarea', 'Un refugio de elegancia andaluza donde el tiempo se detiene y cada detalle cuenta una historia.'],
        'hero_cta1_text' => ['Botón 1 — Texto',    'text',     'Reservar ahora'],
        'hero_cta2_text' => ['Botón 2 — Texto',    'text',     'Descubrir la casa'],
    ];

    foreach ($hero_fields as $id => [$label, $type, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control($id, [
            'label'   => $label,
            'section' => 'casadeltorero_hero',
            'type'    => $type,
        ]);
    }
});
