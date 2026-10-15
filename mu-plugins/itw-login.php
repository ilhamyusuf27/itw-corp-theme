<?php
/**
 * Plugin Name: ITW Login
 * Description: A private login address (wp-login.php and wp-admin show "not found" to visitors) and a login page in the itw-corp style.
 * Version: 1.0.0
 * Requires PHP: 8.1
 *
 * The login address is /{slug}/, where the slug comes from the ITW_LOGIN_SLUG
 * constant (wp-config.php) or the "itw_login_slug" option.
 *
 * Locked out? Either:
 *   - add  define( 'ITW_LOGIN_DISABLE', true );  to wp-config.php, or
 *   - run  wp option get itw_login_slug  to read the address, or
 *   - delete this file (wp-content/mu-plugins/itw-login.php).
 *
 * @package ITWLogin
 */

namespace ITWLogin;

defined( 'ABSPATH' ) || exit;

/**
 * The private login slug, or '' when the feature is off.
 */
function slug(): string {
	if ( defined( 'ITW_LOGIN_DISABLE' ) && ITW_LOGIN_DISABLE ) {
		return '';
	}

	$slug = defined( 'ITW_LOGIN_SLUG' ) ? (string) ITW_LOGIN_SLUG : (string) get_option( 'itw_login_slug', '' );

	return sanitize_title( $slug );
}

function login_url( ?string $scheme = null ): string {
	return home_url( '/' . slug() . '/', $scheme );
}

/**
 * Path of the current request, without the site's sub-folder and slashes.
 */
function request_path(): string {
	$path = (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$base = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );

	if ( $base && '/' !== $base && str_starts_with( $path, $base ) ) {
		$path = substr( $path, strlen( $base ) );
	}

	return trim( rawurldecode( $path ), '/' );
}

/**
 * Send visitors who looked for the default login somewhere unremarkable:
 * the site's normal "page not found".
 */
function not_found(): void {
	nocache_headers();
	wp_safe_redirect( home_url( '/404/' ), 302 );
	exit;
}

if ( '' !== slug() && ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	add_action( 'plugins_loaded', __NAMESPACE__ . '\\route', 1 );
	add_action( 'wp_loaded', __NAMESPACE__ . '\\guard' );

	// Every generated login link points at the private address.
	add_filter( 'site_url', __NAMESPACE__ . '\\rewrite_url', 10, 3 );
	add_filter( 'network_site_url', __NAMESPACE__ . '\\rewrite_url', 10, 3 );
	add_filter( 'wp_redirect', __NAMESPACE__ . '\\rewrite_url', 10, 1 );
	add_filter( 'login_url', __NAMESPACE__ . '\\rewrite_url', 10, 1 );
	add_filter( 'logout_url', __NAMESPACE__ . '\\rewrite_url', 10, 1 );
	add_filter( 'lostpassword_url', __NAMESPACE__ . '\\rewrite_url', 10, 1 );
	add_filter( 'register_url', __NAMESPACE__ . '\\rewrite_url', 10, 1 );

	// No /login, /admin or /dashboard shortcuts that would reveal it.
	add_action(
		'init',
		static function (): void {
			remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );
		}
	);
}

/**
 * Mark which kind of request this is, before WordPress decides what to load.
 */
function route(): void {
	global $pagenow;

	$path = request_path();

	if ( slug() === $path ) {
		// The private address: serve the login screen.
		$pagenow                     = 'wp-login.php'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride
		$GLOBALS['itw_login_screen'] = true;
		return;
	}

	if ( str_ends_with( $path, 'wp-login.php' ) || 'wp-signup.php' === basename( $path ) ) {
		$action = sanitize_key( $_GET['action'] ?? '' ); // phpcs:ignore WordPress.Security.NonceVerification

		// Password-protected posts still post to wp-login.php?action=postpass.
		if ( 'postpass' !== $action ) {
			$GLOBALS['itw_login_blocked'] = true;
		}
	}
}

/**
 * Serve or refuse, once WordPress is loaded but before any screen is drawn.
 */
function guard(): void {
	global $pagenow;

	if ( ! empty( $GLOBALS['itw_login_blocked'] ) ) {
		not_found();
	}

	// Logged-out visitors to /wp-admin/ (except AJAX and form handlers).
	if ( is_admin() && ! is_user_logged_in() && ! wp_doing_ajax() && ! in_array( $pagenow, array( 'admin-post.php', 'admin-ajax.php' ), true ) ) {
		not_found();
	}

	if ( ! empty( $GLOBALS['itw_login_screen'] ) ) {
		// wp-login.php expects these in the global scope.
		global $error, $interim_login, $action, $user_login;

		// Keep a trailing slash so relative form actions stay on this address.
		if ( ! str_ends_with( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			$query = isset( $_SERVER['QUERY_STRING'] ) && '' !== $_SERVER['QUERY_STRING'] ? '?' . wp_unslash( $_SERVER['QUERY_STRING'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			wp_safe_redirect( login_url() . $query );
			exit;
		}

		require_once ABSPATH . 'wp-login.php';
		exit;
	}
}

/**
 * Replace wp-login.php in a URL with the private address, keeping the query.
 */
function rewrite_url( string $url, string $path = '', ?string $scheme = null ): string {
	if ( ! str_contains( $url, 'wp-login.php' ) ) {
		return $url;
	}

	// Leave password-protected post forms alone; they are allowed through.
	if ( str_contains( $url, 'action=postpass' ) ) {
		return $url;
	}

	$query = (string) wp_parse_url( $url, PHP_URL_QUERY );

	return login_url( $scheme ) . ( '' !== $query ? '?' . $query : '' );
}

/*
 * ---------------------------------------------------------------------
 * The login screen in the itw-corp style.
 * ---------------------------------------------------------------------
 */

add_filter( 'login_headerurl', static fn(): string => home_url( '/' ) );
add_filter( 'login_headertext', static fn(): string => get_bloginfo( 'name' ) );
add_filter( 'login_display_language_dropdown', '__return_false' );
add_action( 'login_enqueue_scripts', __NAMESPACE__ . '\\styles' );

/**
 * A render from the media library for the picture side, if one exists.
 */
function picture(): string {
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
					'value'   => '/2ndf-liv.',
					'compare' => 'LIKE',
				),
			),
		)
	);

	return $found ? (string) wp_get_attachment_image_url( (int) $found[0], 'full' ) : '';
}

function styles(): void {
	$fonts = get_theme_file_uri( 'assets/fonts/' );
	$image = picture();

	$css = <<<CSS
@font-face { font-family: "Sentient"; src: url("{$fonts}sentient-300.woff2") format("woff2"); font-weight: 300; font-display: swap; }
@font-face { font-family: "Sentient"; src: url("{$fonts}sentient-400.woff2") format("woff2"); font-weight: 400; font-display: swap; }
@font-face { font-family: "Sentient"; src: url("{$fonts}sentient-500.woff2") format("woff2"); font-weight: 500; font-display: swap; }

:root {
	--paper: #f1f0ed;
	--sand: #e6e3de;
	--walnut: #2b2216;
	--soft: #6f6354;
	--tan: #bda38b;
}

/* Two halves: the room on the left, edge to edge; the form on the right. */
body.login {
	display: flex;
	min-height: 100vh;
	margin: 0;
	background: var(--paper);
	color: var(--walnut);
	font-family: Sentient, Georgia, "Times New Roman", serif;
	font-size: 16px;
}

body.login::before {
	content: "";
	position: sticky;
	top: 0;
	flex: 0 0 50%;
	height: 100vh;
	background: var(--sand) url("{$image}") 50% 60% / cover no-repeat;
}

/* The right half: name at the top, form in the middle, way back at the bottom. */
#login {
	box-sizing: border-box;
	display: flex;
	flex-direction: column;
	flex: 1;
	width: auto;
	max-width: none;
	min-height: 100vh;
	margin: 0;
	padding: 40px clamp(24px, 6vw, 96px);
}

#login > * {
	box-sizing: border-box;
	width: 100%;
	max-width: 360px;
	margin-inline: auto;
}

/* Keep the reading order: name, heading and form, notes, links. */
.login h1 { order: 1; }
.login form { order: 2; }
.login .message,
.login .notice,
.login .success,
.login #login_error { order: 3; }
.login #nav { order: 4; }
.login .privacy-policy-page-link { order: 5; }
.login #backtoblog { order: 6; }

.login h1 {
	margin-bottom: auto;
	text-align: left;
}

.login h1 a {
	width: auto;
	height: auto;
	margin: 0;
	background: none;
	color: var(--walnut);
	font-size: 18px;
	font-weight: 500;
	line-height: 1.2;
	text-indent: 0;
	text-decoration: none;
	overflow: visible;
}

.login h1 a:focus {
	box-shadow: none;
	outline: 2px solid var(--walnut);
	outline-offset: 4px;
}

/* The heading belongs to the form. */
#loginform::before,
#lostpasswordform::before,
#resetpassform::before {
	content: "Welcome back.";
	display: block;
	margin-bottom: 32px;
	color: var(--walnut);
	font-size: 48px;
	font-weight: 300;
	line-height: 1;
	letter-spacing: -0.035em;
}

#lostpasswordform::before,
#resetpassform::before {
	content: "Reset your password.";
}

.login form {
	margin: 0;
	padding: 0;
	border: 0;
	background: none;
	box-shadow: none;
	overflow: visible;
}

/* Core sets these margins with more specific rules; hold the rhythm here. */
.login form > p,
.login form > .user-pass-wrap {
	margin: 0 0 22px !important;
}

.login form > p.submit {
	margin-bottom: 0 !important;
}

.login label {
	display: block;
	margin-bottom: 8px;
	color: var(--soft);
	font-size: 15px;
	line-height: 1.3;
}

.login form .input,
.login input[type="text"],
.login input[type="password"],
.login input[type="email"] {
	box-sizing: border-box;
	width: 100%;
	min-height: 50px;
	margin: 0;
	padding: 12px 16px;
	border: 1px solid transparent;
	border-radius: 8px;
	background: var(--sand);
	color: var(--walnut);
	font-family: inherit;
	font-size: 16px;
	box-shadow: none;
	transition: border-color 200ms ease, background-color 200ms ease;
}

.login form .input:hover {
	border-color: #d8cebf;
}

.login form .input:focus,
.login input:focus {
	border-color: var(--walnut);
	background: var(--sand);
	outline: none;
	box-shadow: none;
}

.login .wp-pwd {
	position: relative;
}

.login .button.wp-hide-pw {
	top: 0;
	right: 4px;
	height: 50px;
	min-height: 0;
	margin: 0;
	border: 0;
	background: none;
	color: var(--soft);
	box-shadow: none;
}

.login .button.wp-hide-pw:hover,
.login .button.wp-hide-pw:focus {
	color: var(--walnut);
	background: none;
	box-shadow: none;
}

.login .button.wp-hide-pw .dashicons {
	top: 0.4rem;
}

/* "Remember me" and its help toggle, in the page's quiet ink. */
.login .forgetmenot {
	display: flex;
	align-items: center;
	gap: 10px;
	float: none;
	margin: 4px 0 28px;
}

.login .forgetmenot label {
	display: inline;
	margin: 0;
	color: var(--walnut);
	font-size: 15px;
}

.login input[type="checkbox"] {
	width: 18px;
	height: 18px;
	margin: 0;
	border: 1px solid var(--tan);
	border-radius: 4px;
	background: #fff;
	box-shadow: none;
	accent-color: var(--walnut);
}

.login input[type="checkbox"]:checked {
	border-color: var(--walnut);
	background: var(--walnut);
}

.login input[type="checkbox"]:checked::before {
	filter: brightness(0) invert(1);
	margin: -2px 0 0 -2px;
}

.login .wp-tooltip__toggle {
	color: var(--tan);
}

.login .wp-tooltip__toggle:hover,
.login .wp-tooltip__toggle:focus {
	color: var(--walnut);
}

.login .wp-tooltip__bubble {
	border-radius: 8px;
	background: var(--walnut);
	color: var(--paper);
}

.login .submit {
	float: none;
	margin: 0;
}

.login .button-primary,
.wp-core-ui .button-primary {
	float: none;
	width: 100%;
	min-height: 52px;
	margin: 0;
	border: 0;
	border-radius: 999px;
	background: var(--walnut);
	color: var(--paper);
	font-family: inherit;
	font-size: 16px;
	font-weight: 500;
	text-shadow: none;
	box-shadow: none;
	transition: background-color 200ms ease, color 200ms ease;
}

.login .button-primary:hover,
.login .button-primary:focus {
	background: var(--tan);
	color: var(--walnut);
	box-shadow: none;
}

.login .button-primary:focus-visible {
	outline: 2px solid var(--walnut);
	outline-offset: 3px;
}

.login #nav {
	margin: 20px auto 0;
	padding: 0;
	font-size: 15px;
	text-align: center;
}

.login #backtoblog {
	margin: auto auto 0;
	padding: 32px 0 0;
	font-size: 15px;
}

.login #nav a,
.login #backtoblog a,
.login .privacy-policy-page-link a {
	color: var(--soft);
	text-decoration: underline;
	text-decoration-color: #d8cebf;
	text-underline-offset: 0.25em;
}

.login #nav a:hover,
.login #backtoblog a:hover {
	color: var(--walnut);
	text-decoration-color: currentColor;
}

.login .message,
.login .notice,
.login .success,
.login #login_error {
	margin: 20px auto 0;
	padding: 14px 16px;
	border: 0;
	border-radius: 8px;
	background: var(--sand);
	color: var(--walnut);
	font-size: 15px;
	line-height: 1.5;
	box-shadow: none;
}

.login #login_error {
	background: #f3e3dc;
}

.login #login_error a {
	color: var(--walnut);
}

.login .privacy-policy-page-link {
	margin: 16px auto 0;
	text-align: left;
}

/* Phones: the room becomes a band across the top. */
@media (max-width: 782px) {
	body.login {
		flex-direction: column;
	}

	body.login::before {
		position: static;
		flex: 0 0 auto;
		height: 30vh;
	}

	#login {
		min-height: 0;
		padding: 28px 24px 32px;
	}

	.login h1 {
		margin-bottom: 36px;
	}

	#loginform::before,
	#lostpasswordform::before,
	#resetpassform::before {
		font-size: 38px;
	}

	.login #backtoblog {
		margin-top: 0;
	}
}
CSS;

	wp_add_inline_style( 'login', $css );
}
