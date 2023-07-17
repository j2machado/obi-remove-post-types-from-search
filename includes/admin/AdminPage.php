<?php

namespace ObiRemovePostTypesFromSearch\Includes\Admin;

if (!defined('ABSPATH')) {
    exit('Trying what?');
}

class AdminPage
{

    private static $instance;


    private function __construct()
    {

        add_action('admin_menu', array(__CLASS__, 'registerOptionsPage'));

        add_action('admin_enqueue_scripts', array($this, 'obi_enqueue_admin_scripts'));
    }

    public static function get_instance()
    {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function registerOptionsPage()
    {


        add_menu_page(
            __('Remove CPTs from Search', OBI_REMOVE_POST_TYPES_FROM_SEARCH__TEXTDOMAIN),
            __('Remove CPTs from Search', OBI_REMOVE_POST_TYPES_FROM_SEARCH__TEXTDOMAIN),
            'manage_options',
            'obi-remove-post-types-from-search',
            array(__CLASS__, 'obi_options_page_callback')
        );
    }

    public static function obi_options_page_callback()
    {

        echo '<div id="obi-remove-post-types-from-search-options"></div>';
    }

    public static function obi_enqueue_admin_scripts() {
        //wp_enqueue_style('obi-options-styles', OBI_REMOVE_POST_TYPES_FROM_SEARCH_URL . 'assets/css/admin.css', array(), '1.0.0');
    
        // ensure this is the script you are using in the front end
        wp_enqueue_script('obi-options-scripts', OBI_REMOVE_POST_TYPES_FROM_SEARCH_URL . 'dist/js/obi-options.js', array('wp-element', 'wp-api'), '1.0.0', true);
    
        // localize right after enqueuing the script
        wp_localize_script('obi-options-scripts', 'obiOptions', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('wp_rest'),
            'root' => esc_url_raw(rest_url()),
        ));
    }
    
}
