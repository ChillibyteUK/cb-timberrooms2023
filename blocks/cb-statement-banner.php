<?php
/**
 * CB Statement Banner Block Template.
 *
 * A full-width, mid-page statement: a big centred heading and subtext
 * over a parallax background image with a dark scrim. No CTAs — for
 * that, use CB Hero or CB LP Hero instead.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$background   = get_field( 'background' );
$mobile_bg_id = get_field( 'mobile_background' );
$desktop_img  = $background ? wp_get_attachment_image_url( $background, 'full' ) : '';
$mobile_img   = $mobile_bg_id ? wp_get_attachment_image_url( $mobile_bg_id, 'full' ) : '';
$img          = $desktop_img ? $desktop_img : $mobile_img;

$title   = get_field( 'title' );
$subtext = get_field( 'subtext' );

if ( ! $title && ! $subtext && ! $img ) {
	return;
}

$class    = $block['className'] ?? '';
$block_id = $block['id'] ?? wp_unique_id( 'cb-statement-banner-' );
?>
<section id="<?= esc_attr( $block_id ); ?>" class="statement-banner <?= esc_attr( $class ); ?>">
	<div class="statement-banner__bg">
		<?php if ( $mobile_img && $mobile_img !== $img ) : ?>
		<picture>
			<source media="(max-width: 767px)" srcset="<?= esc_url( $mobile_img ); ?>">
			<img src="<?= esc_url( $img ); ?>" class="statement-banner__parallax-img" alt="">
		</picture>
		<?php elseif ( $img ) : ?>
		<img src="<?= esc_url( $img ); ?>" class="statement-banner__parallax-img" alt="">
		<?php endif; ?>
		<div class="statement-banner__scrim"></div>
	</div>
	<div class="statement-banner__content">
		<div class="container-xl text-center">
			<?php if ( $title ) : ?>
				<h2 data-aos="fade"><?= esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( $subtext ) : ?>
				<p class="statement-banner__subtext" data-aos="fade" data-aos-delay="100"><?= esc_html( $subtext ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
<script>
( function () {
	var banner = document.getElementById( <?= wp_json_encode( $block_id ); ?> );
	if ( ! banner ) return;

	var bg  = banner.querySelector( '.statement-banner__bg' );
	var img = banner.querySelector( '.statement-banner__parallax-img' );
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
