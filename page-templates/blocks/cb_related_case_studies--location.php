<section class="cs_related has-dark-background-color py-5">
    <div class="container-xl">
        <h2 class="h3">Case Studies in <?=get_the_title()?></h2>
        <div class="cs_related__grid">
    <?php
    $town = get_field('town');
    $county = get_field('county');

    $tax_county = '';
    $tax_town = '';

    if ($county) {
        $tax_county = array(
            'taxonomy' => 'counties',
            'field' => 'id',
            'terms' => array($county)
        );
    }

    if ($town) {
        $tax_town = array(
            'taxonomy' => 'towns',
            'field' => 'id',
            'terms' => array($town)
        );
    }

    $q = new WP_Query(array(
        'post_type' => 'case-studies',
        'posts_per_page' => 3,
        'tax_query' => array(
            'relation' => 'AND',
            $tax_county,
            $tax_town
        )
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
    <div class="cs_related__slide">
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
        </div>
    </div>
</section>