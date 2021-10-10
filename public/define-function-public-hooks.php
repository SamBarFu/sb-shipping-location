<?php 

function sbsl_woocommerce_after_checkout_billing_form(){
    include( plugin_dir_path( __FILE__ ) . "templates/sb-shipping-location-map-picker.php");
}

function sbsl_styles(){
    wp_enqueue_style('sb-shipping-styles', plugin_dir_url(__FILE__) . 'css/sb-shipping-styles.css', false, '1.0.0');

    /*
    ** here map */
    wp_enqueue_style('here-map-ui-css', 'https://js.api.here.com/v3/3.1/mapsjs-ui.css', array(), '1.0.0', false);
}

function sbsl_scripts(){

    /* 
    ** google map */
    wp_enqueue_script('google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDSholZYCRzYG8JNoBPsYMsmg7s5VoR18A&libraries=places', array('jquery'), '1.0.0', false);
    wp_enqueue_script('sb-shipping-location-googlemap-picker', plugin_dir_url(__FILE__) . 'js/sb-shipping-location-googlemap-picker.js', array('jquery'), '1.0.0', false);

    /*
    ** here map */
    wp_enqueue_script('here-map-core','https://js.api.here.com/v3/3.1/mapsjs-core.js', array('jquery'), '1.0.0', false);
    wp_enqueue_script('here-map-service','https://js.api.here.com/v3/3.1/mapsjs-service.js', array('jquery'), '1.0.0', false);
    wp_enqueue_script('here-map-events','https://js.api.here.com/v3/3.1/mapsjs-mapevents.js', array('jquery'), '1.0.0', false);
    wp_enqueue_script('here-map-ui-js','https://js.api.here.com/v3/3.1/mapsjs-ui.js', array('jquery'), '1.0.0', false);
    
    wp_enqueue_script('sb-shipping-location-heremap-picker', plugin_dir_url(__FILE__) . 'js/sb-shipping-location-heremap-picker.js', array('jquery'), '1.0.0', false);
}
