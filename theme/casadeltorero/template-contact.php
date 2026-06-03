<?php
/**
 * Template Name: Contacto
 */
get_header();

$has_acf = function_exists('get_field');
$go      = fn($k) => $has_acf ? get_field($k, 'option') : null;

$phone    = $go('contact_phone')   ?: '+34 615 508 168';
$email    = $go('contact_email')   ?: 'info@lacasadeltorero.com';
$address  = $go('contact_address') ?: "DS Abejaruco, Pol. 65 Parc. 85\nCañada Ancha · 11150 Vejer de la Frontera\nCádiz, Andalucía · España";
$wa_raw   = $go('social_whatsapp') ?: '34615508168';
$wa_url   = 'https://wa.me/' . preg_replace('/\D/', '', $wa_raw);
$instagram = $go('social_instagram') ?: 'https://www.instagram.com/casadeltorerovejer/';
$facebook  = $go('social_facebook')  ?: 'https://www.facebook.com/casadeltorerovejer';
?>

<section class="page-hero page-hero--short">
  <div class="page-hero__content">
    <div class="container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>

<main id="main" class="contact-page">
  <div class="container">

    <div class="contact-grid reveal">

      <!-- Contact info -->
      <div class="contact-info">

        <div class="contact-info__card">
          <div class="contact-info__icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92V19.92a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div>
            <h4>Teléfono</h4>
            <a href="tel:<?php echo esc_attr(str_replace([' ', '+'], ['', ''], $phone)); ?>"><?php echo esc_html($phone); ?></a>
          </div>
        </div>

        <div class="contact-info__card">
          <div class="contact-info__icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <h4>Email</h4>
            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
          </div>
        </div>

        <div class="contact-info__card">
          <div class="contact-info__icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div>
            <h4>Dirección</h4>
            <address><?php echo nl2br(esc_html($address)); ?></address>
          </div>
        </div>

        <a href="<?php echo esc_url($wa_url); ?>" class="btn btn--gold contact-wa" target="_blank" rel="noopener">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          Contactar por WhatsApp
        </a>

        <div class="contact-social">
          <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor"/></svg>
          </a>
          <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
        </div>

      </div><!-- /.contact-info -->

      <!-- Contact form -->
      <div class="contact-form reveal">
        <h2>Envíanos un mensaje</h2>
        <?php if (function_exists('wpforms_display')) :
          // If WPForms is active, use its shortcode — site admin should set the ID
          echo do_shortcode('[wpforms id="contact"]');
        else : ?>
        <form class="contact-form__form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
          <?php wp_nonce_field('casadeltorero_contact', '_contact_nonce'); ?>
          <input type="hidden" name="action" value="casadeltorero_contact">
          <div class="contact-form__row">
            <label for="cf_name">Nombre <span aria-hidden="true">*</span></label>
            <input type="text" id="cf_name" name="cf_name" required autocomplete="name">
          </div>
          <div class="contact-form__row">
            <label for="cf_email">Email <span aria-hidden="true">*</span></label>
            <input type="email" id="cf_email" name="cf_email" required autocomplete="email">
          </div>
          <div class="contact-form__row">
            <label for="cf_phone">Teléfono</label>
            <input type="tel" id="cf_phone" name="cf_phone" autocomplete="tel">
          </div>
          <div class="contact-form__row">
            <label for="cf_checkin">Fecha de llegada</label>
            <input type="date" id="cf_checkin" name="cf_checkin">
          </div>
          <div class="contact-form__row">
            <label for="cf_checkout">Fecha de salida</label>
            <input type="date" id="cf_checkout" name="cf_checkout">
          </div>
          <div class="contact-form__row contact-form__row--full">
            <label for="cf_message">Mensaje <span aria-hidden="true">*</span></label>
            <textarea id="cf_message" name="cf_message" rows="5" required></textarea>
          </div>
          <div class="contact-form__row contact-form__row--full">
            <button type="submit" class="btn btn--gold btn--full">Enviar mensaje</button>
          </div>
        </form>
        <?php endif; ?>
      </div>

    </div><!-- /.contact-grid -->

    <!-- Map -->
    <div class="contact-map reveal">
      <iframe
        src="https://www.openstreetmap.org/export/embed.html?bbox=-6.0031%2C36.2586%2C-5.9031%2C36.2966&amp;layer=mapnik&amp;marker=36.27762%2C-5.95314"
        width="100%" height="420" style="border:0;border-radius:8px;" loading="lazy"
        title="Ubicación La Casa del Torero"></iframe>
    </div>

  </div><!-- /.container -->
</main>

<?php get_footer(); ?>
