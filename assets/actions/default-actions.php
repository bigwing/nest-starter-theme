<?php
add_action( 'wp_enqueue_scripts', 'nest_header_scripts' ); // Add Custom Scripts to wp_head
add_action( 'get_header', 'nest_enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'wp_enqueue_scripts', 'nest_theme_styles' ); // Add Theme Stylesheet
add_action( 'widgets_init', 'nest_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 'nest_pagination' ); // Add our HTML5 Pagination

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Threaded Comments
function nest_enable_threaded_comments() {
	if ( ! is_admin() ) {
		if ( is_singular() and comments_open() and (get_option( 'thread_comments' ) == 1) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

function nest_header_scripts() {

}

function nest_theme_styles() {

}

// Remove wp_head() injected Recent Comment styles
function nest_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style',
	));
}

// ADD HOMEPAGE EDIT LINK IN ADMIN MENU UNDER DASHBOARD MENU
add_action( 'admin_menu' , function() {
	global $submenu;

	 $front_page = get_option( 'page_on_front' );

	if ( $front_page != 0 ) {
		$submenu['index.php'][500] = array( 'Edit Home Page', 'manage_options' , get_edit_post_link( $front_page ) );
	}
} );

// ADD HOMEPAGE EDIT LINK TO ADMIN BAR
add_action('admin_bar_menu', function( $admin_bar ) {
	$front_page = get_option( 'page_on_front' );

	if ( $front_page != 0 ) {
		$admin_bar->add_menu( array(
			'id'    => 'edit-home',
			'parent' => 'site-name',
			'title' => 'Edit Home Page',
			'href'  => get_edit_post_link( $front_page ),
			'meta'  => array(
				'title' => __( 'Edit Home Page' ),
			),
		) );
	}
} ,999);


/*
 * Adds a bright red box on localhost
 * Box contains the server name
 *
 * @author Ryan Hellyer <ryanhellyer@gmail.com>
 */
function nest_localhost() {
	// Do check for localhost IP (remove this if you want to ALWAYS display it)
	if ( '127.0.0.1' != $_SERVER['REMOTE_ADDR'] && '::1' != $_SERVER['REMOTE_ADDR'] ) {
		return;
	}
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG == true ) {
		$debug = 'WP_DEBUG=ON';
	} else {
		$debug = 'WP_DEBUG=OFF';
	}
	echo '
		<div style="
			position: fixed;
			right: 10px;
			bottom: 10px;
			width: auto;
			padding: 0 8px;
			height: 22px;
			background: #ff0000;
			border-radius: 5px;
			box-shadow: 0 2px 5px 2px rgba(0,0,0,0.3);
			z-index: 99999999999999;

			font-family: sans-serif;
			font-size: 13px;
			line-height: 22px;
			color: #fff;
			font-weight: bold;
			text-align: center;
			text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
		">' . php_uname( 'n' ) . ' ' . $debug . '</div>';
}
add_action( 'wp_footer', 'nest_localhost' );
add_action( 'admin_footer', 'nest_localhost' );


/*
 Easy filter for filtering content */
/* $text = apply_filters( 'nest_the_content', 'text to filter' ); */
add_action( 'init', 'nest_the_content', 1 );
function nest_the_content() {
	// Create our own version of the_content so that others can't accidentally loop into our output - Taken from default-filters.php, shortcodes.php, and media.php
	if ( ! has_filter( 'nest_the_content', 'wptexturize' ) ) {
		add_filter( 'nest_the_content', 'wptexturize' );
		add_filter( 'nest_the_content', 'convert_smilies' );
		add_filter( 'nest_the_content', 'convert_chars' );
		add_filter( 'nest_the_content', 'wpautop' );
		add_filter( 'nest_the_content', 'shortcode_unautop' );
		add_filter( 'nest_the_content', 'prepend_attachment' );
		$vidembed = new WP_Embed();
		add_filter( 'nest_the_content', array( &$vidembed, 'run_shortcode' ), 8 );
		add_filter( 'nest_the_content', array( &$vidembed, 'autoembed' ), 8 );
		add_filter( 'nest_the_content', 'do_shortcode', 11 );
	} // End if().
} //end nest_the_content

/* Disable Admin Bar for all users who are not administrators */
add_action( 'after_setup_theme', 'nest_remove_admin_bar' );
function nest_remove_admin_bar() {
	if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
		show_admin_bar( false );
	}
}

