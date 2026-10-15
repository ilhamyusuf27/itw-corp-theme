<?php
/**
 * Services: post type, fields, editor panel, bindings and FAQ schema.
 *
 * Scope, deliverables and FAQ are written as blocks in the service content
 * (lists and Details blocks); only the starting price and the related
 * project category are fields.
 *
 * @package ITWContent
 */

namespace ITWContent;

defined( 'ABSPATH' ) || exit;

const SERVICE = 'service';

add_action( 'init', __NAMESPACE__ . '\\register_services', 9 );

function register_services(): void {
	register_post_type(
		SERVICE,
		array(
			'labels'        => array(
				'name'          => __( 'Services', 'itw-content' ),
				'singular_name' => __( 'Service', 'itw-content' ),
				'add_new_item'  => __( 'Add new service', 'itw-content' ),
				'edit_item'     => __( 'Edit service', 'itw-content' ),
				'view_item'     => __( 'View service', 'itw-content' ),
				'all_items'     => __( 'All services', 'itw-content' ),
			),
			'public'        => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-hammer',
			'menu_position' => 6,
			'has_archive'   => 'services',
			'hierarchical'  => false,
			'rewrite'       => array(
				'slug'       => 'services',
				'with_front' => false,
			),
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'page-attributes' ),
			'template'      => array(
				array( 'core/paragraph', array( 'placeholder' => __( 'Who this service is for, in two or three sentences.', 'itw-content' ) ) ),
				array( 'core/heading', array( 'content' => __( 'What is included', 'itw-content' ) ) ),
				array( 'core/list' ),
				array( 'core/heading', array( 'content' => __( 'What you receive', 'itw-content' ) ) ),
				array( 'core/list' ),
				array( 'core/heading', array( 'content' => __( 'Questions', 'itw-content' ) ) ),
				array( 'core/details', array( 'summary' => __( 'A question clients often ask', 'itw-content' ) ) ),
			),
		)
	);

	register_post_meta(
		SERVICE,
		'itw_price_from',
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
			'auth_callback'     => static fn(): bool => current_user_can( 'edit_posts' ),
		)
	);

	register_post_meta(
		SERVICE,
		'itw_project_category',
		array(
			'type'          => 'integer',
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => static fn(): bool => current_user_can( 'edit_posts' ),
		)
	);
}

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\service_editor_assets' );

function service_editor_assets(): void {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if ( ! $screen || SERVICE !== $screen->post_type ) {
		return;
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'project_category',
			'hide_empty' => false,
		)
	);

	wp_enqueue_script(
		'itw-content-service',
		content_url( 'mu-plugins/itw-content/service-editor.js' ),
		array( 'wp-plugins', 'wp-editor', 'wp-element', 'wp-components', 'wp-data', 'wp-core-data', 'wp-i18n' ),
		VERSION,
		true
	);

	wp_add_inline_script(
		'itw-content-service',
		'window.itwService = ' . wp_json_encode(
			array(
				'categories' => is_wp_error( $terms ) ? array() : array_map(
					static fn( \WP_Term $t ): array => array(
						'value' => $t->term_id,
						'label' => $t->name,
					),
					$terms
				),
			)
		) . ';',
		'before'
	);
}

add_action( 'init', __NAMESPACE__ . '\\register_service_bindings' );

function register_service_bindings(): void {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}

	register_block_bindings_source(
		'itw/service',
		array(
			'label'              => __( 'Service fact', 'itw-content' ),
			'uses_context'       => array( 'postId' ),
			'get_value_callback' => static function ( array $args, \WP_Block $block ): string {
				$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );

				if ( 'price' === ( $args['key'] ?? '' ) && SERVICE === get_post_type( $post_id ) ) {
					$price = (string) get_post_meta( $post_id, 'itw_price_from', true );
					/* translators: %s: starting price, e.g. "Rp 3 juta per m²". */
					return $price ? esc_html( sprintf( __( 'From %s', 'itw-content' ), $price ) ) : '';
				}

				return '';
			},
		)
	);
}

/*
 * FAQPage schema from the Details blocks in a service or FAQ-style page (PRD §8.2).
 */
add_action( 'wp_head', __NAMESPACE__ . '\\service_faq_schema' );

function service_faq_schema(): void {
	// Services, plus the pages whose questions are written as Details blocks.
	if ( ! is_singular( SERVICE ) && ! is_page( array( 'our-process', 'faq' ) ) ) {
		return;
	}

	$questions = array();

	$walk = static function ( array $blocks ) use ( &$walk, &$questions ): void {
		foreach ( $blocks as $block ) {
			if ( 'core/details' === $block['blockName'] ) {
				$summary = wp_strip_all_tags( $block['attrs']['summary'] ?? '' );
				$html    = render_block( $block );
				$answer  = trim( wp_strip_all_tags( preg_replace( '#<summary>.*?</summary>#s', '', $html ) ) );

				if ( '' === $summary && preg_match( '#<summary>(.*?)</summary>#s', $html, $m ) ) {
					$summary = wp_strip_all_tags( $m[1] );
				}

				if ( $summary && $answer ) {
					$questions[] = array(
						'@type'          => 'Question',
						'name'           => $summary,
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => $answer,
						),
					);
				}
			}

			if ( ! empty( $block['innerBlocks'] ) ) {
				$walk( $block['innerBlocks'] );
			}
		}
	};

	$walk( parse_blocks( (string) get_post_field( 'post_content', get_queried_object_id() ) ) );

	if ( $questions ) {
		printf(
			"<script type=\"application/ld+json\">%s</script>\n",
			wp_json_encode(
				array(
					'@context'   => 'https://schema.org',
					'@type'      => 'FAQPage',
					'mainEntity' => $questions,
				),
				JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
			)
		);
	}
}

/*
 * Services overview: all services in their set order.
 */
add_action( 'pre_get_posts', __NAMESPACE__ . '\\services_query' );

function services_query( \WP_Query $query ): void {
	if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( SERVICE ) ) {
		$query->set( 'posts_per_page', 20 );
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'date' => 'ASC' ) );
	}
}
