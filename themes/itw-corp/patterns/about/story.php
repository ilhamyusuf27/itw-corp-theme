<?php
/**
 * Title: About: our story
 * Slug: itw-corp/about-story
 * Categories: itw-corp-about, about
 * Keywords: story, history, company profile
 * Viewport Width: 1440
 * Description: The studio's story beside a picture from the workshop. SAMPLE COPY: replace with the real story (when and why the studio started, who founded it).
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec a-story","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec a-story">
	<!-- wp:heading {"className":"a-story__title"} -->
	<h2 class="wp-block-heading a-story__title"><?php esc_html_e( 'From sketch to keys', 'itw-corp' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"a-story__text","layout":{"type":"default"}} -->
	<div class="wp-block-group a-story__text">
		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'itw-corp brings designers, drafters, site supervisors and craftsmen together in one studio. The people who draw your rooms are the people who see them built.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Every room is planned around how it will be used, shown in 3D before anything is made, and built with furniture from our own workshop. That way the finished room looks like the one you agreed to.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<?php echo Media::image( 'mbeds3', __( 'A built-in timber wardrobe beside a reading chair and a window', 'itw-corp' ), 'a-story__img' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
<!-- /wp:group -->
