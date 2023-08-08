<?php
$id = get_field('vimeo_id');
?>
<section class="video">
    <div class="container-xl py-5">
        <div class="ratio ratio-16x9 lite-vimeo w-100">
            <iframe src="https://player.vimeo.com/video/<?=$id?>?muted=1&amp;badge=0&amp;autopause=0&amp;autoplay=1&amp;loop=1&amp;player_id=0&amp;app_id=58479&dnt=1" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title="Timber Rooms"></iframe>
        </div>
    </div>
</section>
