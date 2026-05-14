<?php
/**
 * CB Hero Block Template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$img = '';
if ( get_field( 'background' ) ) {
	$img = wp_get_attachment_image_url( get_field( 'background' ), 'full' );
} else {
	$img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
}

$class = $block['className'] ?? '';

$hclass = '';
if ( 'Yes' === ( get_field( 'centre_title' )[0] ?? null ) ) {
	$hclass .= ' text-center';
}

$block_id = $block['id'] ?? wp_unique_id( 'cb-hero-' );
?>
<link rel="preload" as="image" href="<?= esc_url( $img ); ?>">
<header id="<?= esc_attr( $block_id ); ?>" class="hero <?= esc_attr( $class ); ?>">
	<div class="hero__bg">
		<img src="<?= esc_url( $img ); ?>" class="hero__parallax-img" alt="">
	</div>
	<?php if ( null !== get_field( 'theme' ) && 'None' !== get_field( 'theme' ) ) :
		$logo = 'Pods' === get_field( 'theme' ) ? 'timberrooms-logo-prefab--wo.svg' : 'timberrooms-logo--wo.svg';
	?>
	<div class="logo py-4">
		<div class="container-xl text-center" data-aos="fade">
			<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/' . $logo ); ?>" alt="">
		</div>
	</div>
	<?php endif; ?>
	<div class="hero__content">
		<div class="container-xl">
			<h1 data-aos="fade" class="<?= esc_attr( $hclass ); ?>"><?= esc_html( get_field( 'title' ) ); ?></h1>
			<div class="hero__cta-row" data-aos="fade" data-aos-delay="100">
				<a href="/contact/" class="btn btn--accent">Get a free quote &rarr;</a>
				<a href="/room-types/" class="btn btn--outline">View rooms</a>
			</div>
		</div>
	</div>
</header>
<script>
( function () {
	var hero = document.getElementById( <?= wp_json_encode( $block_id ); ?> );
	if ( ! hero ) return;

	var bg  = hero.querySelector( '.hero__bg' );
	var img = hero.querySelector( '.hero__parallax-img' );
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
