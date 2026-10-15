<?php
/**
 * Title: Home: one team
 * Slug: itw-corp/home-intro
 * Categories: itw-corp-home, about
 * Keywords: value, usp, intro, promise
 * Viewport Width: 1440
 * Description: A two-line heading and four short promises captioning a full-width room.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;

$itw_promises = array(
	__( 'One team, from design to build', 'itw-corp' ),
	__( 'Every room seen in 3D first', 'itw-corp' ),
	__( 'Made in our own workshop', 'itw-corp' ),
	__( 'A quotation you can read', 'itw-corp' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec h-intro","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec h-intro">
	<!-- wp:group {"className":"h-intro__head","layout":{"type":"default"}} -->
	<div class="wp-block-group h-intro__head">
		<!-- wp:heading {"className":"h-intro__title"} -->
		<h2 class="wp-block-heading h-intro__title"><?php esc_html_e( 'Drawn and built by one team', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:group {"className":"h-intro__list","layout":{"type":"default"}} -->
		<div class="wp-block-group h-intro__list">
			<?php foreach ( $itw_promises as $itw_promise ) : ?>
			<!-- wp:paragraph -->
			<p><?php echo esc_html( $itw_promise ); ?></p>
			<!-- /wp:paragraph -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<?php echo Media::image( 'in-liv', __( 'A double-height living room with a timber slat screen, a long sofa and morning light through tall windows', 'itw-corp' ), 'h-intro__pano', 'full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
<!-- /wp:group -->
