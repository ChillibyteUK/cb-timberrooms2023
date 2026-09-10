<?php
/**
 * CB Partners Block Template.
 *
 * A centred eyebrow with a row of partner logos below it, all shown at
 * the same height regardless of their original aspect ratio. Logos are
 * uploaded per instance via the Logos repeater, not hardcoded assets.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$eyebrow = get_field( 'eyebrow' );

if ( ! have_rows( 'logos' ) ) {
	return;
}
?>
<section class="partners py-5">
	<div class="container-xl text-center">
		<?php if ( $eyebrow ) : ?>
			<div class="partners__eyebrow has-primary-color"><?= esc_html( $eyebrow ); ?></div>
		<?php endif; ?>
		<div class="partners__grid">
			<?php
			while ( have_rows( 'logos' ) ) :
				the_row();
				$logo = get_sub_field( 'logo' );
				if ( ! $logo ) {
					continue;
				}
				?>
				<img class="partners__logo" src="<?= esc_url( $logo['url'] ); ?>" alt="<?= esc_attr( $logo['alt'] ); ?>">
				<?php
			endwhile;
			?>
		</div>
	</div>
</section>
