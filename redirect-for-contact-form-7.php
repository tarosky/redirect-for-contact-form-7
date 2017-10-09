<?php
/**
 * Plugin Name:     redirect-for-contact-form-7
 * Plugin URI:      https://github.com/tarosky/redirect-for-contact-form-7
 * Description:     An add-on plugin for the Contact Form 7 which redirects to the specific page.
 * Author:          Takayuki Miyauchi
 * Author URI:      https://tarosky.co.jp/
 * Version:         nightly
 *
 * @package         redirect_for_contact_form_7
 */

// Autoload
require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );

add_action( 'init', 'activate_autoupdate' );

function activate_autoupdate() {
	$plugin_slug = plugin_basename( __FILE__ ); // e.g. `hello/hello.php`.
	$gh_user = 'tarosky';                      // The user name of GitHub.
	$gh_repo = 'redirect-for-contact-form-7';       // The repository name of your plugin.

	// Activate automatic update.
	new Miya\WP\GH_Auto_Updater( $plugin_slug, $gh_user, $gh_repo );
}

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
		$url = $_POST['__goto'];
	} else {
		$url = apply_filters( 'redirect_for_contact_form_7_default_url', '' );
	}
	if ( ! empty( $url ) ) {
		wp_safe_redirect( esc_url_raw( $url, array( 'http', 'https' ) ), 302 );
		exit;
	}
} );

function __cf7_shortcode( $atts, $content = null, $code = '' ) {
	add_filter( 'wpcf7_form_hidden_fields', function() use ( $atts ) {
		// It will be escaped in the contact-form-7. :)
		if ( ! empty( $atts['goto'] ) ) {
			return array( '__goto' => $atts['goto'] );
		}
	} );
	return wpcf7_contact_form_tag_func( $atts, $content, $code );
}
