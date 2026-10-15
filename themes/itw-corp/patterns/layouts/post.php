<?php
/**
 * Title: Article
 * Slug: itw-corp/layout-post
 * Categories: itw-corp-shared
 * Inserter: no
 * Description: One article: title, author, date, reading time and category; the cover; the text; tags and share links; more to read; the reply card.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec b-post","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec b-post">
	<!-- wp:post-title {"level":1,"className":"b-post__title"} /-->

	<!-- wp:group {"className":"b-post__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
	<div class="wp-block-group b-post__meta">
		<!-- wp:post-author-name /-->

		<!-- wp:post-date {"format":"j F Y"} /-->

		<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/post","args":{"key":"reading_time"}}}}} -->
		<p></p>
		<!-- /wp:paragraph -->

		<!-- wp:post-terms {"term":"category"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-featured-image {"sizeSlug":"full","className":"b-post__cover"} /-->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"article","align":"full","className":"p-story b-story","layout":{"type":"default"}} -->
<article class="wp-block-group alignfull p-story b-story">
	<!-- wp:post-content {"layout":{"type":"constrained","contentSize":"720px","wideSize":"1100px"}} /-->

	<!-- wp:group {"className":"b-story__foot","layout":{"type":"constrained","contentSize":"720px"}} -->
	<div class="wp-block-group b-story__foot">
		<!-- wp:post-terms {"term":"post_tag","className":"b-tags"} /-->

		<!-- wp:group {"className":"b-share","layout":{"type":"default"}} -->
		<div class="wp-block-group b-share"></div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</article>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-related b-related","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-related b-related">
	<!-- wp:group {"className":"p-related__head","layout":{"type":"default"}} -->
	<div class="wp-block-group p-related__head">
		<!-- wp:heading {"className":"p-related__title"} -->
		<h2 class="wp-block-heading p-related__title"><?php esc_html_e( 'More to read', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"p-related__all"} -->
		<p class="p-related__all"><a href="<?php echo esc_url( get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'All articles', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":52,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false,"itwRelatedPosts":true}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"b-grid b-grid--three"} -->
			<!-- wp:pattern {"slug":"itw-corp/blog-post-card"} /-->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"itw-corp/shared-reply-card"} /-->
