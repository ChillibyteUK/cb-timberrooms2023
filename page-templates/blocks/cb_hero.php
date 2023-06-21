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
<header class="hero <?=$class?>" style="background-image:url(<?=$img?>)">
</header>
<div class="container-xl mt-5 mb-4">
<h1 data-aos="fade" class="<?=$hclass?>"><?=get_field('title')?></h1>
</div>
