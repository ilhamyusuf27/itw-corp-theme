<?php
/**
 * Title: Process: the eight steps
 * Slug: itw-corp/process-steps
 * Categories: itw-corp-process, text
 * Keywords: process, steps, timeline, how we work
 * Viewport Width: 1440
 * Description: Each step with its estimated time, what happens and what you receive, beside a sticky list of steps. Times are estimates to confirm.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;

$itw_steps = array(
	array( 'mid-1', __( 'A first conversation', 'itw-corp' ), __( 'About an hour', 'itw-corp' ), __( 'We listen to how you live, what you need and the budget you have in mind, at our studio, at your place or on a video call.', 'itw-corp' ), __( 'A written brief', 'itw-corp' ), __( 'A family living room seen from above', 'itw-corp' ) ),
	array( '5-1', __( 'Survey and measurement', 'itw-corp' ), __( 'Within the first week', 'itw-corp' ), __( 'We measure every wall, window, socket and slope, and note where the light falls through the day.', 'itw-corp' ), __( 'Measured drawings of the space', 'itw-corp' ), __( 'A modern two-storey house with a white facade', 'itw-corp' ) ),
	array( '9', __( 'Concept and moodboard', 'itw-corp' ), __( 'One to two weeks', 'itw-corp' ), __( 'Real samples of timber, stone and fabric on the table, with a first layout for every room.', 'itw-corp' ), __( 'A moodboard and a first layout', 'itw-corp' ), __( 'A terracotta bedroom with timber slats and an arched window', 'itw-corp' ) ),
	array( 'in-liv-2-skp', __( 'Every room in 3D', 'itw-corp' ), __( 'Two to three weeks', 'itw-corp' ), __( 'You walk through each room before it exists, and we change the model until it feels right.', 'itw-corp' ), __( '3D views of every room', 'itw-corp' ), __( 'A 3D model of a living room with a slatted timber stair', 'itw-corp' ) ),
	array( 'Enscape_2026-01-25-20-09-20', __( 'The quotation', 'itw-corp' ), __( 'About a week', 'itw-corp' ), __( 'Itemised room by room and material by material, with the timeline for production and installation.', 'itw-corp' ), __( 'A quotation and timeline to sign', 'itw-corp' ), __( 'A kitchen with a marble table in warm evening light', 'itw-corp' ) ),
	array( 'mbeds4', __( 'In the workshop', 'itw-corp' ), __( 'As agreed in the quotation', 'itw-corp' ), __( 'Our own craftsmen make the built-ins and furniture while the site is prepared.', 'itw-corp' ), __( 'Progress photos from the workshop', 'itw-corp' ), __( 'Built-in timber wardrobes and shelving', 'itw-corp' ) ),
	array( 'kp-room-1', __( 'Installation', 'itw-corp' ), __( 'As agreed in the quotation', 'itw-corp' ), __( 'One site supervisor is there every day until the last shelf is level and the last light is on.', 'itw-corp' ), __( 'A finished room, checked against the 3D', 'itw-corp' ), __( 'A finished study room with a desk and storage, seen from above', 'itw-corp' ) ),
	array( 'in-liv', __( 'The keys', 'itw-corp' ), __( 'One day', 'itw-corp' ), __( 'We walk through every room with you, then hand it over cleaned and ready to live in.', 'itw-corp' ), __( 'Your home, and care notes for every material', 'itw-corp' ), __( 'A finished double-height living room in morning light', 'itw-corp' ) ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec pr-steps","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec pr-steps">
	<!-- wp:group {"className":"pr-aside","layout":{"type":"default"}} -->
	<div class="wp-block-group pr-aside">
		<!-- wp:heading {"className":"pr-aside__title"} -->
		<h2 class="wp-block-heading pr-aside__title"><?php esc_html_e( 'Eight steps', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:list {"ordered":true,"className":"pr-index"} -->
		<ol class="wp-block-list pr-index">
			<?php foreach ( $itw_steps as $itw_i => $itw_step ) : ?>
			<!-- wp:list-item -->
			<li><a href="#step-<?php echo (int) $itw_i + 1; ?>"><?php echo esc_html( $itw_step[1] ); ?></a></li>
			<!-- /wp:list-item -->
			<?php endforeach; ?>
		</ol>
		<!-- /wp:list -->

		<!-- wp:paragraph {"className":"pr-aside__note"} -->
		<p class="pr-aside__note"><?php esc_html_e( 'Times are estimates. Your own timeline is agreed with the quotation.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"pr-list","layout":{"type":"default"}} -->
	<div class="wp-block-group pr-list">
		<?php foreach ( $itw_steps as $itw_i => $itw_step ) : ?>
		<!-- wp:group {"anchor":"step-<?php echo (int) $itw_i + 1; ?>","className":"pr-step","layout":{"type":"default"}} -->
		<div id="step-<?php echo (int) $itw_i + 1; ?>" class="wp-block-group pr-step">
			<?php echo Media::image( $itw_step[0], $itw_step[5], 'pr-step__img' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			<!-- wp:group {"className":"pr-step__text","layout":{"type":"default"}} -->
			<div class="wp-block-group pr-step__text">
				<!-- wp:heading {"level":3,"className":"pr-step__title"} -->
				<h3 class="wp-block-heading pr-step__title"><?php echo esc_html( $itw_step[1] ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pr-step__time"} -->
				<p class="pr-step__time"><?php echo esc_html( $itw_step[2] ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph -->
				<p><?php echo esc_html( $itw_step[3] ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"pr-step__get"} -->
				<p class="pr-step__get"><?php esc_html_e( 'You receive:', 'itw-corp' ); ?> <?php echo esc_html( $itw_step[4] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
