<?php
/**
 * Pattern helpers for images from the media library.
 *
 * Patterns refer to uploads by file name (e.g. "2ndf-liv") rather than by
 * attachment ID, so they keep working across local, staging and production.
 *
 * @package ITWCorp
 */

namespace ITWCorp;

defined( 'ABSPATH' ) || exit;

final class Media {

	/**
	 * @var array<string, int>
	 */
	private static array $ids = array();

	/**
	 * Attachment ID for an uploaded file name without extension, or 0.
	 */
	public static function id( string $name ): int {
		if ( isset( self::$ids[ $name ] ) ) {
			return self::$ids[ $name ];
		}

		$found = get_posts(
			array(
				'post_type'      => 'attachment',
				'post_status'    => 'inherit',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
					array(
						'key'     => '_wp_attached_file',
						'value'   => '/' . $name . '.',
						'compare' => 'LIKE',
					),
				),
			)
		);

		self::$ids[ $name ] = $found ? (int) $found[0] : 0;

		return self::$ids[ $name ];
	}

	/**
	 * Serialized core/image block for an uploaded file. Empty string if missing.
	 */
	public static function image( string $name, string $alt, string $class_name = '', string $size = 'large', string $caption = '' ): string {
		$id  = self::id( $name );
		$src = $id ? wp_get_attachment_image_url( $id, $size ) : false;

		if ( ! $src ) {
			return '';
		}

		$attrs = array(
			'id'              => $id,
			'sizeSlug'        => $size,
			'linkDestination' => 'none',
		);

		if ( $class_name ) {
			$attrs['className'] = $class_name;
		}

		$figure_class = trim( 'wp-block-image size-' . $size . ' ' . $class_name );
		$figcaption   = $caption ? '<figcaption class="wp-element-caption">' . esc_html( $caption ) . '</figcaption>' : '';

		return sprintf(
			'<!-- wp:image %1$s --><figure class="%2$s"><img src="%3$s" alt="%4$s" class="wp-image-%5$d"/>%6$s</figure><!-- /wp:image -->',
			wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES ),
			esc_attr( $figure_class ),
			esc_url( $src ),
			esc_attr( $alt ),
			$id,
			$figcaption
		);
	}
}
