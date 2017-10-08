<?php
/**
 * Plugin Name:     redirect-for-contact-form-7
 * Plugin URI:      https://github.com/tarosky/redirect-for-contact-form-7
 * Description:     An add-on plugin for the Contact Form 7 which redirects to the specific page.
 * Author:          Takayuki Miyauchi
 * Author URI:      https://tarosky.co.jp/
 * Version:         0.1.0
 *
 * @package         redirect_for_contact_form_7
 */

add_action( 'plugins_loaded', function() {
	add_filter( 'wpcf7_load_js', '__return_false' );
} );

add_action( 'plugins_loaded', function() {
	remove_shortcode( 'contact-form-7' );
	remove_shortcode( 'contact-form' );

	add_shortcode( 'contact-form-7', '__cf7_shortcode' );
	add_shortcode( 'contact-form', '__cf7_shortcode' );
}, 11 );

add_action( 'wpcf7_mail_sent', function() {
	if ( ! empty( $_POST['__goto'] ) ) {
		wp_redirect( esc_url_raw( $_POST['__goto'], array( 'http', 'https' ) ), 302 );
		exit;
	}
} );

function __cf7_shortcode( $atts, $content = null, $code = '' ) {
	add_filter( 'wpcf7_form_hidden_fields', function() use ( $atts ) {
		// It will be escaped in the contact-form-7. :)
		return array( '__goto' => $atts['goto'] );
	} );
	return wpcf7_contact_form_tag_func( $atts, $content, $code );
}
