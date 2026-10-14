<?php
/**
 * Title: Post card
 * Slug: itw-corp/blog-post-card
 * Categories: itw-corp-shared
 * Inserter: no
 * Description: One article in a query loop: picture, title, date and reading time, and a short excerpt.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:post-featured-image {"isLink":true,"sizeSlug":"large","className":"b-card__img"} /-->

<!-- wp:group {"className":"b-card__text","layout":{"type":"default"}} -->
<div class="wp-block-group b-card__text">
	<!-- wp:post-title {"level":2,"isLink":true,"className":"b-card__title"} /-->

	<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/post","args":{"key":"meta"}}}},"className":"b-card__meta"} -->
	<p class="b-card__meta"></p>
	<!-- /wp:paragraph -->

	<!-- wp:post-excerpt {"excerptLength":22,"className":"b-card__excerpt"} /-->
</div>
<!-- /wp:group -->
