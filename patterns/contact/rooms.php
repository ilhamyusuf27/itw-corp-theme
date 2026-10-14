<?php
/**
 * Title: Contact: three rooms
 * Slug: itw-corp/contact-rooms
 * Categories: itw-corp-contact, gallery
 * Keywords: rooms, strip, photographs
 * Viewport Width: 1440
 * Description: Three of the studio's rooms side by side, a quiet pause between the form and the map.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec c-rooms","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec c-rooms">
	<?php echo Media::image( '1', __( 'A white villa with arched windows and a garden gazebo', 'itw-corp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo Media::image( '6', __( 'A marble kitchen island with green cabinets and patterned tiles', 'itw-corp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo Media::image( 'mbeds2', __( 'A lilac study bedroom with a white desk and a window seat', 'itw-corp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
<!-- /wp:group -->
