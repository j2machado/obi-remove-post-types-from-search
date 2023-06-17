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

        echo '<div class="wrap">';
        echo '<h1>My Plugin Options</h1>';
        echo '<div id="root"></div>';
        echo '</div>';

        echo '<div id="obi-remove-post-types-from-search-options"></div>';
    }

    public static function obi_enqueue_admin_scripts()
    {

        wp_enqueue_style('obi-options-styles', OBI_REMOVE_POST_TYPES_FROM_SEARCH_URL . 'assets/css/admin.css', array(), '1.0.0');
        wp_enqueue_script('obi-options-scripts', OBI_REMOVE_POST_TYPES_FROM_SEARCH_URL . 'dist/js/obi-options.js', array('wp-element'), '1.0.0', true);
        wp_localize_script('obi-options-ajax', 'obiOptions', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('obi-options')
        ));
    }
}
