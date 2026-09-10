<?php
/**
 * CB Process Steps Block Template.
 *
 * A numbered row of steps, e.g. "How we build yours". Step numbers are
 * generated from row order (Step 01, 02, ...) rather than being an
 * editable field. Colour follows --col-highlight-400, so it goes Golf
 * green automatically on the page-golf.php template.
 *
 * @package cb-timberrooms2023
 */

defined( 'ABSPATH' ) || exit;

$title = get_field( 'title' );

if ( ! have_rows( 'steps' ) ) {
	return;
}
?>
<section class="process-steps py-5">
	<div class="container-xl">
		<?php if ( $title ) : ?>
			<h2 class="text-center"><?= esc_html( $title ); ?></h2>
		<?php endif; ?>
		<div class="process-steps__grid">
			<?php
			$number = 0;
			while ( have_rows( 'steps' ) ) :
				the_row();
				++$number;
				$step_title = get_sub_field( 'title' );
				$description = get_sub_field( 'description' );
				if ( ! $step_title && ! $description ) {
					continue;
				}
				?>
				<div class="process-steps__item" data-aos="fade-up" data-aos-delay="<?= esc_attr( ( $number - 1 ) * 50 ); ?>">
					<div class="process-steps__number has-primary-color">Step <?= esc_html( str_pad( $number, 2, '0', STR_PAD_LEFT ) ); ?></div>
					<?php if ( $step_title ) : ?>
						<h3 class="process-steps__title"><?= esc_html( $step_title ); ?></h3>
					<?php endif; ?>
					<?php if ( $description ) : ?>
						<p class="process-steps__description"><?= esc_html( $description ); ?></p>
					<?php endif; ?>
				</div>
				<?php
			endwhile;
			?>
		</div>
	</div>
</section>
