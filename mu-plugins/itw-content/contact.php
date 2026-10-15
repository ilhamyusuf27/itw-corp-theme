<?php
/**
 * Contact details: one place to edit the studio's WhatsApp, phone, email and
 * social links (Settings → Contact details).
 *
 * Content uses tokens instead of the values themselves, and every rendered
 * block has them replaced on the way out:
 *
 *   {{whatsapp}}      +62 812 0000 0000            {{whatsapp_url}}  https://wa.me/6281200000000
 *   {{phone}}         +62 21 0000 0000             {{phone_url}}     tel:+622100000000
 *   {{email}}         hello@example.com            (link: mailto:{{email}})
 *   {{instagram_url}} {{pinterest_url}} {{linkedin_url}}
 *
 * Tokens work in text and in link addresses, in pages, patterns and template parts.
 *
 * @package ITWContent
 */

namespace ITWContent;

defined( 'ABSPATH' ) || exit;

const CONTACT_OPTION = 'itw_contact';

/**
 * The editable fields, with the values the site was built with as defaults.
 */
function contact_fields(): array {
	return array(
		'whatsapp'  => array(
			'label'   => __( 'WhatsApp number', 'itw-content' ),
			'help'    => __( 'As it should be shown, e.g. +62 812 3456 7890 or 0812 3456 7890.', 'itw-content' ),
			'type'    => 'tel',
			'default' => '+62 812 0000 0000',
		),
		'phone'     => array(
			'label'   => __( 'Phone number', 'itw-content' ),
			'help'    => __( 'Office line, as it should be shown.', 'itw-content' ),
			'type'    => 'tel',
			'default' => '+62 21 0000 0000',
		),
		'email'     => array(
			'label'   => __( 'Email', 'itw-content' ),
			'help'    => __( 'Also receives consultation requests sent by email.', 'itw-content' ),
			'type'    => 'email',
			'default' => 'hello@example.com',
		),
		'instagram' => array(
			'label'   => __( 'Instagram', 'itw-content' ),
			'help'    => __( 'Full profile address.', 'itw-content' ),
			'type'    => 'url',
			'default' => 'https://www.instagram.com/',
		),
		'pinterest' => array(
			'label'   => __( 'Pinterest', 'itw-content' ),
			'help'    => __( 'Full profile address.', 'itw-content' ),
			'type'    => 'url',
			'default' => 'https://www.pinterest.com/',
		),
		'linkedin'  => array(
			'label'   => __( 'LinkedIn', 'itw-content' ),
			'help'    => __( 'Full company page address.', 'itw-content' ),
			'type'    => 'url',
			'default' => 'https://www.linkedin.com/',
		),
	);
}

/**
 * Saved values merged over the defaults.
 *
 * @return array<string, string>
 */
function contact(): array {
	$saved  = (array) get_option( CONTACT_OPTION, array() );
	$values = array();

	foreach ( contact_fields() as $key => $field ) {
		// A social link saved empty stays empty (and is hidden); the numbers and email never go blank.
		$keep_empty     = 'url' === $field['type'] && array_key_exists( $key, $saved );
		$values[ $key ] = '' !== ( $saved[ $key ] ?? '' ) || $keep_empty ? (string) ( $saved[ $key ] ?? '' ) : $field['default'];
	}

	return $values;
}

/**
 * Digits in international form: "0812 3456" → "628123456", "+62 21 …" → "6221…".
 */
function international_digits( string $number ): string {
	$digits = preg_replace( '/\D+/', '', $number );

	return str_starts_with( $digits, '0' ) ? '62' . substr( $digits, 1 ) : $digits;
}

/**
 * Token → value map, values already safe for both HTML text and attributes.
 *
 * @return array<string, string>
 */
function contact_tokens(): array {
	static $tokens = null;

	if ( null === $tokens ) {
		$c      = contact();
		$tokens = array(
			'{{whatsapp}}'      => esc_html( $c['whatsapp'] ),
			'{{whatsapp_url}}'  => esc_url( 'https://wa.me/' . international_digits( $c['whatsapp'] ) ),
			'{{phone}}'         => esc_html( $c['phone'] ),
			'{{phone_url}}'     => esc_url( 'tel:+' . international_digits( $c['phone'] ), array( 'tel' ) ),
			'{{email}}'         => esc_html( antispambot( $c['email'] ) ),
			'{{instagram_url}}' => esc_url( $c['instagram'] ),
			'{{pinterest_url}}' => esc_url( $c['pinterest'] ),
			'{{linkedin_url}}'  => esc_url( $c['linkedin'] ),
		);
	}

	return $tokens;
}

add_filter( 'render_block', __NAMESPACE__ . '\\replace_contact_tokens', 5 );

function replace_contact_tokens( string $html ): string {
	if ( ! str_contains( $html, '{{' ) ) {
		return $html;
	}

	$html = strtr( $html, contact_tokens() );

	// A social link left empty in the settings is removed rather than shown dead.
	return preg_replace( array( '# · <a href="">[^<]*</a>#u', '#<a href="">[^<]*</a>\s?#' ), '', $html );
}

/*
 * Settings → Contact details.
 */

add_action( 'admin_init', __NAMESPACE__ . '\\register_contact_setting' );
add_action( 'admin_menu', __NAMESPACE__ . '\\contact_page' );

function register_contact_setting(): void {
	register_setting(
		'itw_contact',
		CONTACT_OPTION,
		array(
			'type'              => 'array',
			'sanitize_callback' => __NAMESPACE__ . '\\sanitize_contact',
			'default'           => array(),
		)
	);
}

/**
 * @param mixed $input
 * @return array<string, string>
 */
function sanitize_contact( $input ): array {
	$input = is_array( $input ) ? $input : array();
	$clean = array();

	foreach ( contact_fields() as $key => $field ) {
		$value = trim( (string) wp_unslash( $input[ $key ] ?? '' ) );

		$clean[ $key ] = match ( $field['type'] ) {
			'tel'   => preg_replace( '/[^0-9+\-\s().]/', '', $value ),
			'email' => sanitize_email( $value ),
			'url'   => esc_url_raw( $value ),
			default => sanitize_text_field( $value ),
		};
	}

	return $clean;
}

function contact_page(): void {
	add_options_page(
		__( 'Contact details', 'itw-content' ),
		__( 'Contact details', 'itw-content' ),
		'manage_options',
		'itw-contact',
		__NAMESPACE__ . '\\render_contact_page'
	);
}

function render_contact_page(): void {
	$values = contact();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Contact details', 'itw-content' ); ?></h1>
		<p><?php esc_html_e( 'Change these once and every page, the footer and the consultation form use the new details.', 'itw-content' ); ?></p>

		<form method="post" action="options.php">
			<?php settings_fields( 'itw_contact' ); ?>
			<table class="form-table" role="presentation">
				<?php foreach ( contact_fields() as $key => $field ) : ?>
					<tr>
						<th scope="row"><label for="itw-contact-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
						<td>
							<input class="regular-text" type="<?php echo esc_attr( 'url' === $field['type'] ? 'url' : ( 'email' === $field['type'] ? 'email' : 'text' ) ); ?>" id="itw-contact-<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( CONTACT_OPTION . '[' . $key . ']' ); ?>" value="<?php echo esc_attr( $values[ $key ] ); ?>">
							<p class="description"><?php echo esc_html( $field['help'] ); ?></p>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button(); ?>
		</form>

		<h2><?php esc_html_e( 'Using the details in your own content', 'itw-content' ); ?></h2>
		<p><?php esc_html_e( 'Type these tokens in any text or link address in the editor. The site shows the current details in their place.', 'itw-content' ); ?></p>
		<table class="widefat striped" style="max-width:48rem">
			<tbody>
				<?php
				$examples = array(
					'{{whatsapp}}'       => __( 'WhatsApp number as text', 'itw-content' ),
					'{{whatsapp_url}}'   => __( 'WhatsApp chat link (add ?text=… for a ready message)', 'itw-content' ),
					'{{phone}}'          => __( 'Phone number as text', 'itw-content' ),
					'{{phone_url}}'      => __( 'Phone call link', 'itw-content' ),
					'{{email}}'          => __( 'Email as text', 'itw-content' ),
					'mailto:{{email}}'   => __( 'Email link', 'itw-content' ),
					'{{instagram_url}}'  => __( 'Instagram link', 'itw-content' ),
					'{{pinterest_url}}'  => __( 'Pinterest link', 'itw-content' ),
					'{{linkedin_url}}'   => __( 'LinkedIn link', 'itw-content' ),
				);
				foreach ( $examples as $token => $use ) :
					?>
					<tr><td><code><?php echo esc_html( $token ); ?></code></td><td><?php echo esc_html( $use ); ?></td></tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/*
 * One-time update: pages built before this existed hold the sample details
 * themselves. Swap them for tokens so they follow the settings too.
 */

const CONTACT_MIGRATION = '1';

add_action( 'init', __NAMESPACE__ . '\\migrate_contact_tokens', 100 );

function migrate_contact_tokens(): void {
	if ( get_option( 'itw_contact_migrated' ) === CONTACT_MIGRATION ) {
		return;
	}

	global $wpdb;

	$swap = array(
		'https://wa.me/6281200000000' => '{{whatsapp_url}}',
		'data-wa="6281200000000"'     => 'data-wa="{{whatsapp_url}}"',
		'tel:+622100000000'           => '{{phone_url}}',
		'+62 812 0000 0000'           => '{{whatsapp}}',
		'+62 21 0000 0000'            => '{{phone}}',
		'hello@example.com'           => '{{email}}',
		'href="https://www.instagram.com/"' => 'href="{{instagram_url}}"',
		'href="https://www.pinterest.com/"' => 'href="{{pinterest_url}}"',
		'href="https://www.linkedin.com/"'  => 'href="{{linkedin_url}}"',
	);

	$ids = $wpdb->get_col( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		"SELECT ID FROM {$wpdb->posts}
		WHERE post_type IN ( 'page', 'post', 'wp_block', 'wp_template', 'wp_template_part' )
		AND ( post_content LIKE '%6281200000000%' OR post_content LIKE '%622100000000%'
			OR post_content LIKE '%0000 0000%' OR post_content LIKE '%hello@example.com%'
			OR post_content LIKE '%href=\"https://www.instagram.com/\"%'
			OR post_content LIKE '%href=\"https://www.pinterest.com/\"%'
			OR post_content LIKE '%href=\"https://www.linkedin.com/\"%' )"
	);

	foreach ( $ids as $id ) {
		$content = (string) get_post_field( 'post_content', (int) $id, 'raw' );
		$updated = strtr( $content, $swap );

		if ( $updated !== $content ) {
			$wpdb->update( $wpdb->posts, array( 'post_content' => $updated ), array( 'ID' => (int) $id ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			clean_post_cache( (int) $id );
		}
	}

	update_option( 'itw_contact_migrated', CONTACT_MIGRATION );
}
