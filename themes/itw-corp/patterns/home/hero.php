<?php
/**
 * Title: Home: hero
 * Slug: itw-corp/home-hero
 * Categories: itw-corp-home, banner
 * Keywords: hero, home, intro
 * Viewport Width: 1440
 * Description: One sentence whose missing word is a strip of a finished room, then the action.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-hero","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-hero">
	<!-- wp:group {"className":"h-hero__line","layout":{"type":"default"}} -->
	<div class="wp-block-group h-hero__line">
		<!-- wp:heading {"level":1,"className":"h-hero__title"} -->
		<h1 class="wp-block-heading h-hero__title"><span class="h-hero__w1"><?php esc_html_e( 'Rooms', 'itw-corp' ); ?></span> <span class="h-hero__w2"><?php esc_html_e( 'to live in', 'itw-corp' ); ?></span></h1>
		<!-- /wp:heading -->

		<?php echo Media::image( '2ndf-liv', __( 'A sunlit living room with soft armchairs, a timber floor and a wall of framed prints', 'itw-corp' ), 'h-hero__strip', 'full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"h-hero__foot","layout":{"type":"default"}} -->
	<div class="wp-block-group h-hero__foot">
		<!-- wp:paragraph {"className":"h-hero__lead"} -->
		<p class="h-hero__lead"><?php esc_html_e( 'Calm, lived-in homes, designed and built across Indonesia.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"h-hero__actions"} -->
		<div class="wp-block-buttons h-hero__actions">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Book a consultation', 'itw-corp' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
