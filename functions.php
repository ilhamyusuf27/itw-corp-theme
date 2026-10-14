<?php
/**
 * ITW Corp theme bootstrap.
 *
 * Keep this file small: it only defines constants, loads the autoloader
 * and boots the theme. All logic lives in namespaced classes under inc/.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

define( 'ITW_CORP_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );
define( 'ITW_CORP_DIR', get_template_directory() );
define( 'ITW_CORP_URI', get_template_directory_uri() );

require_once ITW_CORP_DIR . '/inc/autoload.php';

ITWCorp\Theme::instance()->boot();
