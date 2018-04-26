<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class-pp-routes
 *
 * @author Bayonle ladipo<laredy27@gmail.com>
 */
class PP_Routes  {
//put your code here
    public function __construct() {
        $this->namespace = "/phonepress";
        
        add_action( "rest_api_init", array($this, 'register_rest_routes') );
    }
    
    /**
     * Register phonepress routes and endpoints 
     */
    public function register_rest_routes(){
        /**
         * User login route
         * @method GET username&password
         * @return mixed
         */
        register_rest_route(
            $this->namespace . "/user", 
            '/login', 
            array(
                "method" => WP_REST_Server::READABLE,
                "callback" => array(new PP_User(), "login"),
                'args' => array(
                    "username" => array(
                            "required" => true
                    ),
                    "password" => array(
                            "required" => true
                    )
                ),
            )
        );
        
        register_rest_route(
            $this->namespace . "/user", 
            "/me", 
            array(
                'method' => WP_REST_Server::READABLE,
                'callback' => array( new PP_User(), "whoiam" ),
                'args' => array(
                    "login_token" => array(
                        "required" => true,
                        "validate_callback" => function($param){
                            return !empty($param);
                        }
                    ),
                )
            )
        );
    }

}
