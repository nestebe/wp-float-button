<?php


class Frontend_Loader {
	public function init() {//define page render rules...
		$this->attach_hooks();
	}

	public function attach_hooks() {


		add_action( 'wp_footer', array( $this, 'insert_float_button' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front' ) );

	}

	public function enqueue_front() {
		//load js and css
		// wp_enqueue_style("material-icons.css", plugin_dir_url(dirname(__FILE__)) . 'backend/vue-admin-interface/src/assets/material-icon/iconfont/material-icons.css');

		wp_enqueue_style( 'animate', plugin_dir_url( dirname( __FILE__ ) ) . 'frontend/vue-frontend-interface/src/assets/animate.css' );
		wp_enqueue_script( 'variable-float-btn', plugin_dir_url( dirname( __FILE__ ) ) . 'frontend/vue-frontend-interface/dist/variable.js', array( 'jquery' ), '', true );


		// wp_localize_script( 'variable-float-btn', 'floatBtnConfig', $resp  );

		wp_enqueue_script( 'dw-float-btn', plugin_dir_url( dirname( __FILE__ ) ) . 'frontend/vue-frontend-interface/dist/dw-float-btn.js', array( 'jquery' ), '', true );
		$resp = get_option( 'dw_float_config' );
		wp_localize_script( 'dw-float-btn', 'config_float_btn', $resp );


	}

	public function insert_float_button() {
		$setting_pages = get_option( 'dw_float_setting_pages' );

		if ( $setting_pages ) {
			if ( $setting_pages['activeSelectPage'] == "true" ) {
				$pages = $setting_pages['selectedPages'];
				foreach ( $pages as $value ) {
					if ( get_the_ID() == $value ) {

						echo '<div id="dw_float_btn"></div>';
						break;
					}

				}


			} else {
				echo '<div id="dw_float_btn"></div>';
			}
		}
	}

	public function get_option_floatbtn() {
		global $wpdb; // this is how you get access to the database

		$resp = get_option( 'dw_float_config' );

		echo json_encode( $resp );
		wp_die(); // this is required to terminate immediately and return a proper response
	}
}
