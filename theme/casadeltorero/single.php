<?php get_header(); ?>

<style>
/* ── Post hero ── */
.post-hero { position: relative; height: clamp(320px,45vw,520px); overflow: hidden; }
.post-hero__img { width: 100%; height: 100%; object-fit: cover; }
.post-hero__overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.65) 0%, rgba(0,0,0,.2) 100%); }
.post-hero__meta { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; padding: clamp(2rem,5vw,4rem); text-align: center; color: #fff; }
.post-hero__cat { font-size: .6rem; letter-spacing: .22em; text-transform: uppercase; color: var(--gold-lt); margin-bottom: 1rem; font-family: var(--sans); font-weight: 500; }
.post-hero__title { font-family: var(--serif); font-size: clamp(1.75rem,4vw,3.25rem); line-height: 1.15; max-width: 800px; }
.post-hero__date { margin-top: .75rem; font-size: .78rem; color: rgba(255,255,255,.6); font-family: var(--sans); }

/* ── Post body ── */
.post-body { max-width: 740px; margin: 0 auto; padding: clamp(3rem,6vw,6rem) 1.5rem; }
.post-body h2,.post-body h3 { font-family: var(--serif); margin: 2rem 0 .75rem; color: var(--text); }
.post-body h2 { font-size: clamp(1.5rem,2.5vw,2rem); }
.post-body h3 { font-size: clamp(1.2rem,2vw,1.5rem); }
.post-body p { line-height: 1.85; color: var(--text); margin-bottom: 1.25rem; font-size: 1.0625rem; }
.post-body ul { padding-left: 1.5rem; margin-bottom: 1.25rem; list-style: disc; }
.post-body ul li { line-height: 1.75; margin-bottom: .4rem; color: var(--text); }
.post-body blockquote { border-left: 3px solid var(--gold); padding: 1rem 1.5rem; margin: 2rem 0; font-family: var(--serif); font-size: 1.2rem; color: var(--muted); font-style: italic; }
.post-body img { max-width: 100%; height: auto; margin: 1.5rem 0; }
.post-body a { color: var(--gold); text-decoration: underline; }
.post-body a:hover { color: var(--blue); }

/* ── Related posts heading ── */
.related-posts__eyebrow { display: block; margin-bottom: .5rem; }

/* ── Author bio ── */
.post-author { max-width: 740px; margin: 0 auto; padding: 0 1.5rem 3rem; display: flex; gap: 1.5rem; align-items: flex-start; border-top: 1px solid var(--border); padding-top: 2rem; }
.post-author__avatar { width: 64px; height: 64px; border-radius: 50%; object-fit: cover; flex-shrink: 0; background: var(--border); display: flex; align-items: center; justify-content: center; overflow: hidden; }
.post-author__avatar img { width: 100%; height: 100%; object-fit: cover; }
.post-author__info { flex: 1; }
.post-author__name { font-family: var(--serif); font-size: 1.1rem; margin-bottom: .35rem; }
.post-author__bio { font-size: .875rem; color: var(--muted); line-height: 1.65; }

/* ── Related posts ── */
.related-posts { padding: var(--py) 0; background: var(--cream); }
.related-posts__heading { font-family: var(--serif); font-size: 1.75rem; text-align: center; margin-bottom: 2.5rem; color: var(--text); }
.related-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
.related-card { background: var(--white); display: flex; flex-direction: column; }
.related-card__img { aspect-ratio: 16/9; overflow: hidden; }
.related-card__img img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s ease; }
.related-card:hover .related-card__img img { transform: scale(1.04); }
.related-card__body { padding: 1.25rem 1.5rem; flex: 1; display: flex; flex-direction: column; }
.related-card__cat { font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; color: var(--gold); font-family: var(--sans); margin-bottom: .5rem; }
.related-card__title { font-family: var(--serif); font-size: 1.05rem; line-height: 1.3; flex: 1; }
.related-card__title a { color: var(--text); }
.related-card__title a:hover { color: var(--gold); }
@media(max-width:768px){ .related-grid { grid-template-columns: 1fr; } }
</style>

<?php while ( have_posts() ) : the_post(); ?>

<?php
$cats      = get_the_category();
$cat_name  = $cats ? $cats[0]->name : '';
$has_acf   = function_exists( 'get_field' );
$go        = fn( $k ) => $has_acf ? get_field( $k, 'option' ) : null;

$cta_title = $go('cta_title') ?: '¿Lista para vivir la experiencia?';
$cta_text  = $go('cta_text')  ?: 'Reserva tu estancia en La Casa del Torero. Contacta con nosotros y te preparamos una propuesta a medida.';
$whatsapp  = $go('social_whatsapp') ?: '34615508168';
?>

<!-- ══ HERO ══ -->
<div class="post-hero">
  <?php if ( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail( 'full', [ 'class' => 'post-hero__img', 'alt' => get_the_title(), 'loading' => 'eager' ] ); ?>
  <?php else : ?>
    <img class="post-hero__img"
         src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/galeria/exterior-1.jpg' ); ?>"
         alt="<?php echo esc_attr( get_the_title() ); ?>">
  <?php endif; ?>
  <div class="post-hero__overlay"></div>
  <div class="post-hero__meta">
    <?php if ( $cat_name ) : ?>
    <span class="post-hero__cat"><?php echo esc_html( $cat_name ); ?></span>
    <?php endif; ?>
    <h1 class="post-hero__title"><?php the_title(); ?></h1>
    <time class="post-hero__date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j \d\e F \d\e Y'); ?></time>
  </div>
</div>

<!-- ══ ARTICLE BODY ══ -->
<article class="post-body reveal" id="post-<?php the_ID(); ?>">
  <?php the_content(); ?>
</article>

<!-- ══ AUTHOR BIO ══ -->
<div class="post-author">
  <div class="post-author__avatar">
    <?php
    $author_id = get_the_author_meta('ID');
    echo get_avatar( $author_id, 64, '', get_the_author(), [ 'class' => '' ] );
    ?>
  </div>
  <div class="post-author__info">
    <p class="post-author__name"><?php the_author(); ?></p>
    <p class="post-author__bio">El equipo de La Casa del Torero. Una finca histórica en Vejer de la Frontera, Cádiz, donde la tradición, la naturaleza y el lujo rural conviven en armonía.</p>
  </div>
</div>

<?php endwhile; ?>

<!-- ══ CTA ══ -->
<section class="cta-banner post-cta" aria-label="Reserva tu estancia">
  <div class="cta-banner__bg" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/casa/aerea.jpg')"></div>
  <div class="container cta-banner__inner reveal">
    <span class="eyebrow">Tu próxima escapada</span>
    <h2 class="cta-banner__title"><?php echo esc_html( $cta_title ); ?></h2>
    <div class="gold-rule"></div>
    <p class="cta-banner__text"><?php echo esc_html( $cta_text ); ?></p>
    <div class="cta-banner__actions">
      <a href="<?php echo esc_url( home_url( '/reservas/' ) ); ?>" class="btn btn--gold">Ver disponibilidad</a>
      <a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" class="btn btn--ghost" target="_blank" rel="noopener noreferrer">WhatsApp</a>
    </div>
  </div>
</section>

<!-- ══ RELATED POSTS ══ -->
<?php
global $post;
$current_id = get_the_ID();
// If endwhile already ran, re-grab the post
if ( ! $current_id ) {
    rewind_posts();
    while ( have_posts() ) { the_post(); $current_id = get_the_ID(); }
}
$current_cats = wp_get_post_categories( $current_id );

$related = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => [ $current_id ],
    'category__in'   => $current_cats ?: [],
    'orderby'        => 'rand',
] );

if ( $related->have_posts() ) : ?>
<section class="related-posts reveal">
  <div class="container">
    <span class="eyebrow related-posts__eyebrow">Sigue leyendo</span>
    <h2 class="related-posts__heading">Más artículos</h2>
    <div class="related-grid">
      <?php while ( $related->have_posts() ) : $related->the_post(); ?>
      <article class="related-card">
        <div class="related-card__img">
          <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
            <?php else : ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/galeria/exterior-1.jpg' ); ?>"
                   alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
            <?php endif; ?>
          </a>
        </div>
        <div class="related-card__body">
          <?php $rcats = get_the_category(); ?>
          <?php if ( $rcats ) : ?>
          <span class="related-card__cat"><?php echo esc_html( $rcats[0]->name ); ?></span>
          <?php endif; ?>
          <h4 class="related-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h4>
        </div>
      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
