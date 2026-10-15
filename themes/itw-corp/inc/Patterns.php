<?php
/**
 * Pattern categories. Pattern files in patterns/ (and its subfolders) are
 * auto-registered by core; see patterns/README.md for the layout.
 *
 * @package ITWCorp
 */

namespace ITWCorp;

use ITWCorp\Contracts\Service;

defined( 'ABSPATH' ) || exit;

final class Patterns implements Service {

	public function register(): void {
		add_action( 'init', array( $this, 'register_categories' ) );
	}

	/**
	 * One inserter category per pattern folder (see patterns/README.md).
	 */
	public function register_categories(): void {
		$categories = array(
			'itw-corp-pages'   => array( __( 'ITW · Full pages', 'itw-corp' ), __( 'Whole page layouts, ready to insert into an empty page.', 'itw-corp' ) ),
			'itw-corp-home'    => array( __( 'ITW · Home', 'itw-corp' ), __( 'Sections of the home page.', 'itw-corp' ) ),
			'itw-corp-contact' => array( __( 'ITW · Contact', 'itw-corp' ), __( 'Sections of the contact page.', 'itw-corp' ) ),
			'itw-corp-process' => array( __( 'ITW · Process', 'itw-corp' ), __( 'Sections of the Our Process page.', 'itw-corp' ) ),
			'itw-corp-about'   => array( __( 'ITW · About', 'itw-corp' ), __( 'Sections of the About page.', 'itw-corp' ) ),
			'itw-corp-shared'  => array( __( 'ITW · Shared', 'itw-corp' ), __( 'Sections used on several pages.', 'itw-corp' ) ),
			'itw-corp-starter' => array( __( 'ITW · Starter (unused)', 'itw-corp' ), __( 'Original scaffold sections, kept for reference.', 'itw-corp' ) ),
		);

		foreach ( $categories as $slug => $category ) {
			register_block_pattern_category(
				$slug,
				array(
					'label'       => $category[0],
					'description' => $category[1],
				)
			);
		}
	}
}
