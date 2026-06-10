<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$hero_img = wp_get_attachment_image_url( get_field( 'case_studies_archive_hero', 'options' ), 'full' );
?>
<!-- hero -->
<main id="main" class="caseStudies">
    <link rel="preload" as="image" href="<?= esc_url( $hero_img ); ?>">
    <header id="cs-archive-hero" class="hero mb-md-4">
        <div class="hero__bg">
            <img src="<?= esc_url( $hero_img ); ?>" class="hero__parallax-img" alt="">
        </div>
        <div class="hero__content">
            <div class="container-xl">
                <h1 data-aos="fade" class="text-center">View our Case Studies</h1>
                <div class="hero__cta-row" data-aos="fade" data-aos-delay="100">
                    <a href="/contact/" class="btn btn--accent">Get a free quote &rarr;</a>
                    <a href="/room-types/" class="btn btn--outline">View rooms</a>
                </div>
            </div>
        </div>
    </header>
<script>
( function () {
	var section = document.getElementById( 'cs-archive-hero' );
	if ( ! section ) return;

	var bg  = section.querySelector( '.hero__bg' );
	var img = section.querySelector( '.hero__parallax-img' );
	if ( ! bg || ! img ) return;

	var ticking = false;

	function update() {
		var rect    = bg.getBoundingClientRect();
		var winH    = window.innerHeight;

		if ( rect.bottom > 0 && rect.top < winH ) {
			var percent    = ( winH - rect.top ) / ( winH + rect.height );
			percent        = Math.max( 0, Math.min( 1, percent ) );
			var translateY = ( percent - 0.5 ) * 240;
			img.style.transform = 'translateY(' + translateY.toFixed( 1 ) + 'px)';
		}

		ticking = false;
	}

	function onScroll() {
		if ( ! ticking ) {
			window.requestAnimationFrame( update );
			ticking = true;
		}
	}

	window.addEventListener( 'scroll', onScroll, { passive: true } );
	window.addEventListener( 'resize', onScroll );
	onScroll();
}() );
</script>
    <div class="container-xl py-5">
        <div class="w-100 mb-4" id="csgrid">
            <?php
        $d = 0;
    while (have_posts()) {
        the_post();
        $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$img) {
            $img = get_stylesheet_directory_uri() . '/img/default.png';
        }
        $slug = acf_slugify(basename(get_the_permalink()));
        $catclass = '';
        ?>
            <div class="<?=$catclass?> caseStudy" data-aos="fade" data-aos-delay="<?=$d?>">
                <a class="caseStudy_card" href="<?=get_the_permalink()?>">
                    <div class="caseStudy_card__image">
                        <img src="<?=$img?>" alt="">
                    </div>
                    <div class="caseStudy_card__content">
                        <div class="article-title mb-2">
                            <?=get_the_title()?>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        $d += 50;
    }
?>
        </div>
        <?=numeric_posts_nav()?>
    </div>
    <?php
    include(get_stylesheet_directory() . '/page-templates/blocks/cb_cta.php');
    ?>
</main>
<?php
get_footer();
?>
