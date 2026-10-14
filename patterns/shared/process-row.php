<?php
/**
 * Title: Home: process
 * Slug: itw-corp/shared-process-row
 * Categories: itw-corp-shared, text
 * Keywords: process, steps, how we work
 * Viewport Width: 1440
 * Description: The eight steps as a row of moments that scrolls sideways, each with a render from that stage. Durations are estimates to confirm.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;

$itw_steps = array(
	array( 'mid-1', __( 'A first conversation', 'itw-corp' ), __( 'How you live, what you need.', 'itw-corp' ), __( 'A family living room seen from above', 'itw-corp' ) ),
	array( '5-1', __( 'On site', 'itw-corp' ), __( 'Every wall measured, the light noted.', 'itw-corp' ), __( 'A modern two-storey house with a white facade', 'itw-corp' ) ),
	array( '9', __( 'Concept and moodboard', 'itw-corp' ), __( 'Real timber, stone and fabric.', 'itw-corp' ), __( 'A terracotta bedroom with timber slats', 'itw-corp' ) ),
	array( 'in-liv-2-skp', __( 'Every room in 3D', 'itw-corp' ), __( 'Walk through it before it exists.', 'itw-corp' ), __( 'A 3D model of a living room with a slatted timber stair', 'itw-corp' ) ),
	array( 'Enscape_2026-01-25-20-09-20', __( 'The quotation', 'itw-corp' ), __( 'Itemised, room by room.', 'itw-corp' ), __( 'A kitchen with a marble table in warm evening light', 'itw-corp' ) ),
	array( 'mbeds4', __( 'In the workshop', 'itw-corp' ), __( 'Made by our own craftsmen.', 'itw-corp' ), __( 'Built-in timber wardrobes and shelving', 'itw-corp' ) ),
	array( 'kp-room-1', __( 'Installation', 'itw-corp' ), __( 'One supervisor, every day.', 'itw-corp' ), __( 'A finished study room with a desk and storage, seen from above', 'itw-corp' ) ),
	array( 'in-liv', __( 'The keys', 'itw-corp' ), __( 'Clean, finished, ready to live in.', 'itw-corp' ), __( 'A finished double-height living room in morning light', 'itw-corp' ) ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec h-process","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec h-process">
	<!-- wp:group {"className":"h-process__head","layout":{"type":"default"}} -->
	<div class="wp-block-group h-process__head">
		<!-- wp:heading {"className":"h-process__title"} -->
		<h2 class="wp-block-heading h-process__title"><?php esc_html_e( 'From survey to keys', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"h-process__more"} -->
		<p class="h-process__more"><a href="<?php echo esc_url( home_url( '/our-process/' ) ); ?>"><?php esc_html_e( 'How we work, in detail', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:list {"ordered":true,"className":"h-row"} -->
	<ol class="wp-block-list h-row">
		<?php foreach ( $itw_steps as $itw_step ) : ?>
		<!-- wp:list-item -->
		<li><strong><?php echo esc_html( $itw_step[1] ); ?></strong> <span><?php echo esc_html( $itw_step[2] ); ?></span> <img src="<?php echo esc_url( (string) wp_get_attachment_image_url( Media::id( $itw_step[0] ), 'medium_large' ) ); ?>" alt="<?php echo esc_attr( $itw_step[3] ); ?>" loading="lazy" width="768" height="432"></li>
		<!-- /wp:list-item -->
		<?php endforeach; ?>
	</ol>
	<!-- /wp:list -->
</section>
<!-- /wp:group -->
