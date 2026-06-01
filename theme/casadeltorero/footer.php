<footer id="site-footer" role="contentinfo">
  <div class="container">

    <div class="footer__grid">

      <!-- Brand -->
      <div class="footer__brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
          <?php bloginfo('name'); ?>
          <span><?php bloginfo('description'); ?></span>
        </a>
        <p>Una experiencia única en el corazón de Andalucía. Tradición, confort y belleza en un entorno privilegiado.</p>
        <div class="footer__social">
          <!-- Instagram -->
          <a href="<?php echo esc_url(get_theme_mod('social_instagram', '#')); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor"/></svg>
          </a>
          <!-- Facebook -->
          <a href="<?php echo esc_url(get_theme_mod('social_facebook', '#')); ?>" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <!-- WhatsApp -->
          <a href="https://wa.me/<?php echo esc_attr(get_theme_mod('contact_whatsapp', '')); ?>" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          </a>
        </div>
      </div>

      <!-- Nav -->
      <div class="footer__col">
        <h4><?php esc_html_e('La Casa', 'casadeltorero'); ?></h4>
        <?php
        wp_nav_menu([
            'theme_location' => 'footer',
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => function () {
                $links = ['#la-casa' => 'Historia', '#espacios' => 'Espacios', '#experiencias' => 'Experiencias', '#galeria' => 'Galería'];
                echo '<ul>';
                foreach ($links as $url => $label) {
                    printf('<li><a href="%s">%s</a></li>', esc_attr($url), esc_html($label));
                }
                echo '</ul>';
            },
        ]);
        ?>
      </div>

      <!-- Info -->
      <div class="footer__col">
        <h4><?php esc_html_e('Información', 'casadeltorero'); ?></h4>
        <ul>
          <li><a href="#reservas"><?php esc_html_e('Reservas', 'casadeltorero'); ?></a></li>
          <li><a href="#normas"><?php esc_html_e('Normas de la casa', 'casadeltorero'); ?></a></li>
          <li><a href="#politica-cancelacion"><?php esc_html_e('Cancelación', 'casadeltorero'); ?></a></li>
          <li><a href="/politica-de-privacidad/"><?php esc_html_e('Privacidad', 'casadeltorero'); ?></a></li>
          <li><a href="/aviso-legal/"><?php esc_html_e('Aviso legal', 'casadeltorero'); ?></a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer__col">
        <h4><?php esc_html_e('Contacto', 'casadeltorero'); ?></h4>
        <address>
          <?php echo wp_kses_post(get_theme_mod('contact_address', 'Dirección de la casa<br>Provincia, España')); ?>
          <br><br>
          <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '')); ?>">
            <?php echo esc_html(get_theme_mod('contact_phone', 'Teléfono')); ?>
          </a>
          <br>
          <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@lacasadeltorero.com')); ?>">
            <?php echo esc_html(get_theme_mod('contact_email', 'info@lacasadeltorero.com')); ?>
          </a>
        </address>
      </div>

    </div><!-- /.footer__grid -->

    <div class="footer__bottom">
      <span>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Todos los derechos reservados.', 'casadeltorero'); ?></span>
      <div>
        <a href="/politica-de-privacidad/"><?php esc_html_e('Privacidad', 'casadeltorero'); ?></a>
        &nbsp;·&nbsp;
        <a href="/aviso-legal/"><?php esc_html_e('Aviso legal', 'casadeltorero'); ?></a>
        &nbsp;·&nbsp;
        <a href="/cookies/"><?php esc_html_e('Cookies', 'casadeltorero'); ?></a>
      </div>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
