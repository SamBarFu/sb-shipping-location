<?php
/*
Plugin Name: SB Shipping Location
Description: shipping location woocommerce
Version: 1.0
Author: SamBar
Author URI: https://www.linkedin.com/in/samuel-barberena/
License: GPL-2.0+
Text Domain: sbsl
*/

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Check if WooCommerce is active
if (!in_array( 'woocommerce/woocommerce.php',apply_filters('active_plugins', get_option( 'active_plugins' )))) {
    die;
}

function sb_shipping_location_activate(){
    require plugin_dir_path(__FILE__) . 'includes/class-sb-shipping-location-activator.php';

    $sbslActivator = new SBShippingLocationActivator();
    $sbslActivator->activate();

}

function sb_shipping_location_desactivate(){
    
}

//register_activation_hook(__File__, 'sb_shipping_location_activate');
register_deactivation_hook(__File__, 'sb_shipping_location_desactivate');

/**
* plugin initialization 
*/
require plugin_dir_path(__FILE__) . 'includes/class-sb-shipping-location.php';

function run_sb_shipping_location(){
    $SBShippingLocation = new SBShippingLocation();
    $SBShippingLocation->run();
}

run_sb_shipping_location();
sb_shipping_location_activate();