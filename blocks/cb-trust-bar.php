<?php
/**
 * CB Trust Bar Block Template.
 *
 * Displays four key trust stats pulled from Site-Wide Settings (ACF options).
 * Add the block immediately below the hero on any page that needs it.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$stats = array(
	array(
		'value' => get_field( 'trust_stat_rooms', 'options' ),
		'label' => 'rooms built',
	),
	array(
		'value' => get_field( 'trust_stat_rating', 'options' ),
		'label' => 'Google',
	),
	array(
		'value' => get_field( 'trust_stat_guarantee', 'options' ),
		'label' => 'guarantee',
	),
	array(
		'value' => get_field( 'trust_stat_established', 'options' ),
		'label' => 'est.',
	),
);

// Only render if at least one stat has been populated.
$has_stats = array_filter( $stats, fn( $s ) => ! empty( $s['value'] ) );
if ( empty( $has_stats ) ) {
	return;
}
?>
<section class="trust-bar" aria-label="<?php esc_attr_e( 'Key facts', 'cb-timberrooms2023' ); ?>">
	<div class="container-xl">
		<ul class="trust-bar__list" role="list">
			<?php foreach ( $stats as $stat ) : ?>
				<?php if ( empty( $stat['value'] ) ) : continue; endif; ?>
				<li class="trust-bar__item">
					<strong class="trust-bar__value"><?= esc_html( $stat['value'] ); ?></strong>
					<span class="trust-bar__label"><?= esc_html( $stat['label'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
