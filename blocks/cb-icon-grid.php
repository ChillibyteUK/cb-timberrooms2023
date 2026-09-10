<?php
/**
 * CB Icon Grid Block Template.
 *
 * A grid of icon + label cards, e.g. a list of what's included. Colour
 * follows the shared --col-highlight-400 variable, so it goes Golf green
 * automatically on the page-golf.php template — no per-block theme field
 * needed.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$eyebrow = get_field( 'eyebrow' );

if ( ! have_rows( 'items' ) ) {
	return;
}
?>
<section class="icon-grid has-dark-background-color py-5">
	<div class="container-xl">
		<?php if ( $eyebrow ) : ?>
			<div class="icon-grid__eyebrow has-primary-color text-center"><?= esc_html( $eyebrow ); ?></div>
		<?php endif; ?>
		<div class="icon-grid__grid">
			<?php
			$d = 0;
			while ( have_rows( 'items' ) ) :
				the_row();
				$icon  = get_sub_field( 'icon' );
				$label = get_sub_field( 'label' );
				if ( ! $icon && ! $label ) {
					continue;
				}
				?>
				<div class="icon-grid__item" data-aos="fade-up" data-aos-delay="<?= esc_attr( $d ); ?>">
					<?php if ( $icon ) : ?>
						<span class="icon-grid__icon" style="--icon-url: url('<?= esc_url( $icon['url'] ); ?>');" role="img" aria-hidden="true"></span>
					<?php endif; ?>
					<?php if ( $label ) : ?>
						<span class="icon-grid__label"><?= esc_html( $label ); ?></span>
					<?php endif; ?>
				</div>
				<?php
				$d += 50;
			endwhile;
			?>
		</div>
	</div>
</section>
