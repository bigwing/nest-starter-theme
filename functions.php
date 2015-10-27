<?php
if (!isset($content_width))
{
    $content_width = 900;
}

add_action( 'after_setup_theme', function() {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('slider', 1000, 350, true); // Slider Image

 
    //NEW HTML5 Galleries

    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    
    /* Since WordPress 4.1 */
    add_theme_support( 'title-tag' );

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('opubco', get_template_directory() . '/languages');
} );
require( 'inc/utilities/utility-functions.php' );
require( 'inc/utilities/quick-edit-links.php' );
require( 'inc/utilities/social.php' );
require( 'inc/actions/default-actions.php' );
require( 'inc/filters/default-filters.php' );
require( 'inc/menus/menus.php' );
require( 'inc/widgets/widgets.php' );
require( 'inc/customizer/customizer.php' );

function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

add_action( 'login_enqueue_scripts', 'sourcexpress_login_enqueue_scripts', 10 );
function sourcexpress_login_enqueue_scripts() {
    wp_enqueue_script( 'login.js', get_template_directory_uri() . '/js/login.js', array( 'jquery' ), 1.0 );
}
