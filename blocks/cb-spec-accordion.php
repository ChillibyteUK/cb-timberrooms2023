<?php
/**
 * CB Spec Accordion Block Template.
 *
 * A single collapsible panel (same Bootstrap collapse markup as CB FAQ)
 * that expands into a multi-column categorised specification list,
 * e.g. "Home golf studio example specification".
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$title      = get_field( 'title' );
$price_line = get_field( 'price_line' );

if ( ! $title || ! have_rows( 'categories' ) ) {
	return;
}

// Filter out empty rows up front so we know how many categories will
// actually render, which lets the final block fill whatever grid space
// is left over in the last row.
$categories = array_values(
	array_filter(
		get_field( 'categories' ),
		function ( $row ) {
			return ! empty( $row['category_title'] ) || ! empty( $row['items'] );
		}
	)
);

$final_text = get_field( 'final_block_text' );
$final_logo = get_field( 'final_block_logo' );
$show_final = $final_text || $final_logo;

$remainder  = count( $categories ) % 3;
$final_span = $remainder === 0 ? 3 : 3 - $remainder;

$id = 'spec_' . random_str( 5 );

$has_bg_color = ! empty( $block['backgroundColor'] ) || ! empty( $block['style']['color']['background'] );
$class        = 'spec-accordion' . ( $has_bg_color ? ' py-5' : '' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => $class ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container-xl">
		<div class="spec-accordion__panel">
			<div class="accordion-head accordion-collapse collapsed"
				data-bs-toggle="collapse"
				id="heading_<?= esc_attr( $id ); ?>"
				data-bs-target="#c<?= esc_attr( $id ); ?>"
				role="button"
				aria-expanded="false"
				aria-controls="c<?= esc_attr( $id ); ?>">
				<h2><?= esc_html( $title ); ?></h2>
			</div>
			<div class="collapse"
				id="c<?= esc_attr( $id ); ?>"
				aria-labelledby="heading_<?= esc_attr( $id ); ?>">
				<div class="spec-accordion__body">
					<div class="spec-accordion__grid">
						<?php foreach ( $categories as $index => $category ) : ?>
							<?php
							// When the final block is present it follows the last category in the
							// DOM, so that category is no longer :last-child -- add a class so the
							// row-divider border-bottom still ends where the grid visually ends.
							$is_last_category = $show_final && $index === array_key_last( $categories );
							?>
							<div class="spec-accordion__category<?= $is_last_category ? ' spec-accordion__category--adjoins-final' : ''; ?>">
								<?php if ( $category['category_title'] ) : ?>
									<h4 class="has-primary-color"><?= esc_html( $category['category_title'] ); ?></h4>
								<?php endif; ?>
								<?php if ( $category['items'] ) : ?>
									<ul><?= wp_kses_post( cb_list( $category['items'] ) ); ?></ul>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
						<?php if ( $show_final ) : ?>
							<div class="spec-accordion__final" style="grid-column: span <?= esc_attr( $final_span ); ?>;">
								<?php if ( $final_logo ) : ?>
									<img class="spec-accordion__final-logo" src="<?= esc_url( $final_logo['url'] ); ?>" alt="<?= esc_attr( $final_logo['alt'] ); ?>">
								<?php endif; ?>
								<?php if ( $final_text ) : ?>
									<p class="spec-accordion__final-text"><?= esc_html( $final_text ); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( $price_line ) : ?>
						<div class="spec-accordion__price"><span><?= esc_html( $price_line ); ?></span></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
