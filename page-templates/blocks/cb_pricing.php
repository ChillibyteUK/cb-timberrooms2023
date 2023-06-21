<section class="pricing has-dark-background-color">
    <div class="container-xl">
        <div class="pricing__grid">
        <?php
        while(have_rows('cards')) {
            the_row();
            ?>
        <div class="pricing__card">
            <img class="pricing__image" src="<?=wp_get_attachment_image_url(get_sub_field('image'),'large')?>" alt="">
            <div class="pricing__size"><?=get_sub_field('size')?></div>
            <div class="pricing__price">£<?=number_format(get_sub_field('price'))?></div>
            <div class="pricing__features">
                <ul>
                    <?=cb_list(get_sub_field('features'))?>
                </ul>
            </div>
        </div>
            <?php
        }
        ?>
        </div>
    </div>
</section>