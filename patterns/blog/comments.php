<?php
/**
 * Title: Comments
 * Slug: itw-corp/blog-comments
 * Categories: itw-corp-shared
 * Inserter: no
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:comments {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
<div class="wp-block-comments" style="margin-top:var(--wp--preset--spacing--60)">
	<!-- wp:comments-title {"level":2} /-->

	<!-- wp:comment-template -->
		<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--40)">
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group">
				<!-- wp:avatar {"size":40} /-->
				<!-- wp:comment-author-name /-->
				<!-- wp:comment-date {"fontSize":"small"} /-->
			</div>
			<!-- /wp:group -->
			<!-- wp:comment-content /-->
			<!-- wp:comment-reply-link {"fontSize":"small"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:comment-template -->

	<!-- wp:comments-pagination -->
		<!-- wp:comments-pagination-previous /-->
		<!-- wp:comments-pagination-numbers /-->
		<!-- wp:comments-pagination-next /-->
	<!-- /wp:comments-pagination -->

	<!-- wp:post-comments-form /-->
</div>
<!-- /wp:comments -->
