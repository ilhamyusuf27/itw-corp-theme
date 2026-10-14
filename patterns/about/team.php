<?php
/**
 * Title: About: the team
 * Slug: itw-corp/about-team
 * Categories: itw-corp-about, team
 * Keywords: team, people, staff
 * Viewport Width: 1440
 * Description: Everyone under Team in the dashboard, in their set order: photo, name and role. The section stays hidden until the first team member is published.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec a-team","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec a-team">
	<!-- wp:heading {"className":"a-team__title"} -->
	<h2 class="wp-block-heading a-team__title"><?php esc_html_e( 'The people', 'itw-corp' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":41,"query":{"perPage":24,"pages":0,"offset":0,"postType":"team_member","order":"asc","orderBy":"menu_order","inherit":false}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"a-team__grid"} -->
			<!-- wp:post-featured-image {"sizeSlug":"medium_large","className":"a-person__photo"} /-->

			<!-- wp:post-title {"level":3,"className":"a-person__name"} /-->

			<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/team","args":{"key":"role"}}}},"className":"a-person__role"} -->
			<p class="a-person__role"></p>
			<!-- /wp:paragraph -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
