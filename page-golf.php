<?php
/**
 * Template Name: Golf (green highlight)
 *
 * Identical to page.php, but scopes the --col-highlight-400 custom
 * property to the Golf green so every block that reads it (buttons,
 * trust bar, etc.) renders green instead of orange without needing
 * a per-block theme field.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="theme-golf">
	<?php
	the_post();
	the_content();
	?>
</main>
<?php
get_footer();
