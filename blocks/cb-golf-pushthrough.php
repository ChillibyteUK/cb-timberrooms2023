<?php
/**
 * Block template for CB Golf Pushthrough.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$input = $args;

$variant        = get_field( 'variant' ) ? get_field( 'variant' ) : 'full';
$title          = get_field( 'title' );
$content        = get_field( 'content' );
$link           = get_field( 'link' );
$image          = get_field( 'image' );
$button_subtext = get_field( 'button_subtext' );
$stat_number    = get_field( 'stat_number' );
$stat_strap     = get_field( 'stat_strap' );

?>
<section class="cb-golf-pushthrough">
	<div class="container-xl">
		<div class="cb-golf-pushthrough__panel">
			<div class="row g-0 cb-golf-pushthrough__inner">
				<div class="col-lg-7 my-auto cb-golf-pushthrough__content">
					<?php
					if ( $title ) {
						echo '<h2>' . esc_html( $title ) . '</h2>';
					}
					if ( $content ) {
						echo '<p>' . esc_html( $content ) . '</p>';
					}
					?>
				</div>
				<?php
				if ( $image ) {
					?>
					<div class="col-lg-5 cb-golf-pushthrough__image-container">
						<img class="cb-golf-pushthrough__image" src="<?= esc_url( $image['url'] ); ?>" alt="<?= esc_attr( $image['alt'] ); ?>">
						<?php
						if ( $link ) {
							?>
						<div class="cb-golf-pushthrough__cta">
							<a href="<?= esc_url( $link['url'] ); ?>" class="btn btn-golf cb-golf-pushthrough__button"<?= ! empty( $link['target'] ) ? ' target="_blank"' : ''; ?>>
								<?= esc_html( $link['title'] ); ?> <span class="cb-golf-pushthrough__arrow" aria-hidden="true">&rarr;</span>
							</a>
							<?php
							if ( $button_subtext ) {
								?>
								<p class="cb-golf-pushthrough__subtext"><?= esc_html( $button_subtext ); ?></p>
								<?php
							}
							?>
						</div>
							<?php
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
