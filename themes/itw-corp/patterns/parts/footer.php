<?php
/**
 * Title: Footer
 * Slug: itw-corp/part-footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * The way to get in touch is the headline. Phone and email are placeholders.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_links = array(
	__( 'Portfolio', 'itw-corp' )   => '/portfolio/',
	__( 'Services', 'itw-corp' )    => '/services/',
	__( 'Our process', 'itw-corp' ) => '/our-process/',
	__( 'About', 'itw-corp' )       => '/about/',
	__( 'Insights', 'itw-corp' )    => '/blog/',
);
?>
<!-- wp:group {"className":"site-footer","layout":{"type":"default"}} -->
<div class="wp-block-group site-footer">
	<!-- wp:group {"className":"site-footer__top","layout":{"type":"default"}} -->
	<div class="wp-block-group site-footer__top">
		<!-- wp:site-title {"level":0} /-->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Studio: Pojok, Harjobinangun, Pakem, Sleman, Yogyakarta 55582', 'itw-corp' ); ?><br><?php esc_html_e( 'Monday to Saturday, 9:00 to 18:00', 'itw-corp' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"site-footer__up"} -->
		<p class="site-footer__up"><a href="#top"><?php esc_html_e( 'Back to top', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"className":"site-footer__mail"} -->
	<p class="site-footer__mail"><a href="mailto:{{email}}">{{email}}</a></p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"site-footer__meta","layout":{"type":"default"}} -->
	<div class="wp-block-group site-footer__meta">
		<!-- wp:paragraph -->
		<p>
			<?php foreach ( $itw_links as $itw_label => $itw_path ) : ?>
			<a href="<?php echo esc_url( home_url( $itw_path ) ); ?>"><?php echo esc_html( $itw_label ); ?></a>
			<?php endforeach; ?>
		</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p><a href="{{phone_url}}">{{phone}}</a> · <a href="{{instagram_url}}">Instagram</a> · <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>
			<?php
			/* translators: 1: Site name, 2: Current year. */
			echo esc_html( sprintf( __( '%1$s · Yogyakarta, %2$s', 'itw-corp' ), get_bloginfo( 'name' ), wp_date( 'Y' ) ) );
			?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
