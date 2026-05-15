<?php
/**
 * Block template for CB Room Type Cards.
 *
 * Renders a Swiper slider of child pages under /room-types/.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$heading = get_field( 'heading' );
$extra   = $block['className'] ?? '';

$parent = get_page_by_path( 'room-types' );
if ( ! $parent ) {
	return;
}

$rooms = get_posts(
	array(
		'post_type'      => 'page',
		'post_parent'    => $parent->ID,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

if ( empty( $rooms ) ) {
	return;
}

?>
<div class="room-type-cards <?= esc_attr( $extra ); ?>">
	<div class="container">
		<?php
		if ( $heading ) {
			?>
			<div class="d-flex justify-content-between align-items-center">
				<h2 class="room-type-cards__heading container-xl" data-aos="fade"><?= esc_html( $heading ); ?></h2>
				<a href="/room-types/" class="btn btn--outline">View Rooms</a>
			</div>
			<?php
		}
		?>
		<section class="room-type-cards__swiper swiper pb-5" aria-label="<?php esc_attr_e( 'Room Types', 'cb-timberrooms2023' ); ?>">
			<div class="swiper-wrapper">
				<?php
				foreach ( $rooms as $room ) {
					$img    = get_the_post_thumbnail_url( $room->ID, 'large' );
					$ctitle = get_the_title( $room->ID );
					$url    = get_permalink( $room->ID );
					?>
				<div class="swiper-slide room-type-cards__slide">
					<a href="<?= esc_url( $url ); ?>" class="room-type-cards__card">
						<div class="room-type-cards__img-wrap">
							<?php if ( $img ) : ?>
							<img src="<?= esc_url( $img ); ?>" alt="<?= esc_attr( $ctitle ); ?>" loading="lazy">
							<?php endif; ?>
							<div class="room-type-cards__body">
								<h3 class="room-type-cards__title"><?= esc_html( $ctitle ); ?></h3>
								<span class="room-type-cards__cta">Find out more &rarr;</span>
							</div>
						</div>
					</a>
				</div>
					<?php
				}
				?>
			</div>

			<div class="swiper-pagination room-type-cards__pagination"></div>
		</section>
	</div>
</div>
<?php
static $cb_room_type_cards_script_added = false;

if ( ! $cb_room_type_cards_script_added ) {
	$cb_room_type_cards_script_added = true;

	add_action(
		'wp_footer',
		function () {
			?>
<script>
( function () {
	if ( typeof Swiper === 'undefined' ) {
		return;
	}

	document.querySelectorAll( '.room-type-cards__swiper' ).forEach( function ( el ) {
		if ( el.dataset.swiperInit ) {
			return;
		}

		el.dataset.swiperInit = '1';

		new Swiper( el, {
			loop            : true,
			slidesPerView   : 4,
			slidesPerGroup  : 1,
			spaceBetween    : 16,
			speed           : 600,
			autoplay        : {
				delay               : 3000,
				disableOnInteraction: false,
				pauseOnMouseEnter   : true,
			},
			pagination    : {
				el        : el.querySelector( '.room-type-cards__pagination' ),
				clickable : true,
			},
			breakpoints: {
				0  : { slidesPerView: 1 },
				480: { slidesPerView: 2 },
				768: { slidesPerView: 3 },
				992: { slidesPerView: 4 },
			}
		} );
	} );
}() );
</script>
			<?php
		},
		30
	);
}
