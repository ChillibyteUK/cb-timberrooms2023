<?php
/**
 * Pricing block template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$theme = 'Pods' === get_field( 'theme' ) ? 'has-prefab-color' : 'has-primary-color';
?>
<section class="pricing has-dark-background-color py-5">
    <div class="container-xl">
        <div class="pricing__grid">
        <?php
        $d = 0;
        while ( have_rows( 'cards' ) ) {
            the_row();
            ?>
        <div class="pricing__card" data-aos="fade-up" data-aos-delay="<?= esc_attr( $d ); ?>">
            <?php
            if ( get_sub_field( 'model_name' ) ) {
                ?>
            <h3 class="h4 <?= esc_attr( $theme ); ?>"><?= esc_html( get_sub_field( 'model_name' ) ); ?></h3>
                <?php
            }
            ?>
            <img class="pricing__image mb-3" src="<?= esc_url( wp_get_attachment_image_url( get_sub_field( 'image' ), 'large' ) ); ?>" alt="">
            <div class="pricing__size"><?= esc_html( get_sub_field( 'size' ) ); ?></div>
            <div class="pricing__price mb-3">From £<?= number_format( get_sub_field( 'price' ), 2 ); ?> inc VAT</div>
            <div class="pricing__features">
                <ul>
                    <?= wp_kses_post( cb_list( get_sub_field( 'features' ) ) ); ?>
                </ul>
            </div>
            <?php
            if ( get_sub_field( 'more_info' ) ) {
                $l = get_sub_field( 'more_info' );
                ?>
            <a href="<?= esc_url( $l['url'] ); ?>" class="pricing__link <?= esc_attr( $theme ); ?>">Find out more</a>
                <?php
            }
            ?>
        </div>
            <?php
            $d += 50;
        }
        ?>
        </div>
    </div>
</section>