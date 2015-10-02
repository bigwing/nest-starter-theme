<?php
class nest_Menus {
    public function __construct() {
        add_action( 'init', function() {
            register_nav_menus(array( // Using array to specify more menus if needed
            	'social-nav' => 'Social Nav',
            	'header-top-nav' => 'Header Top Nav',
                'header-menu' => 'Header Main Menu',
                'footer-menu' => 'Footer Menu' // Footer Navigation
            ));
        } );
    }
}
new nest_Menus();