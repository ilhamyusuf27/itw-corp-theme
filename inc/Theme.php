<?php
/**
 * Theme container: registers every service once.
 *
 * To add a feature, create a class in inc/ that implements
 * Contracts\Service and append it to SERVICES.
 *
 * @package ITWCorp
 */

namespace ITWCorp;

use ITWCorp\Contracts\Service;

defined( 'ABSPATH' ) || exit;

final class Theme {

	/**
	 * Services booted with the theme, in order.
	 *
	 * @var array<class-string<Service>>
	 */
	private const SERVICES = array(
		Setup::class,
		Assets::class,
		BlockStyles::class,
		Patterns::class,
		Projects::class,
		Blog::class,
		Cleanup::class,
	);

	private static ?Theme $instance = null;

	private bool $booted = false;

	public static function instance(): self {
		return self::$instance ??= new self();
	}

	private function __construct() {}

	public function boot(): void {
		if ( $this->booted ) {
			return;
		}

		foreach ( self::SERVICES as $class ) {
			$service = new $class();

			if ( $service instanceof Service ) {
				$service->register();
			}
		}

		$this->booted = true;
	}
}
