<?php
/**
 * Title: Contact: hero
 * Slug: itw-corp/contact-hero
 * Categories: itw-corp-contact, banner, contact
 * Keywords: contact, hero, whatsapp, phone, email
 * Viewport Width: 1440
 * Description: A short invitation, the three direct ways to reach the studio, and a wide room. Phone, WhatsApp and email are placeholders.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;

$itw_wa = '{{whatsapp_url}}?text=' . rawurlencode( __( 'Hello itw-corp, I would like to book a design consultation.', 'itw-corp' ) );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec c-hero","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec c-hero">
	<!-- wp:group {"className":"c-hero__top","layout":{"type":"default"}} -->
	<div class="wp-block-group c-hero__top">
		<!-- wp:heading {"level":1,"className":"c-hero__title"} -->
		<h1 class="wp-block-heading c-hero__title"><?php esc_html_e( 'Let’s talk', 'itw-corp' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:list {"className":"c-hero__ways"} -->
		<ul class="wp-block-list c-hero__ways">
			<!-- wp:list-item -->
			<li><a href="<?php echo esc_attr( $itw_wa ); ?>"><?php esc_html_e( 'WhatsApp', 'itw-corp' ); ?> {{whatsapp}}</a></li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li><a href="{{phone_url}}"><?php esc_html_e( 'Call', 'itw-corp' ); ?> {{phone}}</a></li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li><a href="mailto:{{email}}">{{email}}</a></li>
			<!-- /wp:list-item -->
		</ul>
		<!-- /wp:list -->

		<!-- wp:buttons {"className":"c-hero__actions"} -->
		<div class="wp-block-buttons c-hero__actions">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#book"><?php esc_html_e( 'Book a consultation', 'itw-corp' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<?php echo Media::image( 'Enscape_2026-01-25-20-09-20', __( 'A kitchen in warm evening light with a marble table and a bowl of fruit', 'itw-corp' ), 'c-hero__strip', 'full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
<!-- /wp:group -->
