<?php
$theme = get_field('theme');

switch ($theme) {
    case 'Pods':
        $theme = 'has-prefab-color';
        break;
    case 'Golf':
        $theme = 'has-golf-color';
        break;
    default:
        $theme = 'has-primary-color';
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<section class="gallery has-dark-background-color py-5">
    <div class="container-xl">
        <div class="gallery__grid" id="lightslider">
            <?php
        $d = 0;
$gallery = array_reverse(get_field('images'));
foreach($gallery as $g) {
    if ($g['image']) {
        $i = $g['image'];
        ?>
            <div data-thumb="<?=wp_get_attachment_image_url($i, 'large')?>"
                class="gallery__image" data-aos="fade"
                data-aos-delay="<?=$d?>"
                data-aos-anchor=".gallery__grid">
                <a href="<?=wp_get_attachment_image_url($i, 'full')?>"
                    data-fancybox="gallery">
                    <img
                        src="<?=wp_get_attachment_image_url($i, 'full')?>">
                    <figcaption class="text-center">
                        <?=$g['image_title']?><br><?php
                    if ($g['town'] != '') {
                        echo $g['town'];
                    }
                    if ($g['town'] && $g['county']) {
                        echo ' - ';
                    }
                    if ($g['county'] != '') {
                        echo $g['county'];
                    }
        ?></figcaption>
                    <div class="overlay">
                        <h3 class="<?=$theme?>">
                            <?=$g['image_title']?>
                        </h3>
                        <div class="text-center">
                            <?php
            if ($g['town'] != '') {
                echo $g['town'];
            }
            if ($g['town'] && $g['county']) {
                echo ' - ';
            }
            if ($g['county'] != '') {
                echo $g['county'];
            }
        ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
    } else {
        $i = $g['case_study'][0];
        $town = '';
        if (get_the_terms($i, 'towns')) {
            $town = get_the_terms($i, 'towns')[0]->name;
        }
        $county = '';
        if (get_the_terms($i, 'counties')) {
            $county = get_the_terms($i, 'counties')[0]->name;
        }
        ?>
            <figure
                data-src="<?=get_the_post_thumbnail_url($i, 'full')?>"
                data-fancybox="gallery" data-aos="fade"
                data-aos-delay="<?=$d?>"
                data-aos-anchor=".gallery__grid">
                <img
                    src="<?=get_the_post_thumbnail_url($i, 'large')?>">
                <figcaption><?=get_the_title($i)?><br>
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
        ?><br>
                    <a href="<?=get_the_permalink($i)?>">View Case
                        Study</a>
                </figcaption>
                <div class="overlay">
                    <h3 class="<?=$theme?>">
                        <?=get_the_title($i)?></h3>
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
    $d += 50;
}
?>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind('[data-fancybox="gallery"]', {
        caption: function(_fancybox, slide) {
            const figurecaption = slide.triggerEl?.querySelector("figcaption");
            return figurecaption ? figurecaption.innerHTML : slide.caption || "";
        },
    });
</script>
<?php
});
