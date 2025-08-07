<?php
$id = get_field('vimeo_id');
?>
<section class="video">
    <div class="container-xl py-5">
        <div class="ratio ratio-16x9 lite-vimeo w-100">
            <iframe src="https://player.vimeo.com/video/<?=$id?>?autoplay=1&amp;loop=1&amp;muted=1&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&amp;dnt=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" referrerpolicy="strict-origin-when-cross-origin" title="Timber Rooms"></iframe>
        </div>
    </div>
</section>
