<?php
/**
 * CB Video Block Template.
 *
 * Autoplay on: the standard Vimeo iframe player, muted and autoplaying
 * immediately (dnt=1, no tracking cookies).
 *
 * Autoplay off: the lite-vimeo web component (same as CB Text & Video) —
 * a poster image with a play button that only loads the real player on
 * click.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$vimeo_id = get_field( 'vimeo_id' );
$wide     = 'Yes' === ( get_field( 'wide' )[0] ?? null );
$autoplay = 'Yes' === ( get_field( 'autoplay' )[0] ?? null );

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
		<?php if ( $autoplay ) : ?>
			<div class="lite-vimeo" style="<?= esc_attr( $ratio_style ); ?>" data-aos="fade">
				<iframe src="https://player.vimeo.com/video/<?= esc_attr( $vimeo_id ); ?>?autoplay=1&amp;muted=1&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;dnt=1" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Timber Rooms"></iframe>
			</div>
		<?php else : ?>
			<?php $bg = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_url' ); ?>
			<div class="lite-vimeo" style="<?= esc_attr( $ratio_style ); ?>" data-aos="fade">
				<lite-vimeo videoid="<?= esc_attr( $vimeo_id ); ?>" style="background-image:url('<?= esc_url( $bg ); ?>');"></lite-vimeo>
			</div>
		<?php endif; ?>
	<?php if ( $wide ) : ?>
	</div>
	<?php endif; ?>
</section>
<?php
if ( ! $autoplay ) :
	static $cb_video_lite_script_added = false;

	if ( ! $cb_video_lite_script_added ) {
		$cb_video_lite_script_added = true;

		add_action(
			'wp_footer',
			function () {
				?>
<script type=module src="https://cdn.jsdelivr.net/npm/@slightlyoff/lite-vimeo@0.1.1/lite-vimeo.js"></script> <?php //phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript -- This is a block template, not a theme template. ?>
<script>
( function () {
	// lite-vimeo's play button lives inside a shadow root, so it can't be
	// reached with a normal stylesheet rule — inject one directly into
	// each instance's shadow root instead. CSS custom properties still
	// inherit through the shadow boundary, so var(--col-highlight-400)
	// here correctly resolves to Golf green under .theme-golf.
	function themeLiteVimeoButtons() {
		document.querySelectorAll( 'lite-vimeo' ).forEach( function ( el ) {
			if ( ! el.shadowRoot || el.dataset.themedPlaybtn ) return;
			el.dataset.themedPlaybtn = '1';

			var style = document.createElement( 'style' );
			style.textContent = '#frame:hover .lvo-playbtn { background-color: var(--col-highlight-400); }';
			el.shadowRoot.appendChild( style );
		} );
	}

	if ( typeof customElements !== 'undefined' && customElements.whenDefined ) {
		customElements.whenDefined( 'lite-vimeo' ).then( themeLiteVimeoButtons );
	} else {
		themeLiteVimeoButtons();
	}
}() );
</script>
				<?php
			}
		);
	}
endif;
