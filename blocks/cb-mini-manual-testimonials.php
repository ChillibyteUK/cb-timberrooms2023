<?php
/**
 * Block template for CB Mini Manual Testimonials.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;



?>
<section class="cb-mini-manual-testimonials">
	<div class="container py-2">
		<div class="d-flex gap-3 align-items-center">
			<?php
			$star_rating = get_field( 'star_rating' );
			if ( $star_rating ) {
				?>
			<div class="cb-mini-manual-testimonials__stars">
				<?php
				for ( $i = 0; $i < 5; $i++ ) {
					if ( $i < $star_rating ) {
						echo '<span class="fa fa-star"></span>';
					} else {
						echo '<span class="fa fa-star-o"></span>';
					}
				}
				?>
			</div>
				<?php
			}
			?>
			<div class="cb-mini-manual-testimonials__testimonials swiper">
				<div class="swiper-wrapper">
				<?php
				while ( have_rows( 'reviews' ) ) {
					the_row();
					?>
					<div class="cb-mini-manual-testimonials__testimonial swiper-slide">
						<div class="cb-mini-manual-testimonials__text">
							<?php the_sub_field( 'testimonial' ); ?>
						</div>
						<div class="cb-mini-manual-testimonials__author">
							<?php the_sub_field( 'author' ); ?>
						</div>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
static $cb_mini_manual_testimonials_script_added = false;

if ( ! $cb_mini_manual_testimonials_script_added ) {
	$cb_mini_manual_testimonials_script_added = true;

	add_action(
		'wp_footer',
		function () {
			?>
<script>
( function () {
	function initMiniManualTestimonials() {
		if ( typeof Swiper === 'undefined' ) {
			return;
		}

		document.querySelectorAll( '.cb-mini-manual-testimonials__testimonials' ).forEach( function ( el ) {
			if ( el.dataset.swiperInit ) {
				return;
			}

			if ( el.querySelectorAll( '.swiper-slide' ).length < 2 ) {
				return;
			}

			el.dataset.swiperInit = '1';

			new Swiper( el, {
				loop           : true,
				slidesPerView  : 1,
				slidesPerGroup : 1,
				speed          : 700,
				allowTouchMove : false,
				autoplay       : {
					delay               : 4000,
					disableOnInteraction: false,
					pauseOnMouseEnter   : false,
				},
			} );
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initMiniManualTestimonials );
	} else {
		initMiniManualTestimonials();
	}
}() );
</script>
			<?php
		},
		30
	);
}