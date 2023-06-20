<?php
/**
 * The template for displaying all single case studies
 *
 * @package cb-timberrooms2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action('wp_head', function () {
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>';
});

get_header();
the_post();

$town = '';
if (get_the_terms(get_the_ID(),'towns')) {
    $town = get_the_terms(get_the_ID(),'towns')[0]->name;
}
$county = '';
if (get_the_terms(get_the_ID(),'counties')) {
    $county = get_the_terms(get_the_ID(),'counties')[0]->name;
}

?>
<main class="case_study pb-3">
    <div class="container-xl pt-3">
        <div class="row">
            <div class="col-md-9">
                <h1 class="mb-3"><?=get_the_title()?></h1>
                <strong class="d-block mb-4">
                <?php
                if ($town != '') {
                    echo $town;
                }
                if ($town && $county) {
                    echo ' - ';
                }
                if ($county != '') {
                    echo $county;
                }
                ?>
                </strong>
                <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'full')?>" alt="" class="mb-4">
                <?=apply_filters('the_content',get_the_content())?>
                <div class="cta">
                    To see more of our bespoke designs please visit the <a href="/case-studies/">case studies</a> page. For more information and to book a free site survey please call <?=do_shortcode('[contact_phone]')?> or email <?=do_shortcode('[contact_email]')?>
                </div>
                <?php
                if (get_field('gallery')) {
                    ?>
                <h3>Gallery</h3>
                <div class="image-gallery mb-3">
                    <?php
                    $d = 0;
                    foreach(get_field('gallery') as $i) {
                        ?>
                    <div data-thumb="<?=wp_get_attachment_image_url( $i, 'large' )?>" data-aos="fade" data-aos-delay="<?=$d?>" data-aos-anchor=".image-gallery">
                        <a href="<?=wp_get_attachment_image_url( $i, 'full' )?>" data-fancybox="gallery">
                            <img src="<?=wp_get_attachment_image_url( $i, 'medium' )?>">
                        </a>
                    </div>
                        <?php
                        $d += 50;
                    }
                    ?>
                </div>
                <?php
                    add_action('wp_footer',function(){
                        ?>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
Fancybox.bind('[data-fancybox="gallery"]', {
});
</script>
</script>
                        <?php
                    });
                }
                ?>
            </div>
            <div class="col-md-3 sidebar">
                <a href="/case-studies/"><h2 class="h3">Case Studies</h2></a>
                <?php
    $q = new WP_Query(array(
        'post_type' => 'case-studies',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID())
    ));
    $d = 0;
    while ($q->have_posts()) {
        $q->the_post();
        $img = get_the_post_thumbnail_url(get_the_ID());
        ?>
        <a class="cs_card mb-4" href="<?=get_the_permalink(get_the_ID())?>" data-aos="fade-up" data-aos-delay="<?=$d?>" data-aos-anchor=".sidebar">
            <div class="cs_card__image"><img src="<?=$img?>"></div>
            <div class="cs_card__title">
                <?=get_the_title(get_the_ID())?>
            </div>
        </a>
        <?php
        $d += 50;
    }

    include( get_stylesheet_directory() . '/page-templates/blocks/cb_cta.php');
                ?>
            </div>
        </div>
    </div>
</main>
<?php

get_footer();
