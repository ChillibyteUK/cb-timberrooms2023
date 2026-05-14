<?php
/**
 * CB Text Image Block Template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$colour     = get_field( 'theme' );
$background = 'has-dark-background-color text-white';

switch ( $colour ) {
    case 'Dark':
        $background = 'has-dark-background-color text-white';
        break;
    case 'Mid':
        $background = 'has-grey-background-color text-dark';
        break;
}

$theme = get_field( 'heading_theme' );

switch ( $theme ) {
    case 'Pods':
        $theme = 'has-prefab-color';
        break;
    case 'Golf':
        $theme = 'has-golf-color';
        break;
    default:
        $theme = 'has-primary-color';
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
$fade_text   = 'fade-right';
$order_image = 'order-1 order-md-2';
$fade_image  = 'fade-left';

if ( 'image-text' === get_field( 'order' ) ) {
    $order_text  = 'order-2 order-md-2';
    $order_image = 'order-1 order-md-1';
    $fade_text   = 'fade-left';
    $fade_image  = 'fade-right';
}
?>
<section class="text_image <?= esc_attr( $breakout ); ?>">
    <div class="container-xl <?= esc_attr( $background ); ?> py-5">
        <div class="d-lg-none <?= esc_attr( $theme ); ?>" data-aos="fade"><h2><?= esc_html( get_field( 'title' ) ); ?></h2></div>
        <div class="row align-items-center g-4">
            <div class="<?= esc_attr( $split_text ); ?> <?= esc_attr( $order_text ); ?>" data-aos="<?= esc_attr( $fade_text ); ?>">
                <h2 class="d-none d-lg-block <?= esc_attr( $theme ); ?>"><?= esc_html( get_field( 'title' ) ); ?></h2>
                <div><?= wp_kses_post( get_field( 'content' ) ); ?></div>
                <?php
                if ( get_field( 'cta' ) ) {
                    $cta_link = get_field( 'cta' );
                    ?>
                    <a href="<?= esc_url( $cta_link['url'] ); ?>" class="btn btn--accent"><?= esc_url( $cta_link['title'] ); ?></a>
                    <?php
                }
                ?>
            </div>
            <div class="<?= esc_attr( $split_image ); ?> <?= esc_attr( $order_image ); ?> text-center" data-aos="<?= esc_attr( $fade_image ); ?>">
                <?= wp_get_attachment_image( get_field( 'image' ), 'large', null, array( 'class' => 'text_image__image' ) ); ?>
            </div>
        </div>
    </div>
</section>