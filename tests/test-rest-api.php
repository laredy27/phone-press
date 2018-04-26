<?php

/**
 * Class PP_User_Tests
 *
 * @package Phone_Press
 */

/**
 * Rest Api test case.
 */
class PP_Rest_Tests extends WP_UnitTestCase {
    
    function test_rest_api_available() {
            // Replace this with some actual testing code.
            $this->assertTrue(class_exists("WP_REST_Server") );
    }
}

