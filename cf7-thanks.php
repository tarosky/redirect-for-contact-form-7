<?php
/**
 * Plugin Name:     Cf7 Thanks
 * Plugin URI:      https://github.com/tarosky/wpcf7-thanks-addon
 * Description:     An add-on plugin for Contact Form 7 which redirects to thanks page.
 * Author:          Takayuki Miyauchi
 * Author URI:      https://tarosky.co.jp/
 * Text Domain:     cf7-thanks
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Cf7_Thanks
 */

add_action( 'plugins_loaded', function() {
	add_filter( 'wpcf7_load_js', '__return_false' );
} );

add_action( 'plugins_loaded', function() {
	remove_shortcode( 'contact-form-7' );
	remove_shortcode( 'contact-form' );

	add_shortcode( 'contact-form-7', 'custom_cf7_shortcode' );
	add_shortcode( 'contact-form', 'custom_cf7_shortcode' );
}, 11 );

add_action( 'wpcf7_mail_sent', function() {
	if ( ! empty( $_POST['__goto'] ) ) {
		wp_redirect( esc_url_raw( $_POST['__goto'], array( 'http', 'https' ) ), 302 );
		exit;
	}
} );

function custom_cf7_shortcode( $atts, $content = null, $code = '' ) {
	add_filter( 'wpcf7_form_hidden_fields', function() use ( $atts ) {
		return array( '__goto' => $atts['thanks'] );
	} );
	return wpcf7_contact_form_tag_func( $atts, $content, $code );
}
