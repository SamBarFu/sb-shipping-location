<?php

class SBShippingLocationAdmin {

    public function __construct(){
        //$this->load_hooks();
    }

    public function load_templates(){
        
    }

    public function sbsl_add_admin_menu(){
        add_menu_page('SB Shipping Location', 'Sb shipping location', 'manage_options', 'sbsl-admin', array($this, 'admin_config_template'), 'dashicons-location-alt', 23 );

        add_submenu_page( 'sbsl-admin', 'Ajustes', 'Ajustes', 'manage_options', 'sbsl-admin', array($this, 'admin_config_template'));
    }

    public function admin_dasboard_template(){
        include_once(plugin_dir_path( dirname(__File__) ) . 'admin/templates/sbsl_admin_dashboard.php');
    }

    public function admin_config_template(){
        include_once(plugin_dir_path( dirname(__File__) ) . 'admin/templates/sbsl_admin_config.php');
    }

    public function load_hooks_admin(){

    }

}