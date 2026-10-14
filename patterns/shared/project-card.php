<?php
/**
 * Title: Project card
 * Slug: itw-corp/shared-project-card
 * Inserter: no
 * Description: One project in a query loop: cover, name, and category · style · location.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:post-featured-image {"isLink":true,"sizeSlug":"large","className":"p-card__img"} /-->

<!-- wp:post-title {"level":2,"isLink":true,"className":"p-card__title"} /-->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/project","args":{"key":"kind"}}}},"className":"p-card__kind"} -->
<p class="p-card__kind"></p>
<!-- /wp:paragraph -->
