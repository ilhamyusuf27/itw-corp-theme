<?php
/**
 * PSR-4 style autoloader: ITWCorp\Foo\Bar → inc/Foo/Bar.php
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

spl_autoload_register(
	static function ( string $class ): void {
		$prefix = 'ITWCorp\\';

		if ( ! str_starts_with( $class, $prefix ) ) {
			return;
		}

		$relative = str_replace( '\\', '/', substr( $class, strlen( $prefix ) ) );
		$file     = __DIR__ . '/' . $relative . '.php';

		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}
);
