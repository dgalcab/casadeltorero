# La Casa del Torero — Tema WordPress

Tema WordPress personalizado para [lacasadeltorero.com](https://www.lacasadeltorero.com).

## Instalación

1. Copia la carpeta `theme/casadeltorero/` a `wp-content/themes/` de tu instalación WordPress.
2. Activa el tema en **Apariencia → Temas**.
3. Instala y activa el plugin **Redfors Hotel**.
4. Ve a **Apariencia → Personalizar** para configurar:
   - Teléfono, email, dirección, redes sociales
   - Textos del hero
5. Sube las imágenes al directorio `assets/images/` del tema (ver lista abajo).

## Imágenes necesarias

Sube tus fotos con estos nombres exactos a `theme/casadeltorero/assets/images/`:

| Archivo | Uso | Tamaño recomendado |
|---|---|---|
| `hero.jpg` | Fondo del hero principal | 1920×1080px |
| `about-main.jpg` | Foto grande sección "La Casa" | 640×800px |
| `about-detail.jpg` | Foto pequeña superpuesta | 400×400px |
| `space-suite.jpg` | Tarjeta Suite Principal | 600×800px |
| `space-salon.jpg` | Tarjeta Gran Salón | 600×800px |
| `space-patio.jpg` | Tarjeta Patio Andaluz | 600×800px |
| `exp-main.jpg` | Foto grande experiencias | 400×560px |
| `exp-detail1.jpg` | Foto pequeña experiencias | 400×270px |
| `exp-detail2.jpg` | Foto pequeña experiencias | 400×270px |
| `cta-bg.jpg` | Fondo del banner CTA final | 1920×900px |

## Plugin Redfors

El shortcode del motor de reservas se inserta en `front-page.php` línea ~165.
Cambia `[redfors_booking]` por el shortcode real de tu instalación Redfors.

## Personalización rápida

- **Colores** → `assets/css/main.css`, sección `:root { }` líneas 1-15
- **Textos** → **Apariencia → Personalizar → Hero / Portada**
- **Mapa** → `front-page.php`, busca `<iframe` y cambia las coordenadas
- **Menús** → **Apariencia → Menús**, asigna a "Menú principal" y "Menú footer"

## Plugins recomendados

- **Redfors Hotel** — motor de reservas
- **Yoast SEO** — SEO
- **WP Rocket** — caché y rendimiento
- **Smush** — optimización de imágenes
- **WP GDPR Compliance** — cookies (obligatorio en España)
