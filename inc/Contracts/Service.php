<?php
/**
 * Contract for every theme service.
 *
 * @package ITWCorp
 */

namespace ITWCorp\Contracts;

defined( 'ABSPATH' ) || exit;

interface Service {

	/**
	 * Hook the service into WordPress.
	 */
	public function register(): void;
}
