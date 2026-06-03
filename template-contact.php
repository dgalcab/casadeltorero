<?php
/**
 * Template Name: Contacto
 */
get_header();

$has_acf = function_exists('get_field');
$go      = fn($k) => $has_acf ? get_field($k, 'option') : null;

$phone    = $go('contact_phone')    ?: '+34 615 508 168';
$email    = $go('contact_email')    ?: 'info@lacasadeltorero.com';
$address  = $go('contact_address')  ?: "DS Abejaruco, Pol. 65 Parc. 85\nCañada Ancha · 11150 Vejer de la Frontera\nCádiz, Andalucía · España";
$wa_num   = preg_replace('/\D/', '', $go('social_whatsapp') ?: '34615508168');
$wa_url   = 'https://wa.me/' . $wa_num;
$instagram = $go('social_instagram') ?: 'https://www.instagram.com/casadeltorerovejer/';
$facebook  = $go('social_facebook')  ?: 'https://www.facebook.com/casadeltorerovejer';
?>

<style>
/* hero → uses shared .page-hero from main.css */

/* ── Contact body ── */
.contact-body { background: var(--cream); padding: var(--py) 0; }
.contact-layout {
  display: grid;
  grid-template-columns: 1fr 1.4fr;
  gap: clamp(3rem,6vw,7rem);
  align-items: start;
}

/* ── Info column ── */
.contact-aside { position: sticky; top: 7rem; }
.contact-aside__title {
  font-family: var(--serif);
  font-size: clamp(1.75rem,2.5vw,2.25rem);
  margin-bottom: .5rem;
  line-height: 1.2;
}
.contact-aside__lead {
  color: var(--muted);
  font-size: .9375rem;
  line-height: 1.75;
  margin-bottom: 2.5rem;
}
.contact-details { display: flex; flex-direction: column; gap: 0; margin-bottom: 2.5rem; }
.contact-detail {
  display: flex;
  align-items: flex-start;
  gap: 1.25rem;
  padding: 1.25rem 0;
  border-bottom: 1px solid var(--border);
}
.contact-detail:first-child { border-top: 1px solid var(--border); }
.contact-detail__icon {
  width: 36px;
  height: 36px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 2px;
}
.contact-detail__icon svg { width: 18px; height: 18px; stroke: var(--gold); fill: none; stroke-width: 1.5; }
.contact-detail__label {
  font-family: var(--sans);
  font-size: .58rem;
  font-weight: 600;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: var(--muted);
  margin-bottom: .35rem;
}
.contact-detail__value { font-size: .9375rem; line-height: 1.65; color: var(--text); }
.contact-detail__value a { color: var(--text); text-decoration: none; transition: color var(--ease); }
.contact-detail__value a:hover { color: var(--gold); }
.contact-detail__value address { font-style: normal; }

.contact-actions { display: flex; flex-direction: column; gap: .85rem; }
.contact-actions .btn { display: flex; align-items: center; justify-content: center; gap: .6rem; }
.contact-actions .btn svg { width: 17px; height: 17px; flex-shrink: 0; }

.contact-social { display: flex; gap: .75rem; margin-top: 2rem; }
.contact-social__link {
  width: 40px; height: 40px;
  border: 1px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  color: var(--muted);
  text-decoration: none;
  transition: color var(--ease), border-color var(--ease), background var(--ease);
}
.contact-social__link:hover { color: var(--white); background: var(--gold); border-color: var(--gold); }
.contact-social__link svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 1.5; }

/* ── Form column ── */
.contact-form-wrap {
  background: var(--white);
  padding: clamp(2.5rem,5vw,4rem);
  border: 1px solid var(--border);
}
.contact-form-wrap h2 {
  font-family: var(--serif);
  font-size: clamp(1.5rem,2vw,2rem);
  margin-bottom: .5rem;
}
.contact-form-wrap .form-lead {
  color: var(--muted);
  font-size: .9rem;
  line-height: 1.65;
  margin-bottom: 2rem;
}
.contact-form { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem 1.5rem; }
.contact-form__field { display: flex; flex-direction: column; gap: .4rem; }
.contact-form__field--full { grid-column: 1 / -1; }
.contact-form__field label {
  font-family: var(--sans);
  font-size: .7rem;
  font-weight: 600;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--text);
}
.contact-form__field label .req { color: var(--gold); margin-left: 2px; }
.contact-form__field input,
.contact-form__field textarea,
.contact-form__field select {
  border: 1px solid var(--border);
  background: var(--cream);
  padding: .9rem 1rem;
  font-family: var(--sans);
  font-size: .9375rem;
  color: var(--text);
  outline: none;
  width: 100%;
  transition: border-color var(--ease), background var(--ease);
  appearance: none;
}
.contact-form__field input:focus,
.contact-form__field textarea:focus,
.contact-form__field select:focus { border-color: var(--gold); background: var(--white); }
.contact-form__field textarea { resize: vertical; min-height: 140px; }
.contact-form__submit { grid-column: 1 / -1; }
.contact-form__submit .btn { width: 100%; justify-content: center; margin-top: .5rem; padding: 1.1rem 2rem; }

/* ── Map ── */
.contact-map-section { background: var(--white); padding: 0; }
.contact-map-section iframe { display: block; width: 100%; height: clamp(300px,40vw,480px); border: none; }

@media(max-width:960px) {
  .contact-layout { grid-template-columns: 1fr; }
  .contact-aside { position: static; }
  .contact-form { grid-template-columns: 1fr; }
  .contact-form__field--full { grid-column: 1; }
}
</style>

<!-- HERO -->
<section class="page-hero" style="--hero-bg:url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/casa/aerea.jpg')">
  <div class="container page-hero__inner">
    <span class="eyebrow">Estamos encantados de atenderte</span>
    <h1>Contacto</h1>
    <p>Para reservas, consultas o simplemente para conocernos mejor. Respondemos en menos de 24 horas.</p>
    <div class="gold-rule"></div>
  </div>
</section>

<!-- BODY -->
<div class="contact-body">
  <div class="container">
    <div class="contact-layout">

      <!-- LEFT: info -->
      <aside class="contact-aside reveal">
        <h2 class="contact-aside__title">Hablemos</h2>
        <p class="contact-aside__lead">Puedes contactarnos por el canal que prefieras. El WhatsApp suele ser la forma más rápida de obtener respuesta y confirmación de disponibilidad.</p>

        <div class="contact-details">
          <div class="contact-detail">
            <span class="contact-detail__icon">
              <svg viewBox="0 0 24 24"><path d="M22 16.92V19.92a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </span>
            <div>
              <p class="contact-detail__label">Teléfono</p>
              <div class="contact-detail__value">
                <a href="tel:<?php echo esc_attr(preg_replace('/\D/','',$phone)); ?>"><?php echo esc_html($phone); ?></a>
              </div>
            </div>
          </div>

          <div class="contact-detail">
            <span class="contact-detail__icon">
              <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </span>
            <div>
              <p class="contact-detail__label">Email</p>
              <div class="contact-detail__value">
                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
              </div>
            </div>
          </div>

          <div class="contact-detail">
            <span class="contact-detail__icon">
              <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </span>
            <div>
              <p class="contact-detail__label">Dirección</p>
              <div class="contact-detail__value">
                <address><?php echo nl2br(esc_html($address)); ?></address>
              </div>
            </div>
          </div>
        </div>

        <div class="contact-actions">
          <a href="<?php echo esc_url($wa_url); ?>" class="btn btn--gold" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            WhatsApp
          </a>
          <a href="mailto:<?php echo esc_attr($email); ?>" class="btn btn--dark">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="17" height="17"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            Enviar email
          </a>
        </div>

        <div class="contact-social">
          <a href="<?php echo esc_url($instagram); ?>" class="contact-social__link" target="_blank" rel="noopener" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor" stroke="none"/></svg>
          </a>
          <a href="<?php echo esc_url($facebook); ?>" class="contact-social__link" target="_blank" rel="noopener" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
        </div>
      </aside>

      <!-- RIGHT: form -->
      <div class="contact-form-wrap reveal d1">
        <h2>Envíanos un mensaje</h2>
        <p class="form-lead">Cuéntanos qué fechas te interesan y cualquier detalle especial. Te responderemos con disponibilidad y una propuesta personalizada.</p>

        <?php if (function_exists('wpforms_display')) :
          echo do_shortcode('[wpforms id="contact"]');
        else : ?>
        <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
          <?php wp_nonce_field('casadeltorero_contact', '_contact_nonce'); ?>
          <input type="hidden" name="action" value="casadeltorero_contact">

          <div class="contact-form__field">
            <label for="cf_name">Nombre <span class="req">*</span></label>
            <input type="text" id="cf_name" name="cf_name" required autocomplete="name" placeholder="Tu nombre">
          </div>

          <div class="contact-form__field">
            <label for="cf_email">Email <span class="req">*</span></label>
            <input type="email" id="cf_email" name="cf_email" required autocomplete="email" placeholder="tu@email.com">
          </div>

          <div class="contact-form__field">
            <label for="cf_phone">Teléfono</label>
            <input type="tel" id="cf_phone" name="cf_phone" autocomplete="tel" placeholder="+34 600 000 000">
          </div>

          <div class="contact-form__field">
            <label for="cf_guests">Número de personas</label>
            <select id="cf_guests" name="cf_guests">
              <option value="">— Selecciona —</option>
              <option>1–2 personas</option>
              <option>3–4 personas</option>
              <option>5–8 personas</option>
              <option>Más de 8 personas</option>
            </select>
          </div>

          <div class="contact-form__field">
            <label for="cf_checkin">Fecha de llegada</label>
            <input type="date" id="cf_checkin" name="cf_checkin">
          </div>

          <div class="contact-form__field">
            <label for="cf_checkout">Fecha de salida</label>
            <input type="date" id="cf_checkout" name="cf_checkout">
          </div>

          <div class="contact-form__field contact-form__field--full">
            <label for="cf_message">Mensaje <span class="req">*</span></label>
            <textarea id="cf_message" name="cf_message" rows="5" required placeholder="Cuéntanos qué estás buscando, si tienes alguna petición especial, si es para una celebración..."></textarea>
          </div>

          <div class="contact-form__submit">
            <button type="submit" class="btn btn--gold">Enviar mensaje</button>
          </div>
        </form>
        <?php endif; ?>
      </div>

    </div>
  </div>
</div>

<!-- MAP -->
<div class="contact-map-section">
  <iframe
    src="https://www.openstreetmap.org/export/embed.html?bbox=-6.0031%2C36.2586%2C-5.9031%2C36.2966&layer=mapnik&marker=36.27762%2C-5.95314"
    title="Ubicación La Casa del Torero"
    loading="lazy"
    allowfullscreen></iframe>
</div>

<!-- CTA -->
<section class="cta-banner" aria-label="Reserva tu estancia">
  <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/casa/aerea.jpg')"></div>
  <div class="container cta-banner__inner reveal">
    <span class="eyebrow">Reserva directa</span>
    <h2 class="cta-banner__title">¿Lista para vivir la experiencia?</h2>
    <div class="gold-rule"></div>
    <p class="cta-banner__text">Reserva tu estancia en La Casa del Torero. Directamente con nosotros, sin intermediarios y con las mejores condiciones.</p>
    <div class="cta-banner__actions">
      <a href="<?php echo esc_url(home_url('/reservas/')); ?>" class="btn btn--gold">Ver disponibilidad</a>
      <a href="<?php echo esc_url(home_url('/habitaciones/')); ?>" class="btn btn--ghost">Ver habitaciones</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
