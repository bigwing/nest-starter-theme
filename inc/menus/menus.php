<?php
class nest_Menus {
    public function __construct() {
        add_action( 'init', function() {
            register_nav_menus(array( // Using array to specify more menus if needed
            	'social-menu' => 'Social Menu',
            	'header-top-utility-nav' => 'Header Top Menu',
                'header-nav' => 'Header Main Menu',
                'footer-nav' => 'Footer Menu' // Footer Navigation
            ));
        } );
    }
}
new nest_Menus();