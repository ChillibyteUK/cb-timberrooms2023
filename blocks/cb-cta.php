<?php
/**
 * Call to Action block template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

if ( null !== get_field( 'theme' ) ) {
    if ( 'Pods' === get_field( 'theme' ) ) {
        $logo = 'timberrooms-logo-prefab--wo.svg';
    } elseif ( 'Golf' === get_field( 'theme' ) ) {
        $logo = 'timberrooms-logo-golf--wo.svg';
    } else {
        $logo = 'timberrooms-logo--wo.svg';
    }
} else {
    $logo = 'timberrooms-logo--wo.svg';
}

$theme = '';
?>
<section class="cta">
    <div class="container-xl text-center" data-aos="fade">
        <img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/' . $logo ); ?>" alt="">
        <h3>Are you considering a Garden Room?</h3>
        <a href="/contact/" class="h5 <?= esc_attr( $theme ); ?>">Book a Free Site Survey</a>
        <div class="cta__grid">
            <div class="line"></div>
            <div class="h5">Call Now: <a href="tel:<?= esc_attr( parse_phone( get_field( 'contact_phone', 'options' ) ) ); ?>"><?= esc_html( get_field( 'contact_phone', 'options' ) ); ?></a></div>
            <div class="line"></div>
        </div>
    </div>
</section>