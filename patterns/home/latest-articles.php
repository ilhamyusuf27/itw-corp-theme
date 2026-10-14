<?php
/**
 * Title: Home: latest articles
 * Slug: itw-corp/home-latest-articles
 * Categories: itw-corp-home, query
 * Keywords: blog, articles, insights, journal, latest
 * Viewport Width: 1440
 * Description: The three latest posts as a plain list on the right, a room on the left.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec h-journal","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec h-journal">
	<?php echo Media::image( 'mbeds1', __( 'A lilac study bedroom with a white desk and a soft grey armchair', 'itw-corp' ), 'h-journal__photo' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<!-- wp:group {"className":"h-journal__body","layout":{"type":"default"}} -->
	<div class="wp-block-group h-journal__body">
		<!-- wp:heading {"className":"h-journal__title"} -->
		<h2 class="wp-block-heading h-journal__title"><?php esc_html_e( 'Notes on light and material', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
		<div class="wp-block-query">
			<!-- wp:post-template {"className":"h-journal__rows"} -->
				<!-- wp:post-date {"format":"j M Y"} /-->
				<!-- wp:post-title {"level":3,"isLink":true} /-->
			<!-- /wp:post-template -->

			<!-- wp:query-no-results -->
				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'The first articles are on their way.', 'itw-corp' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:query-no-results -->
		</div>
		<!-- /wp:query -->

		<!-- wp:paragraph {"className":"h-journal__all"} -->
		<p class="h-journal__all"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'All articles', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
