<?php
/**
 * Title: Blog list
 * Slug: itw-corp/layout-blog
 * Categories: itw-corp-shared
 * Inserter: no
 * Description: Insights, category, tag, author and search lists: heading, category links, the newest article large, then a grid, pagination and the reply card.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_blog_url = get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' );
$itw_current  = is_category() ? (int) get_queried_object_id() : 0;
$itw_cats     = get_categories(
	array(
		'hide_empty' => true,
		'exclude'    => array( (int) get_option( 'default_category' ) ),
	)
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-head b-head","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-head b-head">
	<?php if ( is_home() ) : ?>
	<!-- wp:heading {"level":1,"className":"p-head__title"} -->
	<h1 class="wp-block-heading p-head__title"><?php esc_html_e( 'Insights', 'itw-corp' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"p-head__lead"} -->
	<p class="p-head__lead"><?php esc_html_e( 'Notes on light, materials and living well, from the people who design and build our rooms.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->
	<?php elseif ( is_search() ) : ?>
	<!-- wp:query-title {"type":"search","level":1,"className":"p-head__title b-head__title--small"} /-->
	<?php else : ?>
	<!-- wp:query-title {"type":"archive","showPrefix":false,"level":1,"className":"p-head__title"} /-->

	<!-- wp:term-description {"className":"p-head__lead"} /-->
	<?php endif; ?>

	<?php if ( $itw_cats && ! is_search() ) : ?>
	<!-- wp:html -->
	<nav class="b-cats" aria-label="<?php esc_attr_e( 'Article categories', 'itw-corp' ); ?>">
		<a href="<?php echo esc_url( $itw_blog_url ); ?>"<?php echo is_home() ? ' aria-current="page"' : ''; ?>><?php esc_html_e( 'All articles', 'itw-corp' ); ?></a>
		<?php foreach ( $itw_cats as $itw_cat ) : ?>
		<a href="<?php echo esc_url( get_category_link( $itw_cat ) ); ?>"<?php echo $itw_current === $itw_cat->term_id ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $itw_cat->name ); ?></a>
		<?php endforeach; ?>
	</nav>
	<!-- /wp:html -->
	<?php endif; ?>
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"b-list","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull b-list">
	<!-- wp:query {"queryId":51,"query":{"inherit":true,"perPage":10},"className":"b-query"} -->
	<div class="wp-block-query b-query">
		<!-- wp:post-template {"className":"b-grid<?php echo is_paged() ? '' : ' b-grid--lead'; ?>"} -->
			<!-- wp:pattern {"slug":"itw-corp/blog-post-card"} /-->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","className":"p-more b-pages","layout":{"type":"flex","justifyContent":"space-between"}} -->
			<!-- wp:query-pagination-previous {"label":"<?php esc_attr_e( 'Newer articles', 'itw-corp' ); ?>"} /-->
			<!-- wp:query-pagination-next {"label":"<?php esc_attr_e( 'Older articles', 'itw-corp' ); ?>"} /-->
		<!-- /wp:query-pagination -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"className":"p-empty"} -->
			<p class="p-empty"><?php esc_html_e( 'Nothing here yet.', 'itw-corp' ); ?> <a href="<?php echo esc_url( $itw_blog_url ); ?>"><?php esc_html_e( 'See all articles', 'itw-corp' ); ?></a></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"itw-corp/shared-reply-card"} /-->
