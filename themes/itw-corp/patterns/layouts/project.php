<?php
/**
 * Title: Project page
 * Slug: itw-corp/layout-project
 * Inserter: no
 * Description: One project: name and facts, the cover, the story and gallery from the content, the client's words, related projects and the reply card.
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_facts = array(
	'location' => __( 'Location', 'itw-corp' ),
	'year'     => __( 'Year', 'itw-corp' ),
	'area'     => __( 'Area', 'itw-corp' ),
	'category' => __( 'Type', 'itw-corp' ),
	'style'    => __( 'Style', 'itw-corp' ),
	'duration' => __( 'Duration', 'itw-corp' ),
	'scope'    => __( 'Scope', 'itw-corp' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-hero","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-hero">
	<!-- wp:post-title {"level":1,"className":"p-hero__title"} /-->

	<!-- wp:group {"className":"p-facts","layout":{"type":"default"}} -->
	<div class="wp-block-group p-facts">
		<?php foreach ( $itw_facts as $itw_key => $itw_label ) : ?>
		<!-- wp:group {"className":"p-fact","layout":{"type":"default"}} -->
		<div class="wp-block-group p-fact">
			<!-- wp:paragraph {"className":"p-fact__k"} -->
			<p class="p-fact__k"><?php echo esc_html( $itw_label ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/project","args":{"key":"<?php echo esc_attr( $itw_key ); ?>"}}}},"className":"p-fact__v"} -->
			<p class="p-fact__v"></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:post-featured-image {"sizeSlug":"full","className":"p-hero__cover"} /-->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"article","align":"full","className":"p-story","layout":{"type":"default"}} -->
<article class="wp-block-group alignfull p-story">
	<!-- wp:post-content {"layout":{"type":"constrained","contentSize":"720px","wideSize":"1280px"}} /-->
</article>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-words","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-words">
	<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/project","args":{"key":"quote"}}}},"className":"p-words__quote"} -->
	<p class="p-words__quote"></p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"itw/project","args":{"key":"quote_by"}}}},"className":"p-words__by"} -->
	<p class="p-words__by"></p>
	<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"h-sec p-related","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec p-related">
	<!-- wp:group {"className":"p-related__head","layout":{"type":"default"}} -->
	<div class="wp-block-group p-related__head">
		<!-- wp:heading {"className":"p-related__title"} -->
		<h2 class="wp-block-heading p-related__title"><?php esc_html_e( 'More rooms like this', 'itw-corp' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"p-related__all"} -->
		<p class="p-related__all"><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'All projects', 'itw-corp' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":22,"query":{"perPage":3,"pages":0,"offset":0,"postType":"project","order":"desc","orderBy":"date","inherit":false,"itwRelated":true},"className":"p-query"} -->
	<div class="wp-block-query p-query">
		<!-- wp:post-template {"className":"p-grid p-grid--three"} -->
			<!-- wp:pattern {"slug":"itw-corp/shared-project-card"} /-->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"itw-corp/shared-project-reply-card"} /-->
