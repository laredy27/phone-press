<?php

/**
 * Phone Press Settings Page
 */
function pp_admin_pages(){
    add_submenu_page(
        "options-general.php",
        __("Phone Press", "pp"), 
        __("Phone Press", "pp"), 
        "manage_options", 
        __DIR__."/templates/menu-page.php",
        ""
    );
}
add_action("admin_menu", "pp_admin_pages");

/**
 * ===============================
 * REGISTER SETTING OPTIONS
 * ===============================
 */
//function admin_page_options(){
//    register_setting("phone_press_settings", "allow");
//
//    add_settings_section("phonepress_settings_section", __("Settings", "phone-press"), "", "phonepress");
//    add_settings_field("enable_login", __("Enable Login", "phone-press"), array($this, "add_settings_field_cb"), "phonepress", "phonepress_settings_section", array(
//        "label_for" => "enable_login",
//        "control" => "checkbox"
//    ));
//    add_settings_field("post_types", "Select post types", array($this, "add_settings_field_cb"), "phonepress", "phonepress_settings_section", array(
//        "label_for" => "post_types",
//        "control" => "select"
//    ));
//}
//add_action("admin_init", "pp_admin_pages");

