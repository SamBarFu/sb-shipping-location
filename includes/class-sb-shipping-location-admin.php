<?php

class SBShippingLocationAdmin {

    public function __construct(){
        $this->load_dependencies();
        $this->load_hooks_admin();
    }

    public function load_dependencies(){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/define-function-admin-hooks.php';
    }

    public function sbsl_add_admin_menu(){
        add_menu_page('SBSL', 'SBSL', 'manage_options', 'sbsl-admin', array($this, 'admin_config_template'), 'dashicons-location-alt', 23 );

        add_submenu_page( 'sbsl-admin', 'Ajustes', 'Ajustes', 'manage_options', 'sbsl-admin', array($this, 'admin_config_template'));
    }

    public function load_hooks_admin(){
        sbsl_styles_admin();
        sbsl_scripts_admin();
        /* add_action('wp_enqueue_scripts', 'sbsl_styles_admin', 10);
        add_action('wp_enqueue_scripts', 'sbsl_scripts_admin', 10); */
    }

    /*
    ** LOAD TEMPLATES */

    public function admin_dasboard_template(){
        include_once(plugin_dir_path( dirname(__File__) ) . 'admin/templates/sbsl_admin_dashboard.php');
    }

    public function admin_config_template(){
        include_once(plugin_dir_path( dirname(__File__) ) . 'admin/templates/sbsl_admin_config.php');
    }

}