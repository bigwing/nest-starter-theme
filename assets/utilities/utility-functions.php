<?php
//Set constants
if ( !defined( 'WP_POST_REVISIONS' ) ) define( 'WP_POST_REVISIONS', 5 );
if ( !defined( 'DISALLOW_FILE_EDIT' ) ) define( 'DISALLOW_FILE_EDIT', true );

/* Debugging function */
if ( !function_exists( 'wp_print_r' ) ) {
	function wp_print_r( $args, $die = true ) {
		$echo = '<pre>' . print_r( $args, true ) . '</pre>';
		if ( $die ) die( $echo );
		else echo $echo;
	}
}
function nest_custom_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    $content = get_the_content();
    $trimmed_content = wp_trim_words( $content, $length_callback, '... <a class="more" href="'. get_permalink() .'">' .$more_callback .'</a>' );
    echo $trimmed_content;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function nest_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

function nest_copyright( $start_year = false, $echo = true ) {
	//Ensure there is a range if the $start_year and $end_year are different (e.g., 2014-2015)
	$start_year = (string)$start_year;
	$end_year = date( 'Y' );
	if ( $start_year === $end_year || $start_year === false ) {
		$copyright_string = sprintf( '&copy; %s', $end_year );
	} else {
		$copyright_string = sprintf( '&copy; %s-%s', $start_year, $end_year );
	}

	if ( $echo ) {
		echo $copyright_string;
	} else {
		return $copyright_string;
	}
}

//Get attachment image ID from URL
function nest_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

/*$type can be 'retina' for full size. $size can be an array or string. $echo true or false */
function nest_get_logo_img( $type = 'retina', $size = array(), $echo = true ) {
    $option_name = '';
    if ( $type == 'retina' ) {
        $option_name = 'nest_retina_logo';
    } else {
        $option_name = 'nest_logo';   
    }
    
    $attachment_url = get_option( $option_name, false );
    
    if ( empty( $size ) ) {
        if ( $echo ) {
            echo sprintf( '<img src="%s" />', $attachment_url );  
            return; 
        } else {
            return sprintf( '<img src="%s" />', $attachment_url );;   
        }
    }
    $attachment_id = nest_get_attachment_id_from_url(  $attachment_url );
    $image = wp_get_attachment_image( $attachment_id, $size );
    if ( $echo ) {
        echo $image;   
    } else {
        return $image;
    }   
    
        
}

function nest_get_logo_srcset( $id = 'logo-image' ) {
    $output = array();
    $output[ 'retina' ] = get_option( 'nest_retina_logo', false );
    $output[ 'nonretina' ] = get_option( 'nest_retina_logo', false );

    $return = sprintf( '<img src="%1$s" srcset="%1$s 1x, %2$s 2x" id="%3$s" alt="logo" />', get_option( 'nest_logo', '' ), get_option( 'nest_retina_logo', '' ), esc_attr( $id ) ); 
    return $return;
}

function nest_the_title_unfiltered( $post_id = 0, $echo = true ) {
    global $post;
    if ( is_object( $post ) || 0 == $post_id ) {
        $post_id = $post->ID;   
    }
    remove_filter( 'the_title', 'nest_the_title', 10, 2 );
    $title = get_the_title( $post_id );
    add_filter( 'the_title', 'nest_the_title', 10, 2 );
    
    if ( $echo ) {
        echo $title;   
    } else {
        return $title;
    }
}


function nest_format_content( $content ) {
    return apply_filters( 'nest_the_content', $content );   
}
function nest_custom_title( $post_id = 0, $before = '', $after = '', $echo = true ) {
	if ( 0 == $post_id ) {
		$post_id = get_the_ID();
	}
	ob_start();
	echo $before;
    $title = get_post_meta( $post_id, '_custom_h1', true );
    if ( false == $title || empty( $title ) ) {
		echo esc_html( get_the_title( $post_id ) );	    
    } else {
	    echo esc_html( $title ); 
    }
    echo $after;
    $title = ob_get_clean();
    if ( $echo ) {
	    echo $title;
    } else {
	    return $title;
    }
}