<?php

namespace ObiRemovePostTypesFromSearch\Includes;

use WP_REST_Request;
use WP_REST_Response;

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
        register_rest_route('obiRCPT/v1', '/post-types', array(
            'methods' => 'GET',
            'callback' => [self::get_instance(), 'get_post_types_callback'],
            'permission_callback' => '__return_true'
        ));

        register_rest_route('obiRCPT/v1', '/update-post-type-status', array(
            'methods' => 'POST',
            'callback' => [self::get_instance(), 'update_post_type_status_callback'],
            'permission_callback' => function() {
                // Only allow administrators to update post type status
                return current_user_can('manage_options');
            }
        ));
    }

    public function get_post_types_callback() {
        $args = array(
            'public' => true,
        );

        $post_types = get_post_types($args, 'names', 'and'); 

        // Fetch the post type statuses from the database
        $post_type_statuses = get_option('obiRCPT_post_type_statuses', []);

        // If the post type statuses have not been initialized, return the post types as is
        if (empty($post_type_statuses)) {
            return $post_types;
        }

        // Return the post types with their corresponding statuses
        return array_map(function ($post_type) use ($post_type_statuses) {
            return isset($post_type_statuses[$post_type]) ? $post_type_statuses[$post_type] : true;
        }, array_flip($post_types));
    }

    public function update_post_type_status_callback(WP_REST_Request $request) {
        // Extract the new post type status from the request
        $post_type_status = $request->get_json_params();

        // Update the post type status in the database
        update_option('obiRCPT_post_type_statuses', $post_type_status);

        return new WP_REST_Response('Post type status updated successfully.', 200);
    }

    public static function initialize_post_type_statuses() {
        $initialized = get_option('obiRCPT_post_type_statuses_initialized', false);

        if (!$initialized) {
            $args = array(
                'public' => true,
            );

            $post_types = get_post_types($args, 'names', 'and'); 

            $post_type_statuses = [];

            foreach ($post_types as $post_type) {
                $post_type_object = get_post_type_object($post_type);
                $post_type_statuses[$post_type] = !$post_type_object->exclude_from_search;
            }

            update_option('obiRCPT_post_type_statuses', $post_type_statuses);
            update_option('obiRCPT_post_type_statuses_initialized', true);
        }
    }
}
