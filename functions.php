<?php

/** 
 * Phonepress Functions.php
 * 
 * @package phonepress
 * @version 1.0
 * @author Bayonle ladipo<laredy27@gmail.com>
 */

global $option_grp_name;
$option_grp_name = "phone_press_opts";

/**
 * Add REST API support for registered custom post types
 * 
 *
 * @global array $wp_post_types
 * @global string $option_grp_name
 * @action init 99
 */
//if( !function_exists("pp_cpt_rest_support") ){
//    function pp_cpt_rest_support(){
//        global $wp_post_types, $option_grp_name;
//        
//        $opts = get_option($option_grp_name, array());
//        if( isset( $opts["post_types"] ) ){
//            foreach( $opts["post_types"] as $post_name ){
//                $wp_post_types[$post_name]->show_in_rest = true;
//                $wp_post_types[$post_name]->rest_base = $post_name;
//                $wp_post_types[$post_name]->rest_controller_class = "WP_REST_Posts_Controller";
//            }
//        }
//    }
//    
//    add_action("init", "pp_cpt_rest_support", 99);
//}


/**
 * Register custom route for login
 */
if( !function_exists("pp_rest_route") ){
    function pp_rest_route(){
        register_rest_route("pp/v1", "/login", array(
            "methods" => "GET",
            "callback" => "rest_login_cb"
        ));
        
        
        
    }
    
    add_action("rest_api_init", "pp_rest_route");
}

function pp_init(){
    session_start();
}
add_action("init", "pp_init");

function pp_filter_user_data_step_1( $userID ){
    //Remove unimportant user data
//    $_delete = array( "display_name", "user_activation_key", "user_nicename", "user_pass", "user_registered" );
//    foreach( $_delete as $value ){
//        unset( $user->$value );
//    }
    $user_info = get_userdata( $userID );
    $user = array(
        "ID" => $userID,
        "username" => $user_info->user_login,
        "email" => $user_info->user_email,
        "first_name" => $user_info->first_name,
        "last_name" => $user_info->last_name,
    );
    
    return $user; //Allow
}
add_filter("rest_user_data", "pp_filter_user_data_step_1", 1);

function pp_filter_user_data_step_2( $user ){
    //Construct user data with meta data
    $user["DOB"] = "01-09-1994";
    return $user;
}
add_filter("rest_user_data", "pp_filter_user_data_step_2", 10);

