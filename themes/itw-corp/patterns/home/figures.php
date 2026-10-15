<?php
/**
 * Title: Home: figures
 * Slug: itw-corp/home-figures
 * Categories: itw-corp-home, text
 * Keywords: stats, numbers, counter, figures
 * Viewport Width: 1440
 * Description: One large figure on the edge of a photograph. SAMPLE CONTENT: replace every figure with itw-corp's real numbers before launch.
 *
 * @package ITWCorp
 */

use ITWCorp\Media;

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-stats","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-stats">
	<!-- wp:group {"className":"h-stats__frame","layout":{"type":"default"}} -->
	<div class="wp-block-group h-stats__frame">
		<?php echo Media::image( '2', __( 'A white roof terrace with arched doors, a planted pergola and built-in seating', 'itw-corp' ), 'h-stats__photo', 'full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<!-- wp:heading {"className":"h-stats__title"} -->
		<h2 class="wp-block-heading h-stats__title"><?php esc_html_e( 'The studio in numbers', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"h-stats__big"} -->
		<p class="h-stats__big">180</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"h-stats__say"} -->
		<p class="h-stats__say"><?php esc_html_e( 'rooms designed, built and handed over.', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
