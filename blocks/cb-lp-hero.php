<?php
/**
 * CB LP Hero Block Template.
 *
 * A landing-page hero: like CB Hero, but with its own background image
 * (not tied to the post thumbnail), a subtext line, and CTA buttons that
 * are fully configurable per instance instead of hardcoded.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$background     = get_field( 'background' );
$mobile_bg_id   = get_field( 'mobile_background' );
$desktop_img    = $background ? wp_get_attachment_image_url( $background, 'full' ) : '';
$mobile_img     = $mobile_bg_id ? wp_get_attachment_image_url( $mobile_bg_id, 'full' ) : '';
$img            = $desktop_img ? $desktop_img : $mobile_img;

$class = $block['className'] ?? '';

$hclass = '';
if ( 'Yes' === ( get_field( 'centre_title' )[0] ?? null ) ) {
	$hclass .= ' text-center';
}

$block_id = $block['id'] ?? wp_unique_id( 'cb-lp-hero-' );

$title   = get_field( 'title' );
$subtext = get_field( 'subtext' );
$ctas    = get_field( 'ctas' );
?>
<?php if ( $img ) : ?>
<link rel="preload" as="image" href="<?= esc_url( $img ); ?>">
<?php endif; ?>
<header id="<?= esc_attr( $block_id ); ?>" class="lp-hero mb-md-4 <?= esc_attr( $class ); ?>">
	<div class="lp-hero__bg">
		<?php if ( $mobile_img && $mobile_img !== $img ) : ?>
		<picture>
			<source media="(max-width: 767px)" srcset="<?= esc_url( $mobile_img ); ?>">
			<img src="<?= esc_url( $img ); ?>" class="lp-hero__parallax-img" alt="">
		</picture>
		<?php elseif ( $img ) : ?>
		<img src="<?= esc_url( $img ); ?>" class="lp-hero__parallax-img" alt="">
		<?php endif; ?>
	</div>
	<div class="lp-hero__content">
		<div class="container-xl">
			<?php if ( $title ) : ?>
				<h1 data-aos="fade" class="<?= esc_attr( $hclass ); ?>"><?= esc_html( $title ); ?></h1>
			<?php endif; ?>
			<?php if ( $subtext ) : ?>
				<p data-aos="fade" class="lp-hero__subtext<?= esc_attr( $hclass ); ?>"><?= esc_html( $subtext ); ?></p>
			<?php endif; ?>
			<?php if ( $ctas ) : ?>
			<div class="lp-hero__cta-row" data-aos="fade" data-aos-delay="100">
				<?php foreach ( $ctas as $cta ) : ?>
					<?php
					$link = $cta['link'] ?? null;
					if ( ! $link || empty( $link['url'] ) ) {
						continue;
					}
					$btn_class = 'outline' === $cta['style'] ? 'btn--outline' : 'btn-primary';
					?>
				<a href="<?= esc_url( $link['url'] ); ?>" class="btn <?= esc_attr( $btn_class ); ?>"<?= $link['target'] ? ' target="_blank"' : ''; ?>><?= esc_html( $link['title'] ); ?></a>
					<?php
				endforeach;
				?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</header>
<script>
( function () {
	var hero = document.getElementById( <?= wp_json_encode( $block_id ); ?> );
	if ( ! hero ) return;

	var bg  = hero.querySelector( '.lp-hero__bg' );
	var img = hero.querySelector( '.lp-hero__parallax-img' );
	if ( ! bg || ! img ) return;

	var ticking = false;

	function update() {
		var rect = bg.getBoundingClientRect();
		var winH = window.innerHeight;

		if ( rect.bottom > 0 && rect.top < winH ) {
			var percent    = ( winH - rect.top ) / ( winH + rect.height );
			percent        = Math.max( 0, Math.min( 1, percent ) );
			var translateY = ( percent - 0.5 ) * 240;
			img.style.transform = 'translateY(' + translateY.toFixed( 1 ) + 'px)';
		}

		ticking = false;
	}

	function onScroll() {
		if ( ! ticking ) {
			window.requestAnimationFrame( update );
			ticking = true;
		}
	}

	window.addEventListener( 'scroll', onScroll, { passive: true } );
	window.addEventListener( 'resize', onScroll );
	onScroll();
}() );
</script>
