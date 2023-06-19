<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$img = wp_get_attachment_image_url(get_field('case_studies_archive_hero','options'),'full');
?>
<!-- hero -->
<main id="main" class="caseStudies">
    <link rel="preload" as="image" href="<?=$img?>">
    <header class="hero" style="background-image:url(<?=$img?>)">
        <h1>View our Case Studies</h1>
    </header>
    <div class="container-xl py-5">
        <div class="w-100 mb-4" id="csgrid">
            <?php
    while (have_posts()) {
        the_post();
        $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$img) {
            $img = get_stylesheet_directory_uri() . '/img/default.png';
        }
        $slug = acf_slugify(basename(get_the_permalink()));
        $catclass = '';
        ?>
            <div class="<?=$catclass?> caseStudy">
                <a class="caseStudy_card" href="<?=$slug?>">
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