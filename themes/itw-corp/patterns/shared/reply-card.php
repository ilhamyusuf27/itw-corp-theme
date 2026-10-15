<?php
/**
 * Title: Home: reply card
 * Slug: itw-corp/shared-reply-card
 * Categories: itw-corp-shared, call-to-action
 * Keywords: cta, contact, consultation, whatsapp
 * Viewport Width: 1440
 * Description: The invitation to book, set as a card lying on a walnut field. Contact details come from Settings → Contact details.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_wa = '{{whatsapp_url}}?text=' . rawurlencode( __( 'Hello itw-corp, I would like to book a design consultation.', 'itw-corp' ) );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-cta","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-cta">
	<!-- wp:paragraph {"className":"h-cta__aside"} -->
	<p class="h-cta__aside"><?php esc_html_e( 'Tell us about the room. We will come and measure it.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"h-card","layout":{"type":"default"}} -->
	<div class="wp-block-group h-card">
		<!-- wp:heading {"className":"h-card__title"} -->
		<h2 class="wp-block-heading h-card__title"><?php esc_html_e( 'Book a consultation', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'We reply within one working day.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"h-card__actions"} -->
		<div class="wp-block-buttons h-card__actions">
			<!-- wp:button {"width":100} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Request a visit', 'itw-corp' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:paragraph {"className":"h-card__alt"} -->
		<p class="h-card__alt"><?php esc_html_e( 'Or message us on', 'itw-corp' ); ?> <a href="<?php echo esc_attr( $itw_wa ); ?>">WhatsApp</a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
