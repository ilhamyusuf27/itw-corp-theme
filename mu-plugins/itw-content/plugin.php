<?php
/**
 * Projects: post type, taxonomies, fields, editor panel and block bindings.
 *
 * @package ITWContent
 */

namespace ITWContent;

defined( 'ABSPATH' ) || exit;

const POST_TYPE = 'project';
const VERSION   = '1.1.0';

/**
 * Project fields (post meta). Story, gallery and video are written as blocks
 * in the project content; these are the facts shown in the project header.
 */
function fields(): array {
	return array(
		'itw_year'       => array( 'type' => 'integer', 'label' => __( 'Year', 'itw-content' ) ),
		'itw_area'       => array( 'type' => 'number', 'label' => __( 'Area (m²)', 'itw-content' ) ),
		'itw_duration'   => array( 'type' => 'string', 'label' => __( 'Duration', 'itw-content' ) ),
		'itw_scope'      => array( 'type' => 'array', 'label' => __( 'Scope of work', 'itw-content' ) ),
		'itw_quote'      => array( 'type' => 'string', 'label' => __( 'Client quote', 'itw-content' ) ),
		'itw_quote_by'   => array( 'type' => 'string', 'label' => __( 'Quote by', 'itw-content' ) ),
		'itw_featured'   => array( 'type' => 'boolean', 'label' => __( 'Featured on homepage', 'itw-content' ) ),
	);
}

/**
 * Scope of work options (PRD §10).
 */
function scope_options(): array {
	return array(
		__( 'Interior design', 'itw-content' ),
		__( '3D visualisation', 'itw-content' ),
		__( 'Build and installation', 'itw-content' ),
		__( 'Custom furniture', 'itw-content' ),
		__( 'Renovation', 'itw-content' ),
		__( 'Styling', 'itw-content' ),
	);
}

add_action( 'init', __NAMESPACE__ . '\\register_content' );

function register_content(): void {
	// Taxonomies first, so /portfolio/style/… is matched before /portfolio/{project}/.
	$taxonomies = array(
		'project_category' => array( __( 'Categories', 'itw-content' ), __( 'Category', 'itw-content' ), 'portfolio/category', true ),
		'project_style'    => array( __( 'Styles', 'itw-content' ), __( 'Style', 'itw-content' ), 'portfolio/style', false ),
		'project_location' => array( __( 'Locations', 'itw-content' ), __( 'Location', 'itw-content' ), 'portfolio/location', false ),
	);

	foreach ( $taxonomies as $taxonomy => $t ) {
		register_taxonomy(
			$taxonomy,
			POST_TYPE,
			array(
				'labels'            => array(
					'name'          => $t[0],
					'singular_name' => $t[1],
				),
				'hierarchical'      => $t[3],
				'public'            => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'query_var'         => $taxonomy,
				'rewrite'           => array(
					'slug'       => $t[2],
					'with_front' => false,
				),
			)
		);
	}

	register_post_type(
		POST_TYPE,
		array(
			'labels'        => array(
				'name'               => __( 'Projects', 'itw-content' ),
				'singular_name'      => __( 'Project', 'itw-content' ),
				'add_new_item'       => __( 'Add new project', 'itw-content' ),
				'edit_item'          => __( 'Edit project', 'itw-content' ),
				'view_item'          => __( 'View project', 'itw-content' ),
				'all_items'          => __( 'All projects', 'itw-content' ),
				'search_items'       => __( 'Search projects', 'itw-content' ),
				'not_found'          => __( 'No projects found.', 'itw-content' ),
				'featured_image'     => __( 'Cover image', 'itw-content' ),
				'set_featured_image' => __( 'Set cover image', 'itw-content' ),
			),
			'public'        => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-admin-home',
			'menu_position' => 5,
			'has_archive'   => 'portfolio',
			'rewrite'       => array(
				'slug'       => 'portfolio',
				'with_front' => false,
			),
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'author' ),
			// New projects start with the story and a gallery in place.
			'template'      => array(
				array( 'core/paragraph', array( 'placeholder' => __( 'The brief: who the client is and what they asked for.', 'itw-content' ) ) ),
				array( 'core/heading', array( 'content' => __( 'The challenge', 'itw-content' ) ) ),
				array( 'core/paragraph', array( 'placeholder' => __( 'What made this project difficult or interesting.', 'itw-content' ) ) ),
				array( 'core/heading', array( 'content' => __( 'The solution', 'itw-content' ) ) ),
				array( 'core/paragraph', array( 'placeholder' => __( 'What we designed and built, and why.', 'itw-content' ) ) ),
				array( 'core/gallery', array( 'linkTo' => 'none' ) ),
			),
		)
	);

	foreach ( fields() as $key => $field ) {
		$args = array(
			'type'              => $field['type'],
			'single'            => true,
			'show_in_rest'      => true,
			'auth_callback'     => static fn(): bool => current_user_can( 'edit_posts' ),
			'sanitize_callback' => null,
		);

		if ( 'array' === $field['type'] ) {
			$args['show_in_rest'] = array( 'schema' => array( 'type' => 'array', 'items' => array( 'type' => 'string' ) ) );
			$args['default']      = array();
		}

		if ( 'string' === $field['type'] ) {
			$args['sanitize_callback'] = 'sanitize_text_field';
		}

		register_post_meta( POST_TYPE, $key, $args );
	}
}

/*
 * Editor: a "Project details" panel in the document sidebar.
 */
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\editor_assets' );

function editor_assets(): void {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if ( ! $screen || POST_TYPE !== $screen->post_type ) {
		return;
	}

	wp_enqueue_script(
		'itw-content-editor',
		content_url( 'mu-plugins/itw-content/editor.js' ),
		array( 'wp-plugins', 'wp-editor', 'wp-element', 'wp-components', 'wp-data', 'wp-core-data', 'wp-i18n' ),
		VERSION,
		true
	);

	wp_add_inline_script(
		'itw-content-editor',
		'window.itwProject = ' . wp_json_encode( array( 'scope' => scope_options() ) ) . ';',
		'before'
	);
}

/*
 * Block bindings: lets theme templates show project facts in a paragraph,
 * e.g. {"source":"itw/project","args":{"key":"area"}} → "220 m²".
 */
add_action( 'init', __NAMESPACE__ . '\\register_bindings' );

function register_bindings(): void {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}

	register_block_bindings_source(
		'itw/project',
		array(
			'label'              => __( 'Project fact', 'itw-content' ),
			'uses_context'       => array( 'postId' ),
			'get_value_callback' => __NAMESPACE__ . '\\fact',
		)
	);
}

/**
 * One formatted project fact. Empty string when the fact is not set.
 */
function fact( array $args, \WP_Block $block ): string {
	$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );
	$key     = $args['key'] ?? '';

	if ( ! $post_id || POST_TYPE !== get_post_type( $post_id ) ) {
		return '';
	}

	$terms = static function ( string $taxonomy ) use ( $post_id ): string {
		$list = get_the_terms( $post_id, $taxonomy );
		return is_array( $list ) ? implode( ', ', wp_list_pluck( $list, 'name' ) ) : '';
	};

	switch ( $key ) {
		case 'category':
			return esc_html( $terms( 'project_category' ) );
		case 'style':
			return esc_html( $terms( 'project_style' ) );
		case 'location':
			return esc_html( $terms( 'project_location' ) );
		case 'kind':
			// "Residential · Japandi · Bandung" for cards.
			return esc_html( implode( ' · ', array_filter( array( $terms( 'project_category' ), $terms( 'project_style' ), $terms( 'project_location' ) ) ) ) );
		case 'year':
			$year = (int) get_post_meta( $post_id, 'itw_year', true );
			return $year ? (string) $year : '';
		case 'area':
			$area = (float) get_post_meta( $post_id, 'itw_area', true );
			return $area ? esc_html( number_format_i18n( $area, floor( $area ) === $area ? 0 : 1 ) . ' m²' ) : '';
		case 'duration':
			return esc_html( (string) get_post_meta( $post_id, 'itw_duration', true ) );
		case 'scope':
			$scope = get_post_meta( $post_id, 'itw_scope', true );
			return is_array( $scope ) ? esc_html( implode( ', ', $scope ) ) : '';
		case 'quote':
			$quote = (string) get_post_meta( $post_id, 'itw_quote', true );
			return $quote ? esc_html( '“' . trim( $quote, '“”" ' ) . '”' ) : '';
		case 'quote_by':
			return esc_html( (string) get_post_meta( $post_id, 'itw_quote_by', true ) );
	}

	return '';
}

/*
 * Portfolio archive: 9 per page, newest first; featured projects first.
 */
add_action( 'pre_get_posts', __NAMESPACE__ . '\\portfolio_query' );

function portfolio_query( \WP_Query $query ): void {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_post_type_archive( POST_TYPE ) || $query->is_tax( array( 'project_category', 'project_style', 'project_location' ) ) ) {
		$query->set( 'posts_per_page', 9 );
	}
}

/*
 * Flush rewrite rules once after this plugin's version changes.
 */
add_action( 'init', __NAMESPACE__ . '\\maybe_flush', 99 );

function maybe_flush(): void {
	if ( get_option( 'itw_content_version' ) !== VERSION ) {
		flush_rewrite_rules( false );
		update_option( 'itw_content_version', VERSION );
	}
}
