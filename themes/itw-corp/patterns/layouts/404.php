<?php
/**
 * Title: 404 content
 * Slug: itw-corp/layout-404
 * Inserter: no
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Page not found', 'itw-corp' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The page you are looking for may have moved or no longer exists. Try searching instead.', 'itw-corp' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo esc_attr__( 'Search', 'itw-corp' ); ?>","showLabel":false,"buttonText":"<?php echo esc_attr__( 'Search', 'itw-corp' ); ?>"} /-->
