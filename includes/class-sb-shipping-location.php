<?php

class SBShippingLocation {

    public function __construct(){
        $this->load_dependencies();
        $this->load_admin_hooks();
        $this->load_public_hooks();
    }

    public function run(){         
        add_action('woocommerce_after_checkout_billing_form', 'sbsl_woocommerce_after_checkout_billing_form');
    }

    public function load_dependencies(){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/define-function-public-hooks.php';

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sb-shipping-location-admin.php';

    }

    public function load_public_hooks(){
        add_action( 'wp_enqueue_scripts', 'sbsl_styles', 10 );
        add_action('wp_enqueue_scripts', 'sbsl_scripts', 10);
    }

    public function load_admin_hooks(){
        $sbslAdmin = new SBShippingLocationAdmin();
        add_action('admin_menu', array($sbslAdmin, 'sbsl_add_admin_menu'));
    }

}