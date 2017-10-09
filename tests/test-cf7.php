<?php
/**
 * Class SampleTest
 *
 * @package redirect_for_contact_form_7
 */

/**
 * Sample test case.
 */
class CF7 extends WP_UnitTestCase {

	/**
	 * A hidden tag that has the name `__goto` should exist.
	 */
	function test_hidden_tag_should_exist()
	{
		$id = $this->factory->post->create( array(
			'post_type' => 'wpcf7_contact_form',
			'post_content' => '[text* your-name]'
		) );
		$html = do_shortcode( '[contact-form-7 id="'.$id.'" goto="http://wp.test/archives/1"]' );
		$this->assertRegExp( '#<input type="hidden" name="__goto" value="http://wp.test/archives/1".+?>#', $html );
	}

	/**
	 * A hidden tag that has the name `__goto` should not exist.
	 */
	function test_hidden_tag_should_not_exist()
	{
		$id = $this->factory->post->create( array(
			'post_type' => 'wpcf7_contact_form',
			'post_content' => '[text* your-name]'
		) );
		$html = do_shortcode( '[contact-form-7 id="'.$id.'"]' );
		$res = preg_match( '#<input type="hidden" name="__goto" value="http://wp.test/archives/1".+?>#', $html );
		$this->assertSame( 0, $res );
	}

	/**
	 * The JS for CF7 should not be loaded
	 */
	function test_cf7_js_should_not_be_loaded()
	{
		do_action( 'wp_enqueue_scripts' );
		$this->assertFalse( wp_script_is( 'contact-form-7' ) );
	}
}
