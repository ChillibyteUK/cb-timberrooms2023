<?php
/**
 * CB Text & Video Block Template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$colour     = get_field( 'theme' );
$background = '';

switch ( $colour ) {
    case 'Dark':
        $background = 'has-dark-background-color text-white';
        break;
    case 'Mid':
        $background = 'has-grey-background-color';
        break;
}

$breakout = '';
if ( get_field( 'breakout' )[0] ?? null && 'Yes' === get_field( 'breakout' )[0] ) {
    $breakout   = $background;
    $background = '';
}

$split_text  = 'col-md-6';
$split_image = 'col-md-6';


if ( '6040' === get_field( 'split' ) ) {
    $split_text  = 'col-md-8';
    $split_image = 'col-md-4';
}
if ( '7030' === get_field( 'split' ) ) {
    $split_text  = 'col-md-10';
    $split_image = 'col-md-2';
}

$order_text  = 'order-2 order-md-1';
$order_image = 'order-1 order-md-2';
$fade_text   = 'fade-right';
$fade_image  = 'fade-left';

if ( 'image-text' === get_field( 'order' ) ) {
    $order_text  = 'order-2 order-md-2';
    $order_image = 'order-1 order-md-1';
    $fade_text   = 'fade-left';
    $fade_image  = 'fade-right';
}

$bg = get_vimeo_data_from_id( get_field( 'vimeo_id' ), 'thumbnail_url' );

?>
<section class="text_image <?= esc_attr( $breakout ); ?>">
    <div class="container-xl <?= esc_attr( $background ); ?> py-5">
        <div class="d-lg-none" data-aos="fade">
            <h2><?= esc_html( get_field( 'title' ) ); ?></h2>
        </div>
        <div class="row align-items-center g-4">
            <div
                class="<?= esc_attr( $split_text ); ?> <?= esc_attr( $order_text ); ?>">
                <h2 class="d-none d-lg-block">
                    <?= esc_html( get_field( 'title' ) ); ?>
                </h2>
                <div><?= esc_html( get_field( 'content' ) ); ?></div>
                <?php
                if ( get_field( 'cta' ) ) {
                    $cta_link = get_field( 'cta' );
                    ?>
                <a href="<?= esc_url( $cta_link['url'] ); ?>"
                    class="btn btn--accent"><?= esc_html( $cta_link['title'] ); ?></a>
					<?php
                }
				?>
            </div>
            <div
                class="<?= esc_attr( $split_image ); ?> <?= esc_attr( $order_image ); ?>">
                <div class="lite-vimeo">
                    <lite-vimeo
                        videoid="<?= esc_attr( get_field( 'vimeo_id' ) ); ?>"
                        style="background-image:url('<?= esc_url( $bg ); ?>');"></lite-vimeo>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
add_action(
    'wp_footer',
    function () {
		?>
<script type=module src="https://cdn.jsdelivr.net/npm/@slightlyoff/lite-vimeo@0.1.1/lite-vimeo.js"></script>
		<?php
	}
);