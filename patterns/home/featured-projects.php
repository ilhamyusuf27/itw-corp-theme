<?php
/**
 * Title: Home: featured projects
 * Slug: itw-corp/home-featured-projects
 * Categories: itw-corp-home, gallery
 * Keywords: portfolio, projects, work, featured, rooms
 * Viewport Width: 1440
 * Description: Six projects marked "Featured on homepage", on a tan field, in an uneven grid.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","anchor":"projects","align":"full","className":"h-sec h-work","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec h-work" id="projects">
	<!-- wp:group {"className":"h-work__head","layout":{"type":"default"}} -->
	<div class="wp-block-group h-work__head">
		<!-- wp:heading {"className":"h-work__title"} -->
		<h2 class="wp-block-heading h-work__title"><?php esc_html_e( 'Our rooms', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"h-work__all"} -->
		<p class="h-work__all"><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'All projects', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":12,"query":{"perPage":6,"pages":0,"offset":0,"postType":"project","order":"desc","orderBy":"date","inherit":false,"itwFeatured":true},"className":"p-query h-work__query"} -->
	<div class="wp-block-query p-query h-work__query">
		<!-- wp:post-template {"className":"p-grid p-grid--home"} -->
			<!-- wp:pattern {"slug":"itw-corp/shared-project-card"} /-->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
