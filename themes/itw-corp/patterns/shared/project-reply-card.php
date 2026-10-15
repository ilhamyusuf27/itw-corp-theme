<?php
/**
 * Title: Project: reply card
 * Slug: itw-corp/shared-project-reply-card
 * Categories: itw-corp-shared, call-to-action
 * Keywords: cta, consultation, project
 * Viewport Width: 1440
 * Description: "Want a room like this?" set as a card on a walnut field, linking to the consultation form.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-cta","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-cta">
	<!-- wp:paragraph {"className":"h-cta__aside"} -->
	<p class="h-cta__aside"><?php esc_html_e( 'Every room here started with one conversation.', 'itw-corp' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"h-card","layout":{"type":"default"}} -->
	<div class="wp-block-group h-card">
		<!-- wp:heading {"className":"h-card__title"} -->
		<h2 class="wp-block-heading h-card__title"><?php esc_html_e( 'Want a room like this?', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'We reply within one working day.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"h-card__actions"} -->
		<div class="wp-block-buttons h-card__actions">
			<!-- wp:button {"width":100} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/#book' ) ); ?>"><?php esc_html_e( 'Book a consultation', 'itw-corp' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
