<?php
$bg = get_vimeo_data_from_id(get_field('vimeo_id'), 'thumbnail_url');
?>
<section class="video">
    <div class="lite-vimeo" data-aos="fade">
        <lite-vimeo videoid="<?=get_field('vimeo_id')?>" style="background-image:url('<?=$bg?>');"></lite-vimeo>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script type=module src="https://cdn.jsdelivr.net/npm/@slightlyoff/lite-vimeo@0.1.1/lite-vimeo.js"></script>
    <?php
});