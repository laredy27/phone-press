<?php

/*
Plugin Name: Phone Press
Plugin URI: 
Description: A simple plugin to facilitate porting wordpress sites to hybrid mobile app
Version: 1.0.0
Author: Bayo
Author URI: 
License: GPLv2
Text Domain: phone-press
Domain Path: /languages

Copyright (C) 2017 Bayo

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/
define('prefix', 'mm');
define('PLUGIN_URI', plugin_dir_url(__FILE__));
define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TEXT_DOMAIN', 'phone-press');
Class Phone_Press{
    public function __construct() {
        do_action("phonepress_init");
        // Require our plugins functions.php file
        require plugin_dir_path(__FILE__) . "/functions.php";
        $this->_require_plugin_files();
        
        // Register plugin activation and deactivation hooks
        register_activation_hook(__FILE__, array( $this, "activate" ));
        register_deactivation_hook(__FILE__, array( $this, "deactivate" ));
        
        //add_action('rest_api_init', array($this, 'register_api_routes'));
        $this->register_api_routes();
        require PLUGIN_PATH . "/admin/admin-pages.php";
    }
    public function activate(){
        
    }
    public function deactivate(){
        
    }
    
    private function _require_plugin_files(){
       $inc_files = glob( PLUGIN_PATH . '/inc/*.php' );
       $files = array_merge( $inc_files );
       foreach ($files as $file) {
           require_once( $file );
       }
    }
    
    public function register_api_routes(){
        new PP_Routes();
    }
    
    
    public function add_settings_field_cb($args){
        global $option_grp_name;
        $options = get_option($option_grp_name);
        
        if( $args["control"] == "select" ){
            $select_opts = isset($options[ $args["label_for"] ]) ? $options[ $args["label_for"] ] : array();
            $post_args = array(
                "_builtin" => FALSE,
                "public" => TRUE,
                "publicly_queryable" => TRUE
            );
            echo "<select id='". esc_attr($args["label_for"]) ."' name='phone_press_opts[". esc_attr($args["label_for"]) ."][]' multiple>";
            foreach (get_post_types($post_args, "names")  as $post_type) {
                echo "<option value='${post_type}'". selected( in_array($post_type, $select_opts), true, false ) .">${post_type}</option>";
            }
            echo"</select>";
        }
        elseif ($args["control"] == "checkbox") {
            $opt = isset( $options[ $args["label_for"] ] ) ? $options[ $args["label_for"] ] : "";
            echo "<input type ='checkbox' id='". esc_attr($args["label_for"]) ."' name='". $option_grp_name . '['. esc_attr($args["label_for"]) .']' ."' value='1'". checked(1, $opt, false) ." />";
        }
    }

}
//Initialize plugin
new Phone_Press();