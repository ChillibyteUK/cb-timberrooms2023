<?php
/**
 * CB Gallery Block Template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$theme = get_field( 'theme' );

switch ( $theme ) {
	case 'Pods':
		$theme = 'has-prefab-color';
		break;
	case 'Golf':
		$theme = 'has-golf-color';
		break;
	default:
		$theme = 'has-primary-color';
}

$columns       = get_field( 'columns' ) ?: '3';
$full_width    = 'Yes' === ( get_field( 'full_width' )[0] ?? null );
$show_captions = 'Yes' === ( get_field( 'show_captions' )[0] ?? null );

$grid_class = 'gallery__grid' . ( '4' === $columns ? ' gallery__grid--cols-4' : '' );

$section_class = 'gallery has-dark-background-color py-5';
if ( $full_width ) {
	$section_class .= ' gallery--full';
}
if ( $show_captions ) {
	$section_class .= ' gallery--captions';
}
?>
<!-- faq_block -->
<section class="<?= esc_attr( $section_class ); ?>">
	<?php if ( ! $full_width ) : ?>
	<div class="container-xl">
	<?php endif; ?>
		<div class="<?= esc_attr( $grid_class ); ?>" id="lightslider">
			<?php
			$d       = 0;
			$gallery = array_reverse( get_field( 'images' ) );
			foreach ( $gallery as $g ) {
				if ( $g['image'] ) {
					$i = $g['image'];
					?>
				<figure class="gallery__image"
					data-aos="fade"
					data-aos-delay="<?= esc_attr( $d ); ?>"
					data-aos-anchor=".gallery__grid">
					<a href="<?= esc_url( wp_get_attachment_image_url( $i, 'full' ) ); ?>"
						data-fancybox="gallery">
						<img src="<?= esc_url( wp_get_attachment_image_url( $i, 'large' ) ); ?>"
							alt="<?= esc_attr( $g['image_title'] ); ?>">
						<div class="overlay">
							<h3 class="<?= esc_attr( $theme ); ?>"><?= esc_html( $g['image_title'] ); ?></h3>
							<div class="text-center">
								<?php
								if ( '' !== $g['town'] ) {
									echo esc_html( $g['town'] );
								}
								if ( $g['town'] && $g['county'] ) {
									echo ' - ';
								}
								if ( '' !== $g['county'] ) {
									echo esc_html( $g['county'] );
								}
								?>
							</div>
						</div>
					</a>
					<?php if ( $show_captions && $g['image_title'] ) : ?>
						<div class="gallery__caption"><?= esc_html( $g['image_title'] ); ?></div>
					<?php endif; ?>
					<figcaption>
						<?= esc_html( $g['image_title'] ); ?><br>
						<?php
						if ( '' !== $g['town'] ) {
							echo esc_html( $g['town'] );
						}
						if ( $g['town'] && $g['county'] ) {
							echo ' - ';
						}
						if ( '' !== $g['county'] ) {
							echo esc_html( $g['county'] );
						}
						?>
					</figcaption>
				</figure>
					<?php
				} else {
					$i        = $g['case_study'][0];
					$cs_title = get_the_title( $i );
					$cs_url   = get_the_permalink( $i );
					$cs_thumb = get_the_post_thumbnail_url( $i, 'full' );
					$cs_large = get_the_post_thumbnail_url( $i, 'large' );
					$town     = '';
					if ( get_the_terms( $i, 'towns' ) ) {
						$town = get_the_terms( $i, 'towns' )[0]->name;
					}
					$county = '';
					if ( get_the_terms( $i, 'counties' ) ) {
						$county = get_the_terms( $i, 'counties' )[0]->name;
					}
					?>
				<figure class="gallery__image"
					data-aos="fade"
					data-aos-delay="<?= esc_attr( $d ); ?>"
					data-aos-anchor=".gallery__grid">
					<a href="<?= esc_url( $cs_thumb ); ?>"
						data-fancybox="gallery">
						<img src="<?= esc_url( $cs_large ); ?>"
							alt="<?= esc_attr( $cs_title ); ?>">
						<div class="overlay">
							<h3 class="<?= esc_attr( $theme ); ?>"><?= esc_html( $cs_title ); ?></h3>
							<div class="text-center">
								<?php
								if ( '' !== $town ) {
									echo esc_html( $town );
								}
								if ( $town && $county ) {
									echo ' - ';
								}
								if ( '' !== $county ) {
									echo esc_html( $county );
								}
								?>
							</div>
							<div class="text-center"><i class="fa-regular fa-eye"></i> Case Study</div>
						</div>
					</a>
					<?php if ( $show_captions ) : ?>
						<div class="gallery__caption"><?= esc_html( $cs_title ); ?></div>
					<?php endif; ?>
					<figcaption>
						<?= esc_html( $cs_title ); ?><br>
						<?php
						if ( '' !== $town ) {
							echo esc_html( $town );
						}
						if ( $town && $county ) {
							echo ' - ';
						}
						if ( '' !== $county ) {
							echo esc_html( $county );
						}
						?>
						<br><a href="<?= esc_url( $cs_url ); ?>">View Case Study</a>
					</figcaption>
				</figure>
					<?php
				}
				$d += 50;
			}
			?>
		</div>
	<?php if ( ! $full_width ) : ?>
	</div>
	<?php endif; ?>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
( function () {
	function initGallery() {
		if ( typeof Fancybox === 'undefined' ) return;
		Fancybox.bind( '[data-fancybox="gallery"]', {
			Carousel: {
				formatCaption: function ( _carousel, slide ) {
					return slide.triggerEl && slide.triggerEl.nextElementSibling || '';
				},
			},
		} );
	}
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initGallery );
	} else {
		initGallery();
	}
}() );
</script>
		<?php
	},
	9999
);
