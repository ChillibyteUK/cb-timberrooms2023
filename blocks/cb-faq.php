<?php
/**
 * CB FAQ Block Template.
 *
 * Multiple instances of this block on the same page are supported. Each
 * instance registers its Q&A pairs via cb_faq_add_schema_items(); a single
 * wp_footer hook outputs one FAQPage JSON-LD block covering all instances,
 * satisfying Google's one-FAQPage-per-page requirement.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

// cb_faq_add_schema_items() is defined once (function_exists guard prevents
// fatal errors on re-include). Static variables inside it persist across
// all calls for the lifetime of the request, unlike file-scope statics.
if ( ! function_exists( 'cb_faq_add_schema_items' ) ) {
	/**
	 * Collect FAQ items and output FAQPage schema.
	 *
	 * @param array $items Array of FAQ items with 'question' and 'answer' keys.
	 * @return void
	 */
	function cb_faq_add_schema_items( array $items ) {
		static $all_items = array();
		static $hooked    = false;

		foreach ( $items as $item ) {
			$all_items[] = $item;
		}

		if ( ! $hooked ) {
			$hooked = true;
			add_action(
				'wp_footer',
				function () use ( &$all_items ) {
					if ( empty( $all_items ) ) {
						return;
					}

					$entities = array_map(
						function ( $item ) {
							return array(
								'@type'          => 'Question',
								'name'           => $item['question'],
								'acceptedAnswer' => array(
									'@type' => 'Answer',
									'text'  => $item['answer'],
								),
							);
						},
						$all_items
					);

					$schema = array(
						'@context'   => 'https://schema.org',
						'@type'      => 'FAQPage',
						'mainEntity' => $entities,
					);

					echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
				}
			);
		}
	}
}

// Collect this block's Q&A pairs into an array so we can use the data for
// both the JSON-LD schema and the HTML accordion without looping ACF rows twice.
$block_faq_items = array();
while ( have_rows( 'faqs' ) ) {
	the_row();
	$block_faq_items[] = array(
		'question' => wp_strip_all_tags( get_sub_field( 'question' ) ),
		'answer'   => wp_strip_all_tags( get_sub_field( 'answer' ) ),
	);
}

cb_faq_add_schema_items( $block_faq_items );

$accordion = random_str( 5 );
?>
<!-- faq_block -->
<section class="faq_block">
	<div class="container-xl my-4">
		<?php if ( get_field( 'faq_title' ) ) : ?>
			<h2 class="mb-4 text-center"><?= esc_html( get_field( 'faq_title' ) ); ?></h2>
		<?php endif; ?>

		<?php if ( get_field( 'faq_intro' ) ) : ?>
			<div class="text-center mw-md-75 mb-4"><?= esc_html( get_field( 'faq_intro' ) ); ?></div>
		<?php endif; ?>

		<div class="faq_block__inner">
			<div id="accordion<?= esc_attr( $accordion ); ?>" class="accordion accordion-flush">
				<?php
				$d = 0;
				foreach ( $block_faq_items as $counter => $faq ) {
					$ac = $accordion . '_' . $counter;
					?>
					<div class="accordion-item" data-aos="fade-up" data-aos-anchor=".faq_block__inner" data-aos-delay="<?= esc_attr( $d ); ?>">
						<div class="accordion-head accordion-collapse collapsed"
							data-bs-toggle="collapse"
							id="heading_<?= esc_attr( $ac ); ?>"
							data-bs-target="#c<?= esc_attr( $ac ); ?>"
							role="button"
							aria-expanded="false"
							aria-controls="c<?= esc_attr( $ac ); ?>">
							<div class="pb-1"><?= esc_html( $faq['question'] ); ?></div>
						</div>
						<div class="collapse"
							id="c<?= esc_attr( $ac ); ?>"
							aria-labelledby="heading_<?= esc_attr( $ac ); ?>"
							data-bs-parent="#accordion<?= esc_attr( $accordion ); ?>">
							<div class="faq__answer pb-4">
								<p><?= esc_html( $faq['answer'] ); ?></p>
							</div>
						</div>
					</div>
					<?php
					$d += 50;
				}
				?>
			</div>
		</div>
	</div>
</section>
