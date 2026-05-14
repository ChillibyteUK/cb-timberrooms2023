<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require_once CB_THEME_DIR . '/inc/cb-posttypes.php';
require_once CB_THEME_DIR . '/inc/cb-taxonomies.php';
require_once CB_THEME_DIR . '/inc/cb-utility.php';
require_once CB_THEME_DIR . '/inc/cb-blocks.php';
require_once CB_THEME_DIR . '/inc/cb-news.php';

// Remove unwanted SVG filter injection WP.
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

// Remove comment-reply.min.js from footer.
function remove_comment_reply_header_hook() {
    wp_deregister_script( 'comment-reply' );
}
add_action( 'init', 'remove_comment_reply_header_hook' );

add_action( 'admin_menu', 'remove_comments_menu' );
function remove_comments_menu() {
    remove_menu_page( 'edit-comments.php' );
}

add_filter( 'theme_page_templates', 'child_theme_remove_page_template' );
function child_theme_remove_page_template( $page_templates ) {
    // unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/fullwidthpage.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    unset( $page_templates['page-templates/blank.php'], $page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php'] );
    return $page_templates;
}
add_action( 'after_setup_theme', 'remove_understrap_post_formats', 11 );
function remove_understrap_post_formats() {
    remove_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
        array(
            'page_title' => 'Site-Wide Settings',
            'menu_title' => 'Site-Wide Settings',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
        )
    );
}

function widgets_init() {
    // register_sidebar(
    // array(
    // 'name'          => __('Footer Col 1', 'cb-timberrooms2023'),
    // 'id'            => 'footer-1',
    // 'description'   => __('Footer Col 1', 'cb-timberrooms2023'),
    // 'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    // 'after_widget'  => '</div>',
    // )
    // );

    register_nav_menus(
        array(
			'primary_nav' => __( 'Primary Nav', 'cb-timberrooms2023' ),
        )
    );

    register_nav_menus(
        array(
			'footer_menu1' => __( 'Footer Menu 1', 'cb-timberrooms2023' ),
        )
    );
    register_nav_menus(
        array(
			'footer_menu2' => __( 'Footer Menu 2', 'cb-timberrooms2023' ),
        )
    );

    unregister_sidebar( 'hero' );
    unregister_sidebar( 'herocanvas' );
    unregister_sidebar( 'statichero' );
    unregister_sidebar( 'left-sidebar' );
    unregister_sidebar( 'right-sidebar' );
    unregister_sidebar( 'footerfull' );
    unregister_nav_menu( 'primary' );
}
add_action( 'widgets_init', 'widgets_init', 11 );


// Custom Dashboard Widget
add_action( 'wp_dashboard_setup', 'register_cb_dashboard_widget' );
function register_cb_dashboard_widget() {
    wp_add_dashboard_widget(
        'cb_dashboard_widget',
        'Chillibyte',
        'cb_dashboard_widget_display'
    );
}

function cb_dashboard_widget_display() {
    ?>
<div style="display: flex; align-items: center; justify-content: space-around;">
    <img style="width: 50%;"
        src="<?= get_stylesheet_directory_uri() . '/img/cb-full.jpg'; ?>">
    <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
        href="mailto:hello@www.chillibyte.co.uk/">Contact</a>
</div>
<div>
    <p><strong>Thanks for choosing Chillibyte!</strong></p>
    <hr>
    <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
    <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
</div>
	<?php
}


add_filter(
    'wpseo_breadcrumb_links',
    function ( $links ) {
		global $post;
		if ( is_singular( 'post' ) ) {
			$t            = get_the_category( $post->ID );
			$breadcrumb[] = array(
				'url'  => '/guides/',
				'text' => 'Guides',
			);

			array_splice( $links, 1, -2, $breadcrumb );
		}
		return $links;
    }
);

// remove discussion metabox
function cc_gutenberg_register_files() {
    // script file
    wp_register_script(
        'cc-block-script',
        get_stylesheet_directory_uri() . '/js/block-script.js', // adjust the path to the JS file
        array( 'wp-blocks', 'wp-edit-post' )
    );
    // register block editor script
    register_block_type(
        'cc/ma-block-files',
        array(
			'editor_script' => 'cc-block-script',
        )
    );
}
add_action( 'init', 'cc_gutenberg_register_files' );

function understrap_all_excerpts_get_more_link( $post_excerpt ) {
    if ( is_admin() || ! get_the_ID() ) {
        return $post_excerpt;
    }
    return $post_excerpt;
}

// * Remove Yoast SEO breadcrumbs from Revelanssi's search results
add_filter( 'the_content', 'wpdocs_remove_shortcode_from_index' );
function wpdocs_remove_shortcode_from_index( $content ) {
    if ( is_search() ) {
        $content = strip_shortcodes( $content );
    }
    return $content;
}



// GF really is pants.
/**
 * Change submit from input to button
 *
 * Do not use example provided by Gravity Forms as it strips out the button attributes including onClick
 */
function wd_gf_update_submit_button( $button_input, $form ) {
    // save attribute string to $button_match[1]
    preg_match( '/<input([^\/>]*)(\s\/)*>/', $button_input, $button_match );

    // remove value attribute (since we aren't using an input)
    $button_atts = str_replace( "value='" . $form['button']['text'] . "' ", '', $button_match[1] );

    // create the button element with the button text inside the button element instead of set as the value
    return '<button ' . $button_atts . '><span>' . $form['button']['text'] . '</span></button>';
}
add_filter( 'gform_submit_button', 'wd_gf_update_submit_button', 10, 2 );


function cb_theme_enqueue() {
    $the_theme = wp_get_theme();
    // wp_enqueue_style('lightbox-stylesheet', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), $the_theme->get('Version'));
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox-plus-jquery.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js', array(), null, true);

	wp_enqueue_style( 'fancybox-style', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6/dist/fancybox/fancybox.css', array() );
	wp_enqueue_script( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6/dist/fancybox/fancybox.umd.js', array(), null, true );

	wp_enqueue_style( 'aos-style', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array() );
	wp_enqueue_script( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true );

	wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array() ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

	wp_enqueue_style( 'lenis-style', 'https://unpkg.com/lenis@1.3.11/dist/lenis.css', array() ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script( 'lenis', 'https://unpkg.com/lenis@1.3.11/dist/lenis.min.js', array(), null, true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
}
add_action( 'wp_enqueue_scripts', 'cb_theme_enqueue' );

add_action(
	'wp_footer',
	function () {
		?>
<script>
document.addEventListener('DOMContentLoaded', function () {
	if (typeof Lenis === 'undefined') return;
	const lenis = new Lenis({
		smooth: true,
		lerp: 0.1
	});
	function raf(time) {
		lenis.raf(time);
		requestAnimationFrame(raf);
	}
	requestAnimationFrame(raf);
});
</script>
		<?php
	},
	20
);


// black thumbnails - fix alpha channel
/**
 * Patch to prevent black PDF backgrounds.
 *
 * https://core.trac.wordpress.org/ticket/45982
 */
// require_once ABSPATH . 'wp-includes/class-wp-image-editor.php';
// require_once ABSPATH . 'wp-includes/class-wp-image-editor-imagick.php';

// // phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
// final class ExtendedWpImageEditorImagick extends WP_Image_Editor_Imagick
// {
// **
// * Add properties to the image produced by Ghostscript to prevent black PDF backgrounds.
// *
// * @return true|WP_error
// */
//     // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
// protected function pdf_load_source()
// {
// $loaded = parent::pdf_load_source();

// try {
// $this->image->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
// $this->image->setBackgroundColor('#ffffff');
// } catch (Exception $exception) {
// error_log($exception->getMessage());
// }

// return $loaded;
// }
// }

// /**
// * Filters the list of image editing library classes to prevent black PDF backgrounds.
// *
// * @param array $editors
// * @return array
// */
// add_filter('wp_image_editors', function (array $editors): array {
// array_unshift($editors, ExtendedWpImageEditorImagick::class);

// return $editors;
// });?>