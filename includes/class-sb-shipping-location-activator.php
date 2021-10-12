<?php 

class SBShippingLocationActivator {

    public function activate(){
        global $wpdb;

        //create table to store paramaters

        if($wpdb->get_var("show table like 'wp_sbsl_parameters'") != 'wp_sbsl_parameters'){
            
        }

       
    } 

}