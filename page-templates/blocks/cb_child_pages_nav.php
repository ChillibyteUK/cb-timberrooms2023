<section class="child_pages has-dark-background-color py-5">
    <div class="container-xl">
        <div class="child_pages__grid">
        <?php
$q = new WP_Query(array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => get_the_ID(),
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 ));
 while($q->have_posts()) {
    $q->the_post();

    if (get_field('background',get_the_ID()) ) {
        $img = wp_get_attachment_image_url(get_field('background',get_the_ID()),'full');
    }
    else {
        $img = get_the_post_thumbnail_url(get_the_ID(),'full');
    }

    ?>
            <a class="child_pages__card" href="<?=get_the_permalink()?>">
                <div class="child_pages__image">
                    <img src="<?=$img?>" alt="">
                </div>
                <div class="child_pages__content">
                    <div class="article-title mb-2">
                        <?=get_the_title()?>
                    </div>
                </div>
            </a>
    <?php
 }
        ?>
        </div>
    </div>
</section>