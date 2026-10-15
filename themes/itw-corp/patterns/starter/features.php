<?php
/**
 * Title: Features (3 columns)
 * Slug: itw-corp/starter-features
 * Categories: itw-corp-starter, columns
 * Keywords: services, features, cards
 * Viewport Width: 1400
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_corp_features = array(
	array( __( 'Strategy', 'itw-corp' ), __( 'Clear roadmaps grounded in data and aligned with your business goals.', 'itw-corp' ) ),
	array( __( 'Engineering', 'itw-corp' ), __( 'Robust, secure systems built by experienced, cross-functional teams.', 'itw-corp' ) ),
	array( __( 'Support', 'itw-corp' ), __( 'Long-term partnership with responsive service and measurable outcomes.', 'itw-corp' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'What we do', 'itw-corp' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">
		<?php foreach ( $itw_corp_features as $itw_corp_feature ) : ?>
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-card">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php echo esc_html( $itw_corp_feature[0] ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"textColor":"muted"} -->
				<p class="has-muted-color has-text-color"><?php echo esc_html( $itw_corp_feature[1] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
