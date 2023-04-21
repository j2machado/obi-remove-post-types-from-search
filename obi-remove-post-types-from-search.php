<?php

/**
 * Plugin Name: Obi Remove Post Types from Search
 * Description: Include or exclude (custom) post types from the WordPress search feature.
 * Version: 1.0.0
 * Author: Obi Juan
 * Author URI: https://obijuan.dev
 * Plugin URI: https://obijuan.dev/obi-remove-post-types-from-search
 * License: GPL2 or later
 * Textdomain: obi-remove-post-types-from-search
 * @since 1.0.0 
 * 
 */

 if( ! defined('ABSPATH')){

    exit('Trying what?');

 }

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use ObiRemovePostTypesFromSearch\AdminPage;

 final class Obi_Init{

    private static $instance;

    private function __construct(){

        self::define_constants();

    }

    public static function get_instance(){

        if( ! isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;

    }

    private static function define_constants(){
     
        define( 'OBI_REMOVE_POST_TYPES_FROM_SEARCH_VERSION', '1.0.0' );
        define( 'OBI_REMOVE_POST_TYPES_FROM_SEARCH__TEXTDOMAIN', 'obi-remove-post-types-from-search');
        define( 'OBI_REMOVE_POST_TYPES_FROM_SEARCH_DIRNAME', plugin_basename( dirname(__FILE__) ) );
        define( 'OBI_REMOVE_POST_TYPES_FROM_SEARCH_FILE', __FILE__);
        define( 'OBI_REMOVE_POST_TYPES_FROM_SEARCH_PREFIX', 'obi_remove_post_types_from_search');
        define( 'OBI_REMOVE_POST_TYPES_FROM_SEARCH_PATH', plugin_dir_path( OBI_REMOVE_POST_TYPES_FROM_SEARCH_FILE ) );
        define( 'OBI_REMOVE_POST_TYPES_FROM_SEARCH_URL', plugin_dir_url( OBI_REMOVE_POST_TYPES_FROM_SEARCH_FILE ) );
    
    }

    public static function load_obi_plugin(){
        // On plugins loaded...
        AdminPage::get_instance();
    }

    public static function activate(){

        // On plugin activation...

    }

    public static function deactivate(){

        // On plugin deactivation...

    }

 }


 $obi_plugin = Obi_Init::get_instance();

 register_activation_hook( OBI_REMOVE_POST_TYPES_FROM_SEARCH_FILE, array( $obi_plugin, 'activate') );
 add_action('plugins_loaded', array( $obi_plugin, 'load_obi_plugin') );