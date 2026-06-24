<?php
/**
 * Single post template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;
get_header();
$img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>
<main id="main" class="blog">
    <?php
    $content = get_the_content();
    $blocks  = parse_blocks( $content );
    ?>
    <section class="breadcrumbs container-xl pt-4">
    <?php
    if ( function_exists( 'yoast_breadcrumb' ) ) {
        yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
    }
    ?>
    </section>
    <div class="container-xl">
        <div class="row g-4 pb-4">
            <div class="col-lg-9">
                <h1 class="blog__title"><?= wp_kses_post( get_the_title() ); ?></h1>
                <img src="<?= esc_url( $img ); ?>" alt="" class="blog__image">
            <?php
            $count = estimate_reading_time_in_minutes( get_the_content(), 200, true, true );
            echo wp_kses_post( $count );

			foreach ( $blocks as $block ) {
				echo render_block( $block );
			}
            ?>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
        <section class="related pb-5">
            <h3 class="h4"><span>Related</span> Insights</h3>
            <?php
            $cats = get_the_category();
            $ids  = wp_list_pluck( $cats, 'term_id' );
            $r    = new WP_Query(
                array(
					'category__in'   => $ids,
					'posts_per_page' => 4,
					'post__not_in'   => array( get_the_ID() ),
                )
            );
            while ( $r->have_posts() ) {
                $r->the_post();
                ?>
				<a class="blog_card" href="<?= esc_url( get_the_permalink() ); ?>">
					<div class="blog_card__image-wrap">
						<img src="<?= esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" alt="" class="blog_card__image">
					</div>
					<div class="blog_card__content">
						<h3 class="blog_card__title"><?= wp_kses_post( get_the_title() ); ?></h3>
					</div>
				</a>
                <?php
            }
            ?>
            </div>
        </section>
            </div>
        </div>
    </div>
<section class="cta py-5 text-center">
    <div class="container-xl" data-aos="fade">
        <img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/timberrooms-logo--wo.png' ); ?>" alt="Timber Rooms">
        <h3>Thinking about a Garden Room?</h3>
        <a href="/contact/" class="h5">Book a Free Site Survey</a>
        <div class="cta__grid">
            <div class="line"></div>
            <div class="h5">Call Now: <a href="tel:<?= esc_attr( parse_phone( get_field( 'contact_phone', 'options' ) ) ); ?>"><?= esc_html( get_field( 'contact_phone', 'options' ) ); ?></a></div>
            <div class="line"></div>
        </div>
    </div>
</section>
</main>
<?php
get_footer();