<?php
/**
 * Custom block style variations.
 *
 * Styling for each variation lives in assets/css/blocks/{namespace}-{block}.css.
 *
 * @package ITWCorp
 */

namespace ITWCorp;

use ITWCorp\Contracts\Service;

defined( 'ABSPATH' ) || exit;

final class BlockStyles implements Service {

	public function register(): void {
		add_action( 'init', array( $this, 'register_styles' ) );
	}

	public function register_styles(): void {
		$styles = array(
			array( 'core/button', 'fill-accent', __( 'Accent', 'itw-corp' ) ),
			array( 'core/button', 'text-link', __( 'Text link', 'itw-corp' ) ),
			array( 'core/group', 'card', __( 'Card', 'itw-corp' ) ),
			array( 'core/list', 'checkmark', __( 'Checkmark', 'itw-corp' ) ),
		);

		foreach ( $styles as list( $block, $name, $label ) ) {
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
