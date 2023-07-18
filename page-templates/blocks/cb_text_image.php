<?php
$colour = get_field('theme');
$background = 'has-dark-background-color text-white';
switch ($colour) {
    case 'Dark':
        $background = 'has-dark-background-color text-white';
        break;
    case 'Mid':
        $background = 'has-grey-background-color text-dark';
        break;
    // case 'Light':
    //     $background = '';
    //     break;
}

$theme = get_field('heading_theme') == 'Pods' ? 'has-prefab-color' : 'has-primary-color';

$breakout = '';
if (get_field('breakout')[0] ?? null && get_field('breakout')[0] == 'Yes') {
    $breakout = $background;
    $background = '';
}

$splitText = 'col-md-6';
$splitImage = 'col-md-6';

if (get_field('split') == '6040') {
    $splitText = 'col-md-8';
    $splitImage = 'col-md-4';
}
if (get_field('split') == '7030') {
    $splitText = 'col-md-10';
    $splitImage = 'col-md-2';
}

$orderText = 'order-2 order-md-1';
$fadeText = "fade-right";
$orderImage = 'order-1 order-md-2';
$fadeImage = "fade-left";

if (get_field('order') == 'image-text') {
    $orderText = 'order-2 order-md-2';
    $orderImage = 'order-1 order-md-1';
    $fadeText = "fade-left";
    $fadeImage = "fade-right";
}
?>
<section class="text_image <?=$breakout?>">
    <div class="container-xl <?=$background?> py-5">
        <div class="d-lg-none <?=$theme?>" data-aos="fade"><h2><?=get_field('title')?></h2></div>
        <div class="row align-items-center g-4">
            <div class="<?=$splitText?> <?=$orderText?>" data-aos="<?=$fadeText?>">
                <h2 class="d-none d-lg-block <?=$theme?>"><?=get_field('title')?></h2>
                <div><?=get_field('content')?></div>
                <?php
                if (get_field('cta')) {
                    $link = get_field('cta');
                    ?>
                    <a href="<?=$link['url']?>" class="btn btn--accent"><?=$link['title']?></a>
                    <?php
                }
                ?>
            </div>
            <div class="<?=$splitImage?> <?=$orderImage?> text-center" data-aos="<?=$fadeImage?>">
                <?=wp_get_attachment_image(get_field('image'), 'large', null, array('class' => 'text_image__image'))?>
            </div>
        </div>
    </div>
</section>