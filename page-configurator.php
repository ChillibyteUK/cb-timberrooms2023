<?php
/**
 * Template Name: Configurator (no top nav)
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header('configurator');
?>
<main id="main">
    <?php
    the_post();
    the_content();
    ?>
</main>
<?php
get_footer();
