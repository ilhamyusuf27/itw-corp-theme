<?php
/**
 * Front-end assets and per-block stylesheets.
 *
 * @package ITWCorp
 */

namespace ITWCorp;

use ITWCorp\Contracts\Service;

defined( 'ABSPATH' ) || exit;

final class Assets implements Service {

	public function register(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend' ) );
		add_action( 'init', array( $this, 'enqueue_block_styles' ) );
	}

	public function enqueue_frontend(): void {
		wp_enqueue_style(
			'itw-corp-global',
			ITW_CORP_URI . '/assets/css/global.css',
			array(),
			self::version( 'assets/css/global.css' )
		);

		wp_enqueue_style(
			'itw-corp-home',
			ITW_CORP_URI . '/assets/css/home.css',
			array( 'itw-corp-global' ),
			self::version( 'assets/css/home.css' )
		);

		wp_enqueue_style(
			'itw-corp-contact',
			ITW_CORP_URI . '/assets/css/contact.css',
			array( 'itw-corp-home' ),
			self::version( 'assets/css/contact.css' )
		);

		wp_enqueue_style(
			'itw-corp-portfolio',
			ITW_CORP_URI . '/assets/css/portfolio.css',
			array( 'itw-corp-home' ),
			self::version( 'assets/css/portfolio.css' )
		);

		wp_enqueue_style(
			'itw-corp-services',
			ITW_CORP_URI . '/assets/css/services.css',
			array( 'itw-corp-portfolio' ),
			self::version( 'assets/css/services.css' )
		);

		wp_enqueue_style(
			'itw-corp-process',
			ITW_CORP_URI . '/assets/css/process.css',
			array( 'itw-corp-services' ),
			self::version( 'assets/css/process.css' )
		);

		wp_enqueue_style(
			'itw-corp-about',
			ITW_CORP_URI . '/assets/css/about.css',
			array( 'itw-corp-portfolio' ),
			self::version( 'assets/css/about.css' )
		);

		wp_enqueue_style(
			'itw-corp-blog',
			ITW_CORP_URI . '/assets/css/blog.css',
			array( 'itw-corp-portfolio' ),
			self::version( 'assets/css/blog.css' )
		);

		wp_enqueue_script(
			'itw-corp-theme',
			ITW_CORP_URI . '/assets/js/theme.js',
			array(),
			self::version( 'assets/js/theme.js' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}

	/**
	 * Load assets/css/blocks/{namespace}-{block}.css only on pages that
	 * render that block (front end and editor). Small files get inlined.
	 */
	public function enqueue_block_styles(): void {
		$files = glob( ITW_CORP_DIR . '/assets/css/blocks/*.css' ) ?: array();

		foreach ( $files as $file ) {
			$name  = basename( $file, '.css' );
			$parts = explode( '-', $name, 2 );

			if ( count( $parts ) !== 2 ) {
				continue;
			}

			wp_enqueue_block_style(
				$parts[0] . '/' . $parts[1],
				array(
					'handle' => 'itw-corp-' . $name,
					'src'    => ITW_CORP_URI . '/assets/css/blocks/' . $name . '.css',
					'path'   => $file,
					'ver'    => self::version( 'assets/css/blocks/' . $name . '.css' ),
				)
			);
		}
	}

	/**
	 * Cache-bust with filemtime while debugging, theme version otherwise.
	 */
	private static function version( string $relative_path ): string {
		$path = ITW_CORP_DIR . '/' . $relative_path;

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG && file_exists( $path ) ) {
			return (string) filemtime( $path );
		}

		return ITW_CORP_VERSION;
	}
}
