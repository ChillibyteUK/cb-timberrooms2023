<?php
// $img = wp_get_attachment_image_url( get_field('background') ,'full');
$img = '';
if (get_field('background') ) {
    $img = wp_get_attachment_image_url(get_field('background'),'full');
}
else {
    $img = get_the_post_thumbnail_url(get_the_ID(),'full');
}

$class = $block['className'] ?? null ?: '';

$hclass = '';
if ((get_field('centre_title')[0] ?? null) == 'Yes') {
     $hclass .= ' text-center';
}

?>
<link rel="preload" as="image" href="<?=$img?>">
<header class="hero <?=$class?>" data-parallax="scroll" data-image-src="<?=$img?>">
</header>
<?php
$mt = 'mt-5';
if (null !== get_field('theme') && get_field('theme') != 'None') {
    $logo = get_field('theme') == 'Pods' ? 'timberrooms-logo-prefab--wo.svg' : 'timberrooms-logo--wo.svg';
    ?>
<section class="logo mt-2 py-4">
    <div class="container-xl text-center" data-aos="fade">
        <img src="<?=get_stylesheet_directory_uri()?>/img/<?=$logo?>" alt="">
    </div>
</section>
    <?php
    $mt = 'mt-3';
}
?>
<div class="container-xl <?=$mt?> mb-4">
<h1 data-aos="fade" class="<?=$hclass?>"><?=get_field('title')?></h1>
</div>
