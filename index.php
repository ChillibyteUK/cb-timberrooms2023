<?php
/**
 * The template for displaying the blog index page.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$page_for_posts = get_option( 'page_for_posts' );
$bg             = get_the_post_thumbnail_url( $page_for_posts, 'full' );

get_header();
?>
<main id="main">
<?php
$hero_id = wp_unique_id('cb-hero-');
?>
<link rel="preload" as="image" href="<?= esc_url($bg); ?>">
<header id="<?= esc_attr($hero_id); ?>" class="hero hero--blog mb-md-4">
    <div class="hero__bg">
        <img src="<?= esc_url($bg); ?>" class="hero__parallax-img" alt="">
    </div>
    <div class="hero__content">
        <div class="container-xl">
            <h1 data-aos="fade"><?= get_the_title($page_for_posts) ?></h1>
			<?php
			if ( get_the_content( null, false, $page_for_posts ) ) {
				echo '<div data-aos="fade">' . wp_kses_post( get_the_content( null, false, $page_for_posts ) ) . '</div>';
			}
			?>
        </div>
    </div>
</header>
<script>
(function() {
    var hero = document.getElementById(<?= wp_json_encode($hero_id); ?>);
    if (!hero) return;
    var bg = hero.querySelector('.hero__bg');
    var img = hero.querySelector('.hero__parallax-img');
    if (!bg || !img) return;
    var ticking = false;
    function update() {
        var rect = bg.getBoundingClientRect();
        var winH = window.innerHeight;
        if (rect.bottom > 0 && rect.top < winH) {
            var percent = (winH - rect.top) / (winH + rect.height);
            percent = Math.max(0, Math.min(1, percent));
            var translateY = (percent - 0.5) * 240;
            img.style.transform = 'translateY(' + translateY.toFixed(1) + 'px)';
        }
        ticking = false;
    }
    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    onScroll();
})();
</script>

    <div class="container-xl pb-5">
        <div class="row gap-4" id="grid">
            <?php
            while ( have_posts() ) {
                the_post();
                $img            = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                $cats           = get_the_category();
                $category_names = wp_list_pluck( $cats, 'name' );
                $flashcat       = ! empty( $cats ) ? sanitize_title( $cats[0]->name ) : 'uncategorised';
                $catclass       = ! empty( $cats ) ? implode( ' ', array_map( 'sanitize_title', $category_names ) ) : '';
                $category_label = ! empty( $category_names ) ? implode( ', ', $category_names ) : '';
                $the_date       = get_the_date( 'jS F, Y' );
                ?>
            <div class="grid_item col-lg-4 col-md-6 p-0 <?= esc_attr( $catclass ); ?>">
                <a href="<?= esc_url( get_the_permalink( get_the_ID() ) ); ?>">
                    <div class="card card--<?= esc_attr( $flashcat ); ?>">
                        <div class="news__image_container">
                            <?php if ( ! in_array( $flashcat, array( 'uncategorised', 'uncategorized' ), true ) ) { ?>
                            <div class="news__flash news__flash--<?= esc_attr( $flashcat ); ?>"><?= esc_html( $category_label ); ?></div>
                            <?php } ?>
                            <div class="news__image-wrap">
                                <?php if ( $img ) { ?>
                                <img class="news__image" src="<?= esc_url( $img ); ?>" alt="" loading="lazy">
                                <?php } else { ?>
                                <div class="news__image news__image--placeholder"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="news__inner">
                            <h3 class="news__title mb-0"><?= wp_kses_post( get_the_title() ); ?></h3>
                            <div class="news__date"><?= esc_html( $the_date ); ?></div>
                            <div class="news__content">
                                <div class="news__content__overlay"></div>
                                <?= wp_trim_words( get_the_content( get_the_ID() ), 20 ); ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
                <?php
            }
            ?>
        </div>
        <div class="mt-5">
        <?php
        numeric_posts_nav();
        ?>
        </div>
    </div>
</main>
<?php
get_footer();
