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

?>
<link rel="preload" as="image" href="<?=$img?>">
<header class="hero <?=$class?>" style="background-image:url(<?=$img?>)">
    <h1><?=get_field('title')?></h1>
</header>
