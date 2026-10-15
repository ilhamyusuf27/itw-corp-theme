<?php
/**
 * Theme supports, text domain and editor styles.
 *
 * @package ITWCorp
 */

namespace ITWCorp;

use ITWCorp\Contracts\Service;

defined( 'ABSPATH' ) || exit;

final class Setup implements Service {

	public function register(): void {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
	}

	public function setup(): void {
		load_theme_textdomain( 'itw-corp', ITW_CORP_DIR . '/languages' );

		add_theme_support( 'editor-styles' );
		add_editor_style( array( 'assets/css/global.css', 'assets/css/home.css', 'assets/css/contact.css', 'assets/css/portfolio.css', 'assets/css/services.css', 'assets/css/process.css', 'assets/css/about.css', 'assets/css/blog.css', 'assets/css/editor.css' ) );

		// Show only this theme's curated patterns, not the core defaults.
		remove_theme_support( 'core-block-patterns' );
	}
}
