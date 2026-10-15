<?php
/**
 * Title: Service page
 * Slug: itw-corp/layout-service
 * Inserter: no
 * Description: One service: name, short description, starting price and action; a wide room; what is included and the questions from the content; projects; the reply card.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec s-hero","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec s-hero">
	<!-- wp:post-title {"level":1,"className":"s-hero__title"} /-->

	<!-- wp:group {"className":"s-hero__aside","layout":{"type":"default"}} -->
	<div class="wp-block-group s-hero__aside">
		<!-- wp:post-excerpt {"className":"s-hero__lead"} /-->

		<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/service","args":{"key":"price"}}}},"className":"s-hero__price"} -->
		<p class="s-hero__price"></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/#book' ) ); ?>"><?php esc_html_e( 'Book a consultation', 'itw-corp' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-featured-image {"sizeSlug":"full","className":"s-hero__cover"} /-->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"article","align":"full","className":"p-story s-story","layout":{"type":"default"}} -->
<article class="wp-block-group alignfull p-story s-story">
	<!-- wp:post-content {"layout":{"type":"constrained","contentSize":"760px","wideSize":"1280px"}} /-->
</article>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-related","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-related">
	<!-- wp:group {"className":"p-related__head","layout":{"type":"default"}} -->
	<div class="wp-block-group p-related__head">
		<!-- wp:heading {"className":"p-related__title"} -->
		<h2 class="wp-block-heading p-related__title"><?php esc_html_e( 'Rooms we have made', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"p-related__all"} -->
		<p class="p-related__all"><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'All projects', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":32,"query":{"perPage":3,"pages":0,"offset":0,"postType":"project","order":"desc","orderBy":"date","inherit":false,"itwServiceProjects":true},"className":"p-query"} -->
	<div class="wp-block-query p-query">
		<!-- wp:post-template {"className":"p-grid p-grid--three"} -->
			<!-- wp:pattern {"slug":"itw-corp/shared-project-card"} /-->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"itw-corp/shared-project-reply-card"} /-->
