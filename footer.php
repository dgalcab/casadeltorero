<?php
$phone     = function_exists('get_field') ? get_field('contact_phone', 'option') : '';
$email     = function_exists('get_field') ? get_field('contact_email', 'option') : '';
$address   = function_exists('get_field') ? get_field('contact_address', 'option') : '';
$instagram = function_exists('get_field') ? get_field('social_instagram', 'option') : '';
$facebook  = function_exists('get_field') ? get_field('social_facebook', 'option') : '';
$whatsapp  = function_exists('get_field') ? get_field('social_whatsapp', 'option') : '';

$phone     = $phone     ?: '+34615508168';
$email     = $email     ?: 'info@lacasadeltorero.com';
$address   = $address   ?: "DS Abejaruco, Pol. 65 Parc. 85\nCañada Ancha · 11150 Vejer de la Frontera\nCádiz, Andalucía · España";
$instagram = $instagram ?: 'https://www.instagram.com/casadeltorerovejer/';
$facebook  = $facebook  ?: 'https://www.facebook.com/casadeltorerovejer';
$whatsapp  = $whatsapp  ?: '34615508168';
$wa_url    = 'https://wa.me/' . preg_replace('/\D/', '', $whatsapp);
?>

<footer id="site-footer">
  <div class="container">
    <div class="footer__grid">

      <div class="footer__brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="La Casa del Torero">
          <?php get_template_part('inc/logo'); ?>
          <span class="site-logo__name">La Casa del Torero<em>Vejer · Cádiz</em></span>
        </a>
        <p>Finca histórica de 24 hectáreas entre olivos centenarios, frente al pueblo blanco de Vejer de la Frontera, a 11 km de las playas vírgenes de la Costa de la Luz.</p>
        <div class="footer__social">
          <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor"/></svg>
          </a>
          <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          </a>
        </div>
      </div>

      <div class="footer__col">
        <h4>La Casa</h4>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/#la-casa')); ?>">La Casa</a></li>
          <li><a href="<?php echo esc_url(home_url('/#la-finca')); ?>">La Finca</a></li>
          <li><a href="<?php echo esc_url(home_url('/#habitaciones')); ?>">Espacios</a></li>
          <li><a href="<?php echo esc_url(home_url('/#experiencias')); ?>">Experiencias</a></li>
        </ul>
      </div>

      <div class="footer__col">
        <h4>Información</h4>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/reservas/')); ?>">Reservas</a></li>
          <li><a href="<?php echo esc_url(home_url('/#ubicacion')); ?>">Cómo llegar</a></li>
          <?php
          wp_nav_menu([
              'theme_location' => 'footer',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'fallback_cb'    => function () {
                  echo '<li><a href="' . esc_url(home_url('/condiciones-reserva/')) . '">Condiciones de reserva</a></li>';
                  echo '<li><a href="' . esc_url(home_url('/politica-cancelacion/')) . '">Política de cancelación</a></li>';
                  echo '<li><a href="' . esc_url(home_url('/politica-privacidad/')) . '">Privacidad · Cookies</a></li>';
              },
          ]);
          ?>
        </ul>
      </div>

      <div class="footer__col">
        <h4>Contacto</h4>
        <address>
          <?php echo nl2br(esc_html($address)); ?><br><br>
          <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
          &nbsp;·&nbsp;
          <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener">WhatsApp</a><br>
          <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
        </address>
        <?php if (is_active_sidebar('footer-widget')) : ?>
          <div class="footer__widget" style="margin-top:1.5rem;">
            <?php dynamic_sidebar('footer-widget'); ?>
          </div>
        <?php endif; ?>
      </div>

    </div>

    <div class="footer__bottom">
      <span>&copy; <?php echo esc_html(date('Y')); ?> La Casa del Torero · Vejer de la Frontera, Cádiz</span>
      <div>
        <a href="<?php echo esc_url(home_url('/politica-privacidad/')); ?>">Privacidad</a>
        &nbsp;·&nbsp;
        <a href="<?php echo esc_url(home_url('/condiciones-reserva/')); ?>">Condiciones</a>
        &nbsp;·&nbsp;
        <a href="<?php echo esc_url(home_url('/politica-cancelacion/')); ?>">Cancelación</a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
