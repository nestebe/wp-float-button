<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}else{
	delete_option( 'dw_float_setting_pages' );
	delete_option( 'dw_float_config' );
}