<?php 
    /*
    Plugin Name: Bimbler Reminders
    Plugin URI: http://www.bimblers.com
    Description: Plugin to notify users of up-coming events.
    Author: Paul Perkins
    Version: 0.1
    Author URI: http://www.bimblers.com
    */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
        die;
} // end if

require_once( plugin_dir_path( __FILE__ ) . 'class-bimbler-reminders.php' );

Bimbler_Reminders::get_instance();
