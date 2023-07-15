<?php

namespace ObiRemovePostTypesFromSearch\Includes;

class PostTypes {

    private static $instance;

    private function __construct() {
        add_action( 'rest_api_init', array(__CLASS__, 'register_post_types_endpoints' ) );
    }

    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function register_post_types_endpoints() {
        register_rest_route('myplugin/v1', '/post-types', array(
            'methods' => 'GET',
            'callback' => [self::get_instance(), 'get_post_types_callback'],
            'permission_callback' => '__return_true'
        ));
    }

    public function get_post_types_callback() {
        $args = array(
            'public' => true,
        );

        $post_types = get_post_types($args, 'names', 'and'); 

        return $post_types;
    }
}
