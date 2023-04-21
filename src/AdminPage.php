<?php

namespace ObiRemovePostTypesFromSearch;

class AdminPage{

    private static $instance;
    
    
    private function __construct(){

        //add_action( 'admin_menu', array($this, 'addOptionsPage'));

    }

    public static function get_instance(){

        if( ! isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;

    }

    private static function addOptionsPage(){

        add_options_page(
            'My Plugin Settings',
            'My Plugin',
            'manage_options',
            'myplugin-settings',
            function() {
              echo '<div id="myplugin-settings"></div>';
            }
          );

    }


}