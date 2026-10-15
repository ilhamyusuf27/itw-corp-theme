<?php
/**
 * Title: Process: questions
 * Slug: itw-corp/process-faq
 * Categories: itw-corp-process, text
 * Keywords: faq, questions, process
 * Viewport Width: 1440
 * Description: Common questions about working with the studio, as Details blocks (they also become FAQ markup for search engines).
 *
 * @package ITWCorp
 */

defined( 'ABSPATH' ) || exit;

$itw_faq = array(
	__( 'Do I need to know my style before we start?', 'itw-corp' )   => __( 'No. Many clients start with a few pictures they like. The moodboard step is where the style takes shape.', 'itw-corp' ),
	__( 'Can I change the design after seeing it in 3D?', 'itw-corp' ) => __( 'Yes. That is what the 3D step is for. We adjust the model with you before the quotation is made.', 'itw-corp' ),
	__( 'When do I pay?', 'itw-corp' )                                 => __( 'The payment schedule is set out in the quotation, so you know every amount and date before work starts.', 'itw-corp' ),
	__( 'Do you work outside Yogyakarta?', 'itw-corp' )                   => __( 'Tell us where your project is when you book a consultation, and we will let you know how we can work together.', 'itw-corp' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"h-sec pr-faq","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull h-sec pr-faq">
	<!-- wp:heading {"className":"pr-faq__title"} -->
	<h2 class="wp-block-heading pr-faq__title"><?php esc_html_e( 'Questions', 'itw-corp' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"pr-faq__list","layout":{"type":"default"}} -->
	<div class="wp-block-group pr-faq__list">
		<?php foreach ( $itw_faq as $itw_q => $itw_a ) : ?>
		<!-- wp:details {"summary":"<?php echo esc_attr( $itw_q ); ?>"} -->
		<details class="wp-block-details"><summary><?php echo esc_html( $itw_q ); ?></summary><!-- wp:paragraph -->
		<p><?php echo esc_html( $itw_a ); ?></p>
		<!-- /wp:paragraph --></details>
		<!-- /wp:details -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
