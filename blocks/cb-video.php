<?php
/**
 * CB Video Block Template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$vimeo_id = get_field( 'vimeo_id' );
$bg       = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_url' );
$wide     = 'Yes' === ( get_field( 'wide' )[0] ?? null );

$video_width  = get_vimeo_data_from_id( $vimeo_id, 'width' );
$video_height = get_vimeo_data_from_id( $vimeo_id, 'height' );
$ratio_style  = ( $video_width && $video_height )
	? sprintf( 'aspect-ratio:%d/%d;', $video_width, $video_height )
	: '';
?>
<section class="video<?= $wide ? ' video--wide' : ''; ?>">
	<?php if ( $wide ) : ?>
	<div class="container-xl">
	<?php endif; ?>
		<div class="lite-vimeo" style="<?= esc_attr( $ratio_style ); ?>" data-aos="fade">
			<iframe src="https://player.vimeo.com/video/<?= esc_attr( $vimeo_id ); ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;dnt=1" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Timber Rooms"></iframe>
		</div>
	<?php if ( $wide ) : ?>
	</div>
	<?php endif; ?>
</section>
<script src="https://player.vimeo.com/api/player.js"></script> <?php //phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript -- This is a block template, not a theme template. ?>