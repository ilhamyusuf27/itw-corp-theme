<?php
/**
 * Title: Portfolio
 * Slug: itw-corp/layout-portfolio
 * Inserter: no
 * Description: The project archive: a short heading, filters by category, style and location, and an uneven grid with "Load more".
 *
 * Filters are plain GET links to /portfolio/?project_style=… so they work
 * without script; assets/js/theme.js swaps the grid in place (no reload).
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_filters = array(
	'project_category' => __( 'All categories', 'itw-corp' ),
	'project_style'    => __( 'All styles', 'itw-corp' ),
	'project_location' => __( 'All locations', 'itw-corp' ),
);

$itw_current = static function ( string $taxonomy ): string {
	$queried = get_queried_object();

	if ( $queried instanceof WP_Term && $queried->taxonomy === $taxonomy ) {
		return $queried->slug;
	}

	return sanitize_title( (string) get_query_var( $taxonomy ) );
};
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-head","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-head">
	<!-- wp:heading {"level":1,"className":"p-head__title"} -->
	<h1 class="wp-block-heading p-head__title"><?php esc_html_e( 'Portfolio', 'itw-corp' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"p-head__lead"} -->
	<p class="p-head__lead"><?php esc_html_e( 'Homes, workplaces and places to stay, designed and built by one team.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:html -->
	<form class="p-filter" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'project' ) ?: home_url( '/portfolio/' ) ); ?>" aria-label="<?php esc_attr_e( 'Filter projects', 'itw-corp' ); ?>">
		<?php
		foreach ( $itw_filters as $itw_tax => $itw_all ) :
			$itw_terms = get_terms(
				array(
					'taxonomy'   => $itw_tax,
					'hide_empty' => true,
				)
			);

			if ( is_wp_error( $itw_terms ) || ! $itw_terms ) {
				continue;
			}

			$itw_selected = $itw_current( $itw_tax );
			?>
		<label class="p-filter__item">
			<span class="screen-reader-text"><?php echo esc_html( get_taxonomy( $itw_tax )->labels->singular_name ); ?></span>
			<select name="<?php echo esc_attr( $itw_tax ); ?>">
				<option value=""><?php echo esc_html( $itw_all ); ?></option>
				<?php foreach ( $itw_terms as $itw_term ) : ?>
				<option value="<?php echo esc_attr( $itw_term->slug ); ?>" <?php selected( $itw_selected, $itw_term->slug ); ?>><?php echo esc_html( $itw_term->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</label>
		<?php endforeach; ?>
		<button type="submit" class="p-filter__go"><?php esc_html_e( 'Show projects', 'itw-corp' ); ?></button>
	</form>
	<!-- /wp:html -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"p-list","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull p-list">
	<!-- wp:query {"queryId":21,"query":{"inherit":true,"perPage":9,"postType":"project"},"className":"p-query"} -->
	<div class="wp-block-query p-query">
		<!-- wp:post-template {"className":"p-grid"} -->
			<!-- wp:pattern {"slug":"itw-corp/shared-project-card"} /-->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","className":"p-more","layout":{"type":"flex","justifyContent":"center"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-next {"label":"<?php esc_attr_e( 'More projects', 'itw-corp' ); ?>"} /-->
		<!-- /wp:query-pagination -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"className":"p-empty"} -->
			<p class="p-empty"><?php esc_html_e( 'No projects match these filters yet.', 'itw-corp' ); ?> <a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'See all projects', 'itw-corp' ); ?></a></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"itw-corp/shared-project-reply-card"} /-->
