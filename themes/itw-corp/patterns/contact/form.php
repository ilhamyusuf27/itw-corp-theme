<?php
/**
 * Title: Contact: consultation form
 * Slug: itw-corp/contact-form
 * Categories: itw-corp-contact, contact
 * Keywords: form, consultation, booking, lead
 * Viewport Width: 1440
 * Description: The consultation request (PRD FR-10). Until a form plugin is installed it writes the visitor's details into a WhatsApp or email message; swap the HTML block for the plugin's form block later.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;

$itw_options = static function ( array $values ): string {
	$html = '<option value="">' . esc_html__( 'Choose', 'itw-corp' ) . '</option>';
	foreach ( $values as $value ) {
		$html .= '<option>' . esc_html( $value ) . '</option>';
	}
	return $html;
};
?>
<!-- wp:group {"tagName":"section","anchor":"book","align":"full","className":"h-sec c-book","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec c-book" id="book">
	<!-- wp:group {"className":"c-book__aside","layout":{"type":"default"}} -->
	<div class="wp-block-group c-book__aside">
		<!-- wp:heading {"className":"c-book__title"} -->
		<h2 class="wp-block-heading c-book__title"><?php esc_html_e( 'Book a consultation', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"c-book__lead"} -->
		<p class="c-book__lead"><?php esc_html_e( 'A few details are enough. We reply within one working day.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3,"className":"c-book__ready-title"} -->
		<h3 class="wp-block-heading c-book__ready-title"><?php esc_html_e( 'Good to have ready', 'itw-corp' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:list {"className":"c-book__ready"} -->
		<ul class="wp-block-list c-book__ready">
			<!-- wp:list-item -->
			<li><?php esc_html_e( 'A floor plan or a few photos', 'itw-corp' ); ?></li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li><?php esc_html_e( 'A rough budget range', 'itw-corp' ); ?></li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li><?php esc_html_e( 'Rooms or pictures you love', 'itw-corp' ); ?></li>
			<!-- /wp:list-item -->
		</ul>
		<!-- /wp:list -->

		<?php echo Media::image( '9', __( 'A terracotta bedroom with an arched window, timber slats and a desk', 'itw-corp' ), 'c-book__photo' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:html -->
	<form class="c-form" action="mailto:hello@example.com?subject=Consultation%20request" method="post" enctype="text/plain" data-wa="6281200000000" data-mail="hello@example.com">
		<div class="c-form__row">
			<label class="c-field"><span><?php esc_html_e( 'Your name', 'itw-corp' ); ?></span><input type="text" name="name" autocomplete="name" required></label>
			<label class="c-field"><span><?php esc_html_e( 'Phone or WhatsApp', 'itw-corp' ); ?></span><input type="tel" name="phone" autocomplete="tel" inputmode="tel" required></label>
		</div>

		<label class="c-field"><span><?php esc_html_e( 'Email', 'itw-corp' ); ?></span><input type="email" name="email" autocomplete="email" required></label>

		<fieldset class="c-choice">
			<legend><?php esc_html_e( 'The project is', 'itw-corp' ); ?></legend>
			<label><input type="radio" name="project_type" value="Residential" required> <span><?php esc_html_e( 'A home', 'itw-corp' ); ?></span></label>
			<label><input type="radio" name="project_type" value="Commercial"> <span><?php esc_html_e( 'A business', 'itw-corp' ); ?></span></label>
			<label><input type="radio" name="project_type" value="Other"> <span><?php esc_html_e( 'Something else', 'itw-corp' ); ?></span></label>
		</fieldset>

		<details class="c-more">
			<summary><?php esc_html_e( 'Add project details', 'itw-corp' ); ?></summary>
			<div class="c-more__grid">
				<label class="c-field"><span><?php esc_html_e( 'Property', 'itw-corp' ); ?></span><select name="property"><?php echo $itw_options( array( __( 'House', 'itw-corp' ), __( 'Apartment', 'itw-corp' ), __( 'Villa', 'itw-corp' ), __( 'Office', 'itw-corp' ), __( 'Café or restaurant', 'itw-corp' ), __( 'Shop', 'itw-corp' ), __( 'Hotel', 'itw-corp' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></select></label>
				<label class="c-field"><span><?php esc_html_e( 'City', 'itw-corp' ); ?></span><input type="text" name="city" autocomplete="address-level2"></label>
				<label class="c-field"><span><?php esc_html_e( 'Area (m²)', 'itw-corp' ); ?></span><input type="number" name="area" min="1" inputmode="numeric"></label>
				<label class="c-field"><span><?php esc_html_e( 'Budget', 'itw-corp' ); ?></span><select name="budget"><?php echo $itw_options( array( __( 'Under Rp 100 juta', 'itw-corp' ), __( 'Rp 100–250 juta', 'itw-corp' ), __( 'Rp 250–500 juta', 'itw-corp' ), __( 'Rp 500 juta – 1 miliar', 'itw-corp' ), __( 'Above Rp 1 miliar', 'itw-corp' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></select></label>
				<label class="c-field"><span><?php esc_html_e( 'Style', 'itw-corp' ); ?></span><select name="style"><?php echo $itw_options( array( __( 'Modern', 'itw-corp' ), __( 'Minimalist', 'itw-corp' ), __( 'Japandi', 'itw-corp' ), __( 'Tropical', 'itw-corp' ), __( 'Industrial', 'itw-corp' ), __( 'Classic', 'itw-corp' ), __( 'Not sure yet', 'itw-corp' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></select></label>
				<label class="c-field"><span><?php esc_html_e( 'Start', 'itw-corp' ); ?></span><select name="timeline"><?php echo $itw_options( array( __( 'As soon as possible', 'itw-corp' ), __( 'In 1–3 months', 'itw-corp' ), __( 'In 3–6 months', 'itw-corp' ), __( 'Just exploring', 'itw-corp' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></select></label>
			</div>
		</details>

		<label class="c-field"><span><?php esc_html_e( 'Tell us about the room', 'itw-corp' ); ?></span><textarea name="message" rows="4"></textarea></label>

		<label class="c-consent"><input type="checkbox" name="consent" value="yes" required> <span><?php esc_html_e( 'I agree that itw-corp may contact me about this request and store my details as described in the privacy policy.', 'itw-corp' ); ?></span></label>

		<div class="c-form__send">
			<button type="submit" class="wp-element-button" name="via" value="whatsapp"><?php esc_html_e( 'Send on WhatsApp', 'itw-corp' ); ?></button>
			<button type="submit" class="c-form__alt" name="via" value="email"><?php esc_html_e( 'Send by email instead', 'itw-corp' ); ?></button>
		</div>

		<p class="c-form__note" role="status" aria-live="polite"></p>
	</form>
	<!-- /wp:html -->
</section>
<!-- /wp:group -->
