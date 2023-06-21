<section class="pricing has-dark-background-color">
    <div class="container-xl">
        <?php
        while(have_rows('models')) {
            the_row();
            ?>
        <div class="pricing__card">
            <img src="" alt="">
            <div class="pricing__size">size</div>
            <div class="pricing__price">price</div>
            <div class="pricing__features">
                <ul>
                    <li>feature</li>
                </ul>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
</section>