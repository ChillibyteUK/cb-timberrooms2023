<?php
/**
 * CB Multi Video Block Template.
 *
 * A row of Vimeo thumbnails, each with a title and caption underneath.
 * Clicking a thumbnail plays that video in a Fancybox modal rather than
 * inline — Fancybox is already loaded site-wide and auto-embeds a
 * vimeo.com URL, so no extra player markup is needed here.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

if ( ! have_rows( 'videos' ) ) {
	return;
}

$block_id = $block['id'] ?? wp_unique_id( 'cb-multi-video-' );
$group    = 'multi-video-' . $block_id;

$has_bg_color = ! empty( $block['backgroundColor'] ) || ! empty( $block['style']['color']['background'] );
$class        = 'multi-video' . ( $has_bg_color ? ' py-5' : '' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => $class ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container-xl">
		<div class="multi-video__grid">
			<?php
			$d = 0;
			while ( have_rows( 'videos' ) ) :
				the_row();
				$vimeo_id = get_sub_field( 'vimeo_id' );
				$title    = get_sub_field( 'title' );
				$caption  = get_sub_field( 'caption' );

				if ( ! $vimeo_id ) {
					continue;
				}

				$thumb = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_url' );
				?>
				<div class="multi-video__item" data-aos="fade-up" data-aos-delay="<?= esc_attr( $d ); ?>">
					<a class="multi-video__thumb" href="https://vimeo.com/<?= esc_attr( $vimeo_id ); ?>" data-fancybox="<?= esc_attr( $group ); ?>" style="background-image:url('<?= esc_url( $thumb ); ?>');">
						<span class="multi-video__play" aria-hidden="true"><i class="fa-solid fa-play"></i></span>
					</a>
					<?php if ( $title ) : ?>
						<h3 class="multi-video__title"><?= esc_html( $title ); ?></h3>
					<?php endif; ?>
					<?php if ( $caption ) : ?>
						<p class="multi-video__caption"><?= esc_html( $caption ); ?></p>
					<?php endif; ?>
				</div>
				<?php
				$d += 50;
			endwhile;
			?>
		</div>
	</div>
</section>
<?php
static $cb_multi_video_script_added = false;

if ( ! $cb_multi_video_script_added ) {
	$cb_multi_video_script_added = true;

	add_action(
		'wp_footer',
		function () {
			?>
<script>
( function () {
	function initMultiVideo() {
		if ( typeof Fancybox === 'undefined' ) return;
		Fancybox.bind( '[data-fancybox^="multi-video-"]' );
	}
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initMultiVideo );
	} else {
		initMultiVideo();
	}
}() );
</script>
			<?php
		},
		9999
	);
}
