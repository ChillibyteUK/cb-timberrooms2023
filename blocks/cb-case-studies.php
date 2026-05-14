<?php
/**
 * CB Case Studies Block Template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="cs_slider swiper pb-4" aria-label="<?php esc_attr_e( 'Case Studies', 'cb-timberrooms2023' ); ?>">
    <div class="swiper-wrapper">
        <?php
        $q = new WP_Query(
            array(
                'post_type'      => 'case-studies',
                'posts_per_page' => 12,
            )
        );
        while ( $q->have_posts() ) {
            $q->the_post();
            $img  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            $town = '';
            if ( get_the_terms( get_the_ID(), 'towns' ) ) {
                $town = get_the_terms( get_the_ID(), 'towns' )[0]->name;
            }
            $county = '';
            if ( get_the_terms( get_the_ID(), 'counties' ) ) {
                $county = get_the_terms( get_the_ID(), 'counties' )[0]->name;
            }
            ?>
        <div class="swiper-slide cs_slider__slide">
            <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>">
                <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>">
                <div class="overlay">
                    <h3><?php echo esc_html( get_the_title( get_the_ID() ) ); ?></h3>
                    <div class="text-center">
                        <?php
                        if ( '' !== $town ) {
                            echo esc_html( $town );
                        }
                        if ( $town && $county ) {
                            echo ' - ';
                        }
                        if ( '' !== $county ) {
                            echo esc_html( $county );
                        }
                        ?>
                    </div>
                </div>
            </a>
        </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</section>
<?php
add_action(
    'wp_footer',
    function () {
        ?>
<script>
( function () {
    function initCaseStudiesSlider() {
        var el = document.querySelector( '.cs_slider' );
        if ( ! el || typeof Swiper === 'undefined' ) {
            return;
        }

        new Swiper( el, {
            loop            : true,
            slidesPerView   : 4,
            slidesPerGroup  : 1,
            spaceBetween    : 0,
            speed           : 600,
            autoplay        : {
                delay               : 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter   : true,
            },
            breakpoints: {
                0  : { slidesPerView: 1 },
                480: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 },
            },
        } );
    }

    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', initCaseStudiesSlider );
    } else {
        initCaseStudiesSlider();
    }
}() );
</script>
        <?php
    }
);
