<!-- faq_block -->
<section class="faq_block">
    <div class="container-xl my-4">
        <?php
        if(get_field('faq_title')) {
            ?>
        <h2 class="mb-4 text-center"><?=get_field('faq_title')?></h2>
            <?php
        }
        if(get_field('faq_intro')) {
            ?>
        <div class="text-center mw-md-75 mb-4"><?=get_field('faq_intro')?></div>
            <?php
        }
        ?>
        <div class="faq_block__inner">
            <?php
    $accordion = random_str(5);

    echo '<div itemscope="" itemtype="https://schema.org/FAQPage" id="accordion' .  $accordion . '" class="accordion accordion-flush">';
    $counter = 0;
    $show = '';
    $collapsed = 'collapsed';
    $d = 0;
    while (have_rows('faqs')) {
        the_row();
        $ac = $accordion . '_' . $counter;
        ?>
        <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question" class="accordion-item" data-aos="fade-up" data-aos-anchor=".faq_block__inner" data-aos-delay="<?=$d?>">
            <div class="accordion-head accordion-collapse <?=$collapsed?>" itemprop="name" data-bs-toggle="collapse" id="heading_<?=$ac?>" data-bs-target="#c<?=$ac?>" role="button" aria-expanded="true" aria-controls="c<?=$ac?>">
                <div class="pb-1"><?=get_sub_field('question')?></div>
            </div>
            <div class="collapse <?=$show?>" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" id="c<?=$ac?>" aria-labelledby="heading_<?=$ac?>" data-bs-parent="#accordion<?=$accordion?>">
                <div itemprop="text" class="faq__answer pb-4">
                    <p><?=get_sub_field('answer')?></p>
                </div>
            </div>
        </div>
        <?php
        $counter++;
        $show = '';
        $collapsed = 'collapsed';
        $d += 50;
    }
    echo '</div>';
     ?>
    </div>
</section>