<?php
/**
 * Title: Home: services
 * Slug: itw-corp/home-services
 * Categories: itw-corp-home, text
 * Keywords: services, residential, commercial, renovation, furniture
 * Viewport Width: 1440
 * Description: The four services as a mosaic of unlike tiles: heading, photographs, a figure, a list and sentences, each linking to its service page.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;

$itw_link = static fn( string $path, string $label ): string => '<a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a>';
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec h-services","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec h-services">
	<!-- wp:group {"className":"h-mosaic","layout":{"type":"default"}} -->
	<div class="wp-block-group h-mosaic">
		<!-- wp:group {"className":"h-m h-m--head","layout":{"type":"default"}} -->
		<div class="wp-block-group h-m h-m--head">
			<!-- wp:heading {"className":"h-services__title"} -->
			<h2 class="wp-block-heading h-services__title"><?php esc_html_e( 'What we design', 'itw-corp' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->

		<?php echo Media::image( '6', __( 'A marble kitchen island with green cabinets and patterned tiles', 'itw-corp' ), 'h-m h-m--photo' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<!-- wp:group {"className":"h-m h-m--res","layout":{"type":"default"}} -->
		<div class="wp-block-group h-m h-m--res">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo $itw_link( '/services/residential-interior/', __( 'Residential interior', 'itw-corp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'Whole homes or a single room.', 'itw-corp' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"h-m h-m--com","layout":{"type":"default"}} -->
		<div class="wp-block-group h-m h-m--com">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo $itw_link( '/services/commercial-interior/', __( 'Commercial interior', 'itw-corp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'Offices, cafés, shops and hotels.', 'itw-corp' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"h-m h-m--ren","layout":{"type":"default"}} -->
		<div class="wp-block-group h-m h-m--ren">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo $itw_link( '/services/renovation/', __( 'Renovation', 'itw-corp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'New life for the space you already have.', 'itw-corp' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"h-m h-m--fig","layout":{"type":"default"}} -->
		<div class="wp-block-group h-m h-m--fig">
			<!-- wp:paragraph {"className":"h-m__figure"} -->
			<p class="h-m__figure">8</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'steps from first talk to keys.', 'itw-corp' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<?php echo Media::image( 'mbeds3', __( 'A built-in timber wardrobe beside a reading chair', 'itw-corp' ), 'h-m h-m--photo2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<!-- wp:group {"className":"h-m h-m--fur","layout":{"type":"default"}} -->
		<div class="wp-block-group h-m h-m--fur">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo $itw_link( '/services/custom-furniture/', __( 'Custom furniture', 'itw-corp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'Built-ins made in our own workshop.', 'itw-corp' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
