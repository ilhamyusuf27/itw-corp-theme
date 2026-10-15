<?php
/**
 * Title: About: certifications, awards and press
 * Slug: itw-corp/about-recognition
 * Categories: itw-corp-about, about
 * Keywords: awards, press, certifications, recognition
 * Viewport Width: 1440
 * Description: Plain lists of certifications, awards and press mentions. Not on the About page by default: insert it once there are real entries, and replace every line.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_groups = array(
	__( 'Certifications', 'itw-corp' ) => __( 'Certification name, issuing body, year', 'itw-corp' ),
	__( 'Awards', 'itw-corp' )         => __( 'Award name, category, year', 'itw-corp' ),
	__( 'Press', 'itw-corp' )          => __( 'Publication, article title, year', 'itw-corp' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec a-recognition","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec a-recognition">
	<!-- wp:heading {"className":"a-recognition__title"} -->
	<h2 class="wp-block-heading a-recognition__title"><?php esc_html_e( 'Recognition', 'itw-corp' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"a-recognition__cols","layout":{"type":"default"}} -->
	<div class="wp-block-group a-recognition__cols">
		<?php foreach ( $itw_groups as $itw_kind => $itw_line ) : ?>
		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $itw_kind ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:list -->
			<ul class="wp-block-list">
				<!-- wp:list-item -->
				<li><?php echo esc_html( $itw_line ); ?></li>
				<!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
