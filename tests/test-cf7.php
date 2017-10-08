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
	function test_shortcode()
	{
		$id = $this->factory->post->create( array(
			'post_type' => 'wpcf7_contact_form',
			'post_content' => '[text* your-name]'
		) );
		$res = do_shortcode( '[contact-form-7 id="'.$id.'" goto="http://wp.test/archives/1"]' );
		$this->assertRegExp( '#<input type="hidden" name="__goto" value="http://wp.test/archives/1".+?>#', $res );
	}
}
