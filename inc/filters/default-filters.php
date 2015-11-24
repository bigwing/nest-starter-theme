<?php

// Add Filters
add_filter('body_class', 'nest_add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'nest_view_article'); // Add 'View Article' button instead of [...] for Excerpts

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function nest_add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}
// Custom View Article link to Post
function nest_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'opubco') . '</a>';
}


add_filter( 'the_title', 'nest_the_title', 10, 2 );
function nest_the_title( $title, $post_id = 0 ) {
    
    if ( is_admin() ) return $title;
	
    if ( in_the_loop() ) {
        if( get_post_meta( $post_id,'custom_h1', true ) ){
            return get_post_meta( $post_id,'custom_h1', true );
        } else{
          return $title;  
        }
    } else {
	    $custom_h1 = get_post_meta( $post_id, 'custom_h1', true );
	    if ( $custom_h1 ) {
			$custom_h1 = trim( $custom_h1 );
			if ( !empty( $custom_h1 ) ) {
				$title = $custom_h1;
			}
	    }
    }

    return $title;
}

/*------------------------------------*\
    Disable comments on media pages
\*------------------------------------*/
function nest_filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'nest_filter_media_comment_status', 10 , 2 );
