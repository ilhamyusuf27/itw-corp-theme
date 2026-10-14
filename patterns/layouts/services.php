<?php
/**
 * Title: Services overview
 * Slug: itw-corp/layout-services
 * Inserter: no
 * Description: All services as large alternating rows of picture and words, then the process and the reply card.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-head","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-head">
	<!-- wp:heading {"level":1,"className":"p-head__title"} -->
	<h1 class="wp-block-heading p-head__title"><?php esc_html_e( 'Services', 'itw-corp' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"p-head__lead"} -->
	<p class="p-head__lead"><?php esc_html_e( 'Four ways we work, each designed, drawn and built by one team.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"s-list","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull s-list">
	<!-- wp:query {"queryId":31,"query":{"inherit":true,"perPage":20,"postType":"service"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"s-rows"} -->
			<!-- wp:post-featured-image {"isLink":true,"sizeSlug":"large","className":"s-row__img"} /-->

			<!-- wp:group {"className":"s-row__text","layout":{"type":"default"}} -->
			<div class="wp-block-group s-row__text">
				<!-- wp:post-title {"level":2,"isLink":true,"className":"s-row__title"} /-->

				<!-- wp:post-excerpt {"className":"s-row__lead"} /-->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/service","args":{"key":"price"}}}},"className":"s-row__price"} -->
				<p class="s-row__price"></p>
				<!-- /wp:paragraph -->

				<!-- wp:read-more {"content":"<?php esc_attr_e( 'About this service', 'itw-corp' ); ?>","className":"s-row__more"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"className":"p-empty"} -->
			<p class="p-empty"><?php esc_html_e( 'Services are being added.', 'itw-corp' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"itw-corp/shared-process-row"} /-->

<!-- wp:pattern {"slug":"itw-corp/shared-project-reply-card"} /-->
