<?php
/**
 * Team members: name (title), photo (featured image), role and links.
 * No public single pages; they are shown on the About page.
 *
 * @package ITWContent
 */

namespace ITWContent;

defined( 'ABSPATH' ) || exit;

const TEAM = 'team_member';

add_action( 'init', __NAMESPACE__ . '\\register_team', 9 );

function register_team(): void {
	register_post_type(
		TEAM,
		array(
			'labels'             => array(
				'name'               => __( 'Team', 'itw-content' ),
				'singular_name'      => __( 'Team member', 'itw-content' ),
				'add_new_item'       => __( 'Add team member', 'itw-content' ),
				'edit_item'          => __( 'Edit team member', 'itw-content' ),
				'all_items'          => __( 'All team members', 'itw-content' ),
				'featured_image'     => __( 'Photo', 'itw-content' ),
				'set_featured_image' => __( 'Set photo', 'itw-content' ),
			),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-groups',
			'menu_position'      => 7,
			'supports'           => array( 'title', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields' ),
		)
	);

	foreach ( array( 'itw_role', 'itw_linkedin', 'itw_instagram' ) as $key ) {
		register_post_meta(
			TEAM,
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'itw_role' === $key ? 'sanitize_text_field' : 'esc_url_raw',
				'auth_callback'     => static fn(): bool => current_user_can( 'edit_posts' ),
			)
		);
	}
}

/*
 * The title field reads "Name" for team members.
 */
add_filter(
	'enter_title_here',
	static fn( string $text, \WP_Post $post ): string => TEAM === $post->post_type ? __( 'Full name', 'itw-content' ) : $text,
	10,
	2
);

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\team_editor_assets' );

function team_editor_assets(): void {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if ( ! $screen || TEAM !== $screen->post_type ) {
		return;
	}

	wp_enqueue_script(
		'itw-content-team',
		content_url( 'mu-plugins/itw-content/team-editor.js' ),
		array( 'wp-plugins', 'wp-editor', 'wp-element', 'wp-components', 'wp-data', 'wp-core-data', 'wp-i18n' ),
		VERSION,
		true
	);
}

add_action( 'init', __NAMESPACE__ . '\\register_team_bindings' );

function register_team_bindings(): void {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}

	register_block_bindings_source(
		'itw/team',
		array(
			'label'              => __( 'Team member', 'itw-content' ),
			'uses_context'       => array( 'postId' ),
			'get_value_callback' => static function ( array $args, \WP_Block $block ): string {
				$post_id = (int) ( $block->context['postId'] ?? 0 );

				if ( ! $post_id || TEAM !== get_post_type( $post_id ) ) {
					return '';
				}

				switch ( $args['key'] ?? '' ) {
					case 'role':
						return esc_html( (string) get_post_meta( $post_id, 'itw_role', true ) );
					case 'links':
						$links = array();
						foreach ( array( 'itw_linkedin' => 'LinkedIn', 'itw_instagram' => 'Instagram' ) as $key => $label ) {
							$url = (string) get_post_meta( $post_id, $key, true );
							if ( $url ) {
								$links[] = sprintf( '<a href="%s" rel="noopener">%s</a>', esc_url( $url ), esc_html( $label ) );
							}
						}
						return implode( ' ', $links );
				}

				return '';
			},
		)
	);
}
