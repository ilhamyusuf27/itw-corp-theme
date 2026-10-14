<?php
/**
 * Title: Home: testimonial
 * Slug: itw-corp/home-testimonial
 * Categories: itw-corp-home, testimonials
 * Keywords: testimonial, quote, review, client
 * Viewport Width: 1440
 * Description: A quotation set on a full-width room. SAMPLE CONTENT: replace the quotation and name with a real client testimonial before launch.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-quote","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-quote">
	<?php echo Media::image( '7', __( 'A living room in the evening with warm cove light, open shelving and a dining table', 'itw-corp' ), 'h-quote__photo', 'full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<!-- wp:quote {"className":"h-quote__text"} -->
	<blockquote class="wp-block-quote h-quote__text"><!-- wp:paragraph -->
<p><?php esc_html_e( '“The living room became the place everyone wants to be.”', 'itw-corp' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'Homeowner, Jakarta Selatan', 'itw-corp' ); ?></cite></blockquote>
	<!-- /wp:quote -->
</section>
<!-- /wp:group -->
