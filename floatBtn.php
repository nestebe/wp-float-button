<?php

/**
 * Plugin Name:    WP Float Button
 * Description:     A Float button plugin for wordpress
 * Version: 1.0.0
 * Author: Nicolas ESTEBE
 * Author URI: https://www.dev-worker.com

 *
 */


require_once( 'backend/class.backend_loader.php' );
require_once( 'frontend/class.frontend_loader.php' );

$backendLoader = new Backend_Loader();
$backendLoader->init();


$backendLoader = new Frontend_Loader();
$backendLoader->init();


function disable_wp_plugin_float_btn() {

	delete_option( 'dw_float_setting_pages' );
	delete_option( 'dw_float_config' );

}
function uninstall_wp_plugin_float_btn() {

	delete_option( 'dw_float_setting_pages' );
	delete_option( 'dw_float_config' );
	return;

}



