<?php
/**
 * Display rules for Projects (the content model lives in mu-plugins/itw-content).
 *
 * - Query loops with a flag in their query attributes:
 *   "itwRelated" (project page: same category or style),
 *   "itwServiceProjects" (service page: the service's project category),
 *   "itwFeatured" (projects marked "Featured on homepage").
 * - Team loops: core ignores non-public post types, so set it here.
 * - Images in a project's story open in the core lightbox.
 *
 * @package ITWCorp
 */

namespace ITWCorp;

use ITWCorp\Contracts\Service;

defined( 'ABSPATH' ) || exit;

final class Projects implements Service {

	public function register(): void {
		add_filter( 'query_loop_block_query_vars', array( $this, 'related' ), 10, 2 );
		add_filter( 'render_block_data', array( $this, 'lightbox' ) );
	}

	/**
	 * @param array<string, mixed> $query
	 * @return array<string, mixed>
	 */
	public function related( array $query, \WP_Block $block ): array {
		$context = $block->context['query'] ?? array();

		// Core drops post types without public pages (Team) and falls back to posts.
		if ( 'team_member' === ( $context['postType'] ?? '' ) ) {
			$query['post_type'] = 'team_member';
			$query['orderby']   = array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			);
			return $query;
		}

		if ( ! empty( $context['itwServiceProjects'] ) ) {
			return $this->service_projects( $query );
		}

		if ( ! empty( $context['itwFeatured'] ) ) {
			return $this->featured( $query );
		}

		if ( empty( $context['itwRelated'] ) || ! is_singular( 'project' ) ) {
			return $query;
		}

		$id  = get_queried_object_id();
		$tax = array( 'relation' => 'OR' );

		foreach ( array( 'project_style', 'project_category' ) as $taxonomy ) {
			$terms = wp_get_post_terms( $id, $taxonomy, array( 'fields' => 'ids' ) );

			if ( ! is_wp_error( $terms ) && $terms ) {
				$tax[] = array(
					'taxonomy' => $taxonomy,
					'terms'    => $terms,
				);
			}
		}

		$query['post__not_in'] = array( $id );

		if ( count( $tax ) > 1 ) {
			$query['tax_query'] = $tax; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		}

		return $query;
	}

	/**
	 * Projects for a service page: its chosen category, or the latest.
	 *
	 * @param array<string, mixed> $query
	 * @return array<string, mixed>
	 */
	private function service_projects( array $query ): array {
		if ( ! is_singular( 'service' ) ) {
			return $query;
		}

		$term = get_term( (int) get_post_meta( get_queried_object_id(), 'itw_project_category', true ), 'project_category' );

		if ( $term instanceof \WP_Term && $term->count > 0 ) {
			$query['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'project_category',
					'terms'    => array( $term->term_id ),
				),
			);
		}

		return $query;
	}

	/**
	 * Projects marked "Featured on homepage", newest first.
	 *
	 * @param array<string, mixed> $query
	 * @return array<string, mixed>
	 */
	private function featured( array $query ): array {
		$query['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'   => 'itw_featured',
				'value' => '1',
			),
		);

		return $query;
	}

	/**
	 * @param array<string, mixed> $block
	 * @return array<string, mixed>
	 */
	public function lightbox( array $block ): array {
		if ( 'core/image' === ( $block['blockName'] ?? '' ) && is_singular( 'project' ) && ! isset( $block['attrs']['lightbox'] ) ) {
			$block['attrs']['lightbox'] = array( 'enabled' => true );
		}

		return $block;
	}
}
