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
						<?php
						while ( have_rows( 'categories' ) ) :
							the_row();
							$category_title = get_sub_field( 'category_title' );
							$items          = get_sub_field( 'items' );
							if ( ! $category_title && ! $items ) {
								continue;
							}
							?>
							<div class="spec-accordion__category">
								<?php if ( $category_title ) : ?>
									<h4 class="has-primary-color"><?= esc_html( $category_title ); ?></h4>
								<?php endif; ?>
								<?php if ( $items ) : ?>
									<ul><?= wp_kses_post( cb_list( $items ) ); ?></ul>
								<?php endif; ?>
							</div>
							<?php
						endwhile;
						?>
					</div>
					<?php if ( $price_line ) : ?>
						<div class="spec-accordion__price"><span><?= esc_html( $price_line ); ?></span></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
