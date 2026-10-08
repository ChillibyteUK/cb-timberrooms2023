<?php
/**
 * The template for displaying all pages
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<?php
	the_post();
	the_content();

	if ( is_front_page() ) {
		// pushthrough block — rendered with variables so it can be called from the template.
		$pushthrough = array(
			'variant' => 'slim',
			'title' => 'Not sure what your garden room would cost?',
			'content' => 'Configure the size, cladding and finish online and get an indicative price in minutes.',
			'link' => array(
				'url' => site_url( '/configurator/' ),
				'title' => 'Try the configurator',
				'target' => '',
			),
			'stat_number' => '2,500+',
			'stat_strap' => 'Rooms built',
		);

		// Include the block template which accepts a $pushthrough array.
		include locate_template( 'blocks/cb-pushthrough.php' );
	}
	?>
</main>
<?php
get_footer();