<?php
/**
 * Class PP_User_Tests
 *
 * @package Phone_Press
 */

/**
 * Sample test case.
 */
class PP_User_Tests extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_sample() {
		// Replace this with some actual testing code.
		$this->assertTrue( true );
	}
        
        function test_login_user(){
            
            $test_user = $this->factory->user->create( array( "user_login"=> "zombie" ) );
            wp_set_password("ibadan27", $test_user);
            
            $cred = array();
            $cred['user_login'] = "zombie";
            $cred['user_password'] = "ibadan27";
            
            $user = wp_authenticate("zombie", "ibadan27");
            $pp_user = new PP_User();
            $req = new WP_REST_Request( "GET", "phonepress/user/me" );
            $user2 = $pp_user->login($req);
            
            $this->assertInstanceOf('WP_User', $user );
            $this->assertInstanceOf('WP_REST_Response', $user2 );
        }
        
        function test_get_me(){
            //do_action("phonepress_init");
            $req = new WP_REST_Request( "GET", "phonepress/user/me?login_token=pp_15231078845ac8c82c811768.81552486" );
            $pp_user = new PP_User();
            $user = $pp_user->whoiam($req);
            
            $this->assertInstanceOf('WP_REST_Response', $user );
            $this->assertEquals('application/json', $user->get_headers()["Content-Type"]);
        }
}
