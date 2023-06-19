<!-- <link rel="stylesheet" href="<?=get_stylesheet_directory_uri()?>/css/jquery.fancybox.min.css" /> -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>
<section class="gallery has-dark-background-color py-5">
    <div class="container-xl">
        <div class="gallery__grid" id="lightslider">
        <?php
        while(have_rows('images')) {
            the_row();
            if (get_sub_field('image')) {
                $i = get_sub_field('image');
                ?>
                    <div data-thumb="<?=wp_get_attachment_image_url( $i, 'large' )?>" class="gallery__image">
                        <a href="<?=wp_get_attachment_image_url( $i, 'full' )?>" data-fancybox="gallery">
                            <img src="<?=wp_get_attachment_image_url( $i, 'medium' )?>">
                        </a>
                    </div>
                <?php
            }
            else {
                $i = get_sub_field('case_study')[0];
                $town = '';
                if (get_the_terms($i,'towns')) {
                    $town = get_the_terms($i,'towns')[0]->name;
                }
                $county = '';
                if (get_the_terms($i,'counties')) {
                    $county = get_the_terms($i,'counties')[0]->name;
                }
                ?>
                <figure data-src="<?=get_the_post_thumbnail_url( $i, 'full' )?>" data-fancybox="gallery">
                    <img src="<?=get_the_post_thumbnail_url( $i, 'large' )?>">
                    <figcaption><?=get_the_title($i)?> - <a href="<?=get_the_permalink($i)?>">View Case Study</a></figcaption>
                    <div class="overlay">
                        <h3><?=get_the_title($i)?></h3>
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
                        <div class="text-center"><i class="fa-regular fa-eye"></i> Case Study</div>
                    </div>
                    </figure>
                <?php
            }
        }
        ?>
        </div>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
Fancybox.bind('[data-fancybox="gallery"]', {
    caption: function (_fancybox, slide) {
    const figurecaption = slide.triggerEl?.querySelector("figcaption");
    return figurecaption ? figurecaption.innerHTML : slide.caption || "";
  },
});
</script>
    <?php
});