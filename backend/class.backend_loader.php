<?php



class Backend_Loader
{
    public function init()
    {
        $this->attach_hooks();
    }

    public function attach_hooks()
    {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin' ));

        //ajax action: update_option_floatbtn
        add_action('wp_ajax_update_option_floatbtn', array( $this,'update_option_floatbtn'));
        add_action('wp_ajax_update_option_setting_pages', array( $this,'update_option_setting_pages'));
        add_action('wp_ajax_get_all_pages', array( $this,'get_all_pages'));
        
        
        //setting page
        add_action('admin_menu', array( $this, 'dw_setting_plugin_page' ));
    }

    public function enqueue_admin()
    {
        //load js and css
        wp_enqueue_style("materialcss", plugin_dir_url(dirname(__FILE__)) . 'backend/vue-admin-interface/src/assets/material-icon/iconfont/material-icons.css');
        wp_enqueue_script('dw-float-manifest', plugin_dir_url(dirname(__FILE__)) . 'backend/vue-admin-interface/dist/dw-float-manifest.js', array( 'jquery' ), '', true);
        wp_enqueue_script('dw-float-vendor', plugin_dir_url(dirname(__FILE__)) . 'backend/vue-admin-interface/dist/dw-float-vendor.js', array( 'dw-float-manifest' ), '', true);
        wp_enqueue_script('dw-float-index', plugin_dir_url(dirname(__FILE__)) . 'backend/vue-admin-interface/dist/dw-float-index.js', array( 'dw-float-vendor' ), '', true);

        $float_config = get_option('dw_float_config');
        if($float_config == false){
            $float_config = array();
        }
        wp_localize_script('dw-float-index', 'config_float_btn', $float_config);

        $setting_pages = get_option('dw_float_setting_pages');
        if($setting_pages == false){
            $setting_pages = array();
        }

        wp_localize_script('dw-float-index', 'config_setting_pages', $setting_pages);

        $allPages = $this->get_all_pages();

        wp_localize_script('dw-float-index', 'allPages', $allPages);
    }
    


    public function dw_setting_plugin_page()
    {
        add_submenu_page("options-general.php", 'Plugin DW', "Settings Float Button", 'administrator', 'floatBtn', array( $this, 'floatbtn_setting_content' ));
    }
    
    public function floatbtn_setting_content()
    {
        include('vue-admin-interface/setting_page.php');
    }

    public function update_option_floatbtn()
    {
     
        
      //  $whatever = json_decode($_POST["floatConfig"]);
        update_option('dw_float_config', $_POST["floatConfig"]);
        $resp = get_option('dw_float_config');
        
        echo  json_encode($resp) ;
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    public function update_option_setting_pages()
    {
        update_option('dw_float_setting_pages', $_POST["setting_pages"]);
        $resp = get_option('dw_float_setting_pages');

        
        echo  json_encode($resp) ;
        wp_die(); // this is required to terminate immediately and return a proper response
    }


    public function get_all_pages()
    {
        global $wpdb;
        $nom_table = $wpdb->prefix . 'posts';
        $requete = "SELECT ID as 'value', post_name as label FROM  $nom_table WHERE post_type='page'  ";
        $resultat = $wpdb->get_results($requete);

        return $resultat ;
        // wp_die();
    }


    public function update_render_page()
    {
    }
}
