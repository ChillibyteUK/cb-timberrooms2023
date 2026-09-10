<?php
/**
 * CB Pushthrough Block Template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$variant        = get_field( 'variant' ) ? get_field( 'variant' ) : 'full';
$title          = get_field( 'title' );
$content        = get_field( 'content' );
$link           = get_field( 'link' );
$image          = get_field( 'image' );
$button_subtext = get_field( 'button_subtext' );
$stat_number    = get_field( 'stat_number' );
$stat_strap     = get_field( 'stat_strap' );

?>
<section class="cb-pushthrough cb-pushthrough--<?= esc_attr( $variant ); ?>">
	<div class="container-xl">
		<?php if ( 'full' === $variant ) : ?>
			<div class="cb-pushthrough__panel">
				<div class="row g-0 cb-pushthrough__inner">
					<div class="col-lg-7 my-auto cb-pushthrough__content">
						<?php
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						if ( $content ) {
							echo '<p>' . esc_html( $content ) . '</p>';
						}
						?>
					</div>
					<?php if ( $image ) : ?>
						<div class="col-lg-5 cb-pushthrough__image-container">
							<img class="cb-pushthrough__image" src="<?= esc_url( $image['url'] ); ?>" alt="<?= esc_attr( $image['alt'] ); ?>">
							<?php if ( $link ) : ?>
								<div class="cb-pushthrough__cta">
									<a href="<?= esc_url( $link['url'] ); ?>" class="btn btn-primary cb-pushthrough__button"<?= $link['target'] ? ' target="_blank"' : ''; ?>>
										<?= esc_html( $link['title'] ); ?> <span class="cb-pushthrough__arrow" aria-hidden="true">&rarr;</span>
									</a>
									<?php if ( $button_subtext ) : ?>
										<p class="cb-pushthrough__subtext"><?= esc_html( $button_subtext ); ?></p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php else : ?>
			<div class="cb-pushthrough__panel cb-pushthrough__slim-row">
				<div class="cb-pushthrough__content">
					<?php
					if ( $title ) {
						echo '<h2>' . esc_html( $title ) . '</h2>';
					}
					if ( $content ) {
						echo '<p>' . esc_html( $content ) . '</p>';
					}
					?>
				</div>
				<?php if ( $stat_number || $stat_strap ) : ?>
					<div class="cb-pushthrough__stat">
						<?php if ( $stat_number ) : ?>
							<span class="cb-pushthrough__stat-number"><?= esc_html( $stat_number ); ?></span>
						<?php endif; ?>
						<?php if ( $stat_strap ) : ?>
							<span class="cb-pushthrough__stat-strap"><?= esc_html( $stat_strap ); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( $link ) : ?>
					<a href="<?= esc_url( $link['url'] ); ?>" class="btn btn-primary cb-pushthrough__button"<?= $link['target'] ? ' target="_blank"' : ''; ?>>
						<?= esc_html( $link['title'] ); ?> <span class="cb-pushthrough__arrow" aria-hidden="true">&rarr;</span>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
