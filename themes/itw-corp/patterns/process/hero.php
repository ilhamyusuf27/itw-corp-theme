<?php
/**
 * Title: Process: heading
 * Slug: itw-corp/process-hero
 * Categories: itw-corp-process, banner
 * Keywords: process, how we work, heading
 * Viewport Width: 1440
 * Description: The page name and one line, with a wide room.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-head pr-hero","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-head pr-hero">
	<!-- wp:heading {"level":1,"className":"p-head__title"} -->
	<h1 class="wp-block-heading p-head__title"><?php esc_html_e( 'How we work', 'itw-corp' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"p-head__lead"} -->
	<p class="p-head__lead"><?php esc_html_e( 'Eight steps with one team, and every room seen in 3D before anything is built.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->

	<?php echo Media::image( 'in-liv-2', __( 'A living and dining space behind a timber slat stair in afternoon sun', 'itw-corp' ), 'pr-hero__img', 'full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
<!-- /wp:group -->
