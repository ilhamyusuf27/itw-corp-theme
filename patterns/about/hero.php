<?php
/**
 * Title: About: hero
 * Slug: itw-corp/about-hero
 * Categories: itw-corp-about, banner
 * Keywords: about, studio, heading
 * Viewport Width: 1440
 * Description: The page name, one line about the studio, and a wide room.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-head a-hero","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-head a-hero">
	<!-- wp:heading {"level":1,"className":"p-head__title"} -->
	<h1 class="wp-block-heading p-head__title"><?php esc_html_e( 'Our studio', 'itw-corp' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"p-head__lead"} -->
	<p class="p-head__lead"><?php esc_html_e( 'An interior design and build studio for homes, and for the places where people work, eat and stay.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->

	<?php echo Media::image( '1', __( 'A white villa with arched windows, a planted roof terrace and a garden gazebo', 'itw-corp' ), 'a-hero__img', 'full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
<!-- /wp:group -->
