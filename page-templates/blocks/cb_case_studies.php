<section class="cs_slider">
    <?php
    $q = new WP_Query(array(
        'post_type' => 'case-studies',
        'posts_per_page' => 6
    ));
    while ($q->have_posts()) {
        $q->the_post();
        $img = get_the_post_thumbnail_url(get_the_ID(),'large');
        $town = '';
        if (get_the_terms(get_the_ID(),'towns')) {
            $town = get_the_terms(get_the_ID(),'towns')[0]->name;
        }
        $county = '';
        if (get_the_terms(get_the_ID(),'counties')) {
            $county = get_the_terms(get_the_ID(),'counties')[0]->name;
        }

        ?>
    <div class="cs_slider__slide">
        <a href="<?=get_the_permalink(get_the_ID())?>">
            <img src="<?=$img?>" alt="<?=get_the_title(get_the_ID())?>">
            <div class="overlay">
                <h3><?=get_the_title(get_the_ID())?></h3>
                <div class="text-center">
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
                </div>
            </div>
        </a>
    </div>
        <?php
    }
    ?>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/accessible-slick-theme.min.css">
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>
<script>
jQuery(function($){
  $('.cs_slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2,
                    autoplay: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true
                }
            }
        ]
  });
});
</script>
    <?php
});