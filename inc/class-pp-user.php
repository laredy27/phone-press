<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class-pp-user
 *
 * @author Bayonle ladipo<laredy27@gmail.com>
 */
class PP_User {
    private $response;
    private $response_data;
    public function __construct() {
        $this->response = new WP_REST_Response();
        $this->response->header("Content-Type", "application/json");
        $this->response_data = array( "status" => "OK", "data" => "" );
    }

//put your code here
    public function login( $request ){
        $username = $request['username'];
        $password = $request['password'];
        $User = wp_authenticate($username, $password);
       
        $response = new WP_REST_Response();
        if( is_wp_error($User) ){
            $this->response_data["data"] = $User;
            
        }else{
            session_start(); // User authentication session
            //generate user token key
            $token = uniqid("pp_". time(), true);
            $_SESSION[$token] = $User->ID;
            $this->response_data["data"] = array(
                "sessToken" => $token,
                "lastLoggedIn" => ""
            );
            $response->set_status(200);   
        }
        $this->response->set_data( $this->response_data );
        return $this->response;
        
    }
    
    public function whoiam( $request ){
        //Check request token against session
        $token = $request["login_token"];
        //session_start();
        $userID = $_SESSION[$token];
        //Get User ID from session
        $user = get_user_by("ID", $userID);
        //The user information to be made publicly available to the client
        $data = apply_filters( "rest_user_data", $userID );
        $this->response_data["data"] = $data;
        $this->response->set_data( $this->response_data );
        return $this->response;
    }
}
