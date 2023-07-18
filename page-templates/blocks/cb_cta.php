<?php
$logo = get_field('theme') == 'Pods' ? 'timberrooms-logo-prefab--wo.svg' : 'timberrooms-logo--wo.svg';
// $theme = get_field('theme') == 'Pods' ? 'has-prefab-color' : 'has-primary-color';
$theme = '';
?>
<section class="cta">
    <div class="container-xl text-center" data-aos="fade">
        <img src="<?=get_stylesheet_directory_uri()?>/img/<?=$logo?>" alt="">
        <h3>Are you considering a Garden Room?</h3>
        <a href="/contact/" class="h5 <?=$theme?>">Book a Free Site Survey</a>
        <div class="cta__grid">
            <div class="line"></div>
            <div class="h5">Call Now: <a href="tel:<?=parse_phone(get_field('contact_phone','options'))?>"><?=get_field('contact_phone','options')?></a></div>
            <div class="line"></div>
        </div>
    </div>
</section>