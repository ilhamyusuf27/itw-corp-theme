<?php
/**
 * Title: About: design philosophy
 * Slug: itw-corp/about-philosophy
 * Categories: itw-corp-about, about
 * Keywords: philosophy, principles, approach
 * Viewport Width: 1440
 * Description: Three principles, each with a room that shows it. SAMPLE COPY: confirm or rewrite the three principles.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;

$itw_principles = array(
	array( '2ndf-liv', __( 'Light comes first', 'itw-corp' ), __( 'We plan rooms around where the sun falls, then place everything else.', 'itw-corp' ), __( 'A living room in warm afternoon sun', 'itw-corp' ) ),
	array( '6', __( 'Materials you can touch', 'itw-corp' ), __( 'Timber, stone and fabric chosen from real samples, not from a screen.', 'itw-corp' ), __( 'A marble kitchen island with green cabinets and patterned tiles', 'itw-corp' ) ),
	array( 'mid-1', __( 'Made to be lived in', 'itw-corp' ), __( 'Rooms that stay easy to clean, easy to change and easy to love.', 'itw-corp' ), __( 'A family living and dining room seen from above', 'itw-corp' ) ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec a-ideas","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec a-ideas">
	<!-- wp:heading {"className":"a-ideas__title"} -->
	<h2 class="wp-block-heading a-ideas__title"><?php esc_html_e( 'How we design', 'itw-corp' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"a-ideas__list","layout":{"type":"default"}} -->
	<div class="wp-block-group a-ideas__list">
		<?php foreach ( $itw_principles as $itw_idea ) : ?>
		<!-- wp:group {"className":"a-idea","layout":{"type":"default"}} -->
		<div class="wp-block-group a-idea">
			<?php echo Media::image( $itw_idea[0], $itw_idea[3], 'a-idea__img' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			<!-- wp:heading {"level":3,"className":"a-idea__title"} -->
			<h3 class="wp-block-heading a-idea__title"><?php echo esc_html( $itw_idea[1] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"a-idea__text"} -->
			<p class="a-idea__text"><?php echo esc_html( $itw_idea[2] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
