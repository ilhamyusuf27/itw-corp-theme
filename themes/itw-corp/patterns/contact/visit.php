<?php
/**
 * Title: Contact: visit the studio
 * Slug: itw-corp/contact-visit
 * Categories: itw-corp-contact, contact
 * Keywords: map, address, hours, visit, studio
 * Viewport Width: 1440
 * Description: A map of the studio with the address, opening hours and social links. Opening hours are placeholders.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_address = 'Pojok, Harjobinangun, Pakem, Sleman, Yogyakarta 55582';
$itw_map     = 'https://maps.google.com/maps?q=' . rawurlencode( $itw_address ) . '&z=14&output=embed';
$itw_route   = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode( $itw_address );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec c-visit","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec c-visit">
	<!-- wp:html -->
	<div class="c-visit__map"><iframe src="<?php echo esc_url( $itw_map ); ?>" title="<?php esc_attr_e( 'Map showing the itw-corp studio', 'itw-corp' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
	<!-- /wp:html -->

	<!-- wp:group {"className":"c-visit__info","layout":{"type":"default"}} -->
	<div class="wp-block-group c-visit__info">
		<!-- wp:heading {"className":"c-visit__title"} -->
		<h2 class="wp-block-heading c-visit__title"><?php esc_html_e( 'Visit the studio', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"c-visit__addr"} -->
		<p class="c-visit__addr"><?php esc_html_e( 'Pojok, Harjobinangun, Pakem', 'itw-corp' ); ?><br><?php esc_html_e( 'Sleman, Yogyakarta 55582', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"c-visit__route"} -->
		<p class="c-visit__route"><a href="<?php echo esc_url( $itw_route ); ?>"><?php esc_html_e( 'Get directions', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:list {"className":"c-hours"} -->
		<ul class="wp-block-list c-hours">
			<!-- wp:list-item -->
			<li><span><?php esc_html_e( 'Monday to Friday', 'itw-corp' ); ?></span> <span>9:00 – 18:00</span></li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li><span><?php esc_html_e( 'Saturday', 'itw-corp' ); ?></span> <span>9:00 – 15:00</span></li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li><span><?php esc_html_e( 'Sunday', 'itw-corp' ); ?></span> <span><?php esc_html_e( 'By appointment', 'itw-corp' ); ?></span></li>
			<!-- /wp:list-item -->
		</ul>
		<!-- /wp:list -->

		<!-- wp:paragraph {"className":"c-visit__social"} -->
		<p class="c-visit__social"><a href="https://www.instagram.com/">Instagram</a> <a href="https://www.pinterest.com/">Pinterest</a> <a href="https://www.linkedin.com/">LinkedIn</a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
