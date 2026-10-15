<?php
/**
 * Blog display: reading time, share links and related posts.
 *
 * - Block binding "itw/post": {"key":"reading_time"} → "4 min read",
 *   {"key":"meta"} → "12 Oct 2026 · 4 min read" for cards.
 * - A group with the class "b-share" is filled with share links
 *   (WhatsApp, Facebook, X, LinkedIn, email) for the current post.
 * - A query loop with "itwRelatedPosts": true shows posts from the same
 *   category as the current post (or the latest posts if there are none).
 *
 * @package ITWCorp
 */

namespace ITWCorp;

use ITWCorp\Contracts\Service;

defined( 'ABSPATH' ) || exit;

final class Blog implements Service {

	private const WORDS_PER_MINUTE = 200;

	public function register(): void {
		add_action( 'init', array( $this, 'register_bindings' ) );
		add_filter( 'render_block_core/group', array( $this, 'share_links' ), 10, 2 );
		add_filter( 'query_loop_block_query_vars', array( $this, 'related' ), 10, 2 );
		add_filter( 'excerpt_more', static fn(): string => '…' );
	}

	public function register_bindings(): void {
		if ( ! function_exists( 'register_block_bindings_source' ) ) {
			return;
		}

		register_block_bindings_source(
			'itw/post',
			array(
				'label'              => __( 'Post details', 'itw-corp' ),
				'uses_context'       => array( 'postId' ),
				'get_value_callback' => array( $this, 'binding' ),
			)
		);
	}

	/**
	 * @param array<string, mixed> $args
	 */
	public function binding( array $args, \WP_Block $block ): string {
		$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );

		if ( ! $post_id ) {
			return '';
		}

		switch ( $args['key'] ?? '' ) {
			case 'reading_time':
				return esc_html( self::reading_time( $post_id ) );
			case 'meta':
				return esc_html( get_the_date( 'j M Y', $post_id ) . ' · ' . self::reading_time( $post_id ) );
		}

		return '';
	}

	public static function reading_time( int $post_id ): string {
		$words   = str_word_count( wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) ) );
		$minutes = max( 1, (int) ceil( $words / self::WORDS_PER_MINUTE ) );

		/* translators: %d: minutes needed to read the article. */
		return sprintf( _n( '%d min read', '%d min read', $minutes, 'itw-corp' ), $minutes );
	}

	/**
	 * Fill <div class="… b-share"> with share links for the current post.
	 *
	 * @param array<string, mixed> $block
	 */
	public function share_links( string $html, array $block ): string {
		$class = (string) ( $block['attrs']['className'] ?? '' );

		if ( ! str_contains( " $class ", ' b-share ' ) || ! is_singular( 'post' ) ) {
			return $html;
		}

		$url   = rawurlencode( (string) get_permalink() );
		$title = rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES ) );

		$links = array(
			'WhatsApp' => "https://wa.me/?text={$title}%20{$url}",
			'Facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
			'X'        => "https://x.com/intent/post?url={$url}&text={$title}",
			'LinkedIn' => "https://www.linkedin.com/sharing/share-offsite/?url={$url}",
			'Email'    => "mailto:?subject={$title}&body={$url}",
		);

		$items = '';
		foreach ( $links as $label => $href ) {
			$items .= sprintf(
				'<a class="b-share__link" href="%1$s"%2$s>%3$s</a>',
				esc_url( $href ),
				'Email' === $label ? '' : ' target="_blank" rel="noopener"',
				esc_html( $label )
			);
		}

		$items .= sprintf( '<button type="button" class="b-share__copy" data-url="%s">%s</button>', esc_url( (string) get_permalink() ), esc_html__( 'Copy link', 'itw-corp' ) );

		// Insert the links just before the group's closing tag.
		$pos = strrpos( $html, '</div>' );

		return false === $pos ? $html : substr_replace( $html, '<p class="b-share__label">' . esc_html__( 'Share', 'itw-corp' ) . '</p><div class="b-share__links">' . $items . '</div>', $pos, 0 );
	}

	/**
	 * @param array<string, mixed> $query
	 * @return array<string, mixed>
	 */
	public function related( array $query, \WP_Block $block ): array {
		if ( empty( $block->context['query']['itwRelatedPosts'] ) || ! is_singular( 'post' ) ) {
			return $query;
		}

		$id         = get_queried_object_id();
		$categories = wp_get_post_categories( $id );

		$query['post__not_in']        = array( $id );
		$query['ignore_sticky_posts'] = true;

		$same = $categories ? get_posts(
			array(
				'category__in'   => $categories,
				'post__not_in'   => array( $id ),
				'posts_per_page' => 1,
				'fields'         => 'ids',
			)
		) : array();

		if ( $same ) {
			$query['category__in'] = $categories;
		}

		return $query;
	}
}
