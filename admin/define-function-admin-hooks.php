<?php 

function sbsl_styles_admin(){
    wp_enqueue_style('sbsl-admin-styles', plugin_dir_url( __FILE__ ) . 'css/sbsl-admin-styles.css', false, '1.0.0');
}

function sbsl_scripts_admin(){

    wp_enqueue_script('here-map-core','https://js.api.here.com/v3/3.1/mapsjs-core.js', array('jquery'), '1.0.0', false);
    wp_enqueue_script('here-map-service','https://js.api.here.com/v3/3.1/mapsjs-service.js', array('jquery'), '1.0.0', false);

    wp_enqueue_script('sbsl-ajax-admin', plugin_dir_url( __FILE__ ) . 'js/sbsl-ajax-admin.js', array('jquery'), '1.0.0', false);

   /*  wp_localize_script('sbsl-ajax-admin', 'ajax_var', array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sbsl-apikey'),
        'action' => 'veriy-apikey'
    )); */

}
