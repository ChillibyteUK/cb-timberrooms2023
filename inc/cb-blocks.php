<?php
/**
 * Register ACF Blocks
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register ACF Blocks
 */
function acf_blocks() {
	if ( function_exists( 'acf_register_block_type' ) ) {

		// INSERT NEW BLOCKS HERE.

		acf_register_block_type(
			array(
				'name'            => 'cb_pushthrough',
				'title'           => __( 'CB Pushthrough' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-pushthrough.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'cb_mini_manual_testimonials',
				'title'           => __( 'CB Mini Manual Testimonials' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-mini-manual-testimonials.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'cb_room_type_cards',
				'title'           => __( 'CB Room Type Cards' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-room-type-cards.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
          
				),
			)
		);

        acf_register_block_type(
            array(
				'name'            => 'cb_trust_bar',
				'title'           => __( 'CB Trust Bar' ),
				'description'     => __( 'Four key trust stats pulled from Site-Wide Settings.' ),
				'category'        => 'layout',
				'icon'            => 'awards',
				'render_template' => 'blocks/cb-trust-bar.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_hero',
				'title'           => __( 'CB Hero' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-hero.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_multi_video',
				'title'           => __( 'CB Multi Video' ),
				'description'     => __( 'A row of Vimeo thumbnails with a title and caption each, playing in a modal.' ),
				'category'        => 'layout',
				'icon'            => 'video-alt3',
				'render_template' => 'blocks/cb-multi-video.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_statement_banner',
				'title'           => __( 'CB Statement Banner' ),
				'description'     => __( 'Full-width parallax background image with a big centred heading and subtext.' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-statement-banner.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_icon_grid',
				'title'           => __( 'CB Icon Grid' ),
				'description'     => __( 'A grid of icon + label cards, e.g. a list of what\'s included.' ),
				'category'        => 'layout',
				'icon'            => 'grid-view',
				'render_template' => 'blocks/cb-icon-grid.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_lp_hero',
				'title'           => __( 'CB LP Hero' ),
				'description'     => __( 'Landing-page hero with a subtext line and configurable CTA buttons.' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-lp-hero.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_video',
				'title'           => __( 'CB Video' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-video.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_autoplay_video',
				'title'           => __( 'CB Autoplay Video' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-autoplay-video.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_cta',
				'title'           => __( 'CB CTA' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-cta.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_faq',
				'title'           => __( 'CB FAQ' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-faq.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_text_image',
				'title'           => __( 'CB Text Image' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-text-image.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_text_video',
				'title'           => __( 'CB Text Video' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-text-video.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_case_studies',
				'title'           => __( 'CB Case Studies' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-case-studies.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_related_case_studies--location',
				'title'           => __( 'CB Related Case Studies (Location)' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-related-case-studies--location.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_related_case_studies--room',
				'title'           => __( 'CB Related Case Studies (Room)' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-related-case-studies--room.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_contact',
				'title'           => __( 'CB Contact' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-contact.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_gallery',
				'title'           => __( 'CB Gallery' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-gallery.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_children',
				'title'           => __( 'CB Child Pages Nav' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-child-pages-nav.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_pricing',
				'title'           => __( 'CB Pricing' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-pricing.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
        acf_register_block_type(
            array(
				'name'            => 'cb_logo',
				'title'           => __( 'CB Logo' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/cb-logo.php',
				'mode'            => 'edit',
				'supports'        => array( 'mode' => false ),
            )
        );
    }
}
add_action( 'acf/init', 'acf_blocks' );

/**
 * Gutenburg core modifications
 *
 * @param array  $args Block type arguments.
 * @param string $name Block type name.
 * @return array Modified block type arguments.
 */
function core_image_block_type_args( $args, $name ) {
	if ( 'core/paragraph' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/list' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/heading' === $name ) {
		$args['render_callback'] = 'modify_core_heading';
    }
	return $args;
}
add_filter( 'register_block_type_args', 'core_image_block_type_args', 10, 3 );


/**
 * Modify core block to add container wrapper.
 *
 * @param array  $attributes Block attributes.
 * @param string $content Block content.
 * @return string Modified block content with container wrapper.
 */
function modify_core_add_container( $attributes, $content ) {
    ob_start();
    ?>
<div class="container-xl">
    <?= $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
	<?php
    $content = ob_get_clean();
    return $content;
}

/**
 * Modify core heading block to add container wrapper with ID.
 *
 * @param array  $attributes Block attributes.
 * @param string $content Block content.
 * @return string Modified block content with container wrapper.
 */
function modify_core_heading( $attributes, $content ) {
    ob_start();
    $id = strtolower( wp_strip_all_tags( $content ) );
    $id = sanitize_title( $id );
    ?>
<div class="container-xl" id="<?= esc_attr( $id ); ?>">
    <?= $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
	<?php
    $content = ob_get_clean();
    return $content;
}
