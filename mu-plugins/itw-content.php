<?php
/**
 * Plugin Name: ITW Content
 * Description: Content model for itw-corp: Projects (categories, styles, locations), Services, Team and contact details. Lives outside the theme so content survives a theme change.
 * Version: 1.0.0
 * Requires PHP: 8.1
 *
 * @package ITWContent
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/itw-content/plugin.php';
require_once __DIR__ . '/itw-content/services.php';
require_once __DIR__ . '/itw-content/team.php';
require_once __DIR__ . '/itw-content/contact.php';
