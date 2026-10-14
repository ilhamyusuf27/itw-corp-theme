<?php
/**
 * Title: Hero
 * Slug: itw-corp/starter-hero
 * Categories: itw-corp-starter, banner, featured
 * Keywords: hero, intro, banner
 * Viewport Width: 1400
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"full","backgroundColor":"primary","textColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}},"elements":{"heading":{"color":{"text":"var:preset|color|base"}}}},"layout":{"type":"constrained","contentSize":"860px"}} -->
<div class="wp-block-group alignfull has-base-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:heading {"textAlign":"center","level":1} -->
	<h1 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Building what moves industries forward', 'itw-corp' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
	<p class="has-text-align-center has-large-font-size"><?php esc_html_e( 'We partner with businesses to design, engineer and deliver reliable solutions at scale.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-fill-accent"} -->
		<div class="wp-block-button is-style-fill-accent"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Get in touch', 'itw-corp' ); ?></a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Our services', 'itw-corp' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
