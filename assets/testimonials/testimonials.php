<?php
// Register Post Type and Taxonomy
add_action( 'init', 'nest_testimonials_register' );
function nest_testimonials_register() {
	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Testimonials', 'text_domain' ),
		'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
		'archives'              => __( 'Testimonial Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'text_domain' ),
		'all_items'             => __( 'All Testimonials', 'text_domain' ),
		'add_new_item'          => __( 'Add New Testimonial', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Testimonial', 'text_domain' ),
		'edit_item'             => __( 'Edit Testimonial', 'text_domain' ),
		'update_item'           => __( 'Update Testimonial', 'text_domain' ),
		'view_item'             => __( 'View Testimonial', 'text_domain' ),
		'search_items'          => __( 'Search Testimonial', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Testimonials list', 'text_domain' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'text_domain' ),
		'description'           => __( 'Testimonials', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'menu_icon'                  => 'dashicons-format-status',
		'rewrite'               => array(
			'slug' => 'testimonials',
			'with_front' => false
		),
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonials', $args );
	
	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Categories', 'text_domain' ),
		'all_items'                  => __( 'All Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Category', 'text_domain' ),
		'update_item'                => __( 'Update Category', 'text_domain' ),
		'view_item'                  => __( 'View Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Categories', 'text_domain' ),
		'search_items'               => __( 'Search Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Categories', 'text_domain' ),
		'items_list'                 => __( 'Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'testimonial_category', array( 'testimonials' ), $args );
}

// Change default title placeholder
add_filter( 'enter_title_here', 'nest_testimonials_title_placeholder' );
function nest_testimonials_title_placeholder( $title ) {
	if ( 'testimonials' == get_post_type() ) {
		return 'Enter reviewer here';
	}
	return $title;
}

// Template function for retrieving a testimonial
function nest_get_testimonial( $post_id = 0 ) {
	global $post;
	if ( 0 == $post_id ) {
		$post_id == $post->ID;
	}
	$return = array();
	// Content
	
	$return[ 'excerpt' ] = get_field( 'excerpt' );
	$content = get_field( 'full_content' );
	if ( $content ) {
		$return[ 'content' ] = $content;
	}
	
	// Image ID
	$reviewer_image = get_field( 'reviewer_image' );
	if ( $reviewer_image ) {
		$return[ 'image_id' ] = $reviewer_image[ 'id' ];
	}
	
	// Location
	$location = get_field( 'location' );
	if( $location ) {
		$return[ 'location' ] = $location;
	}
	
	// Organization Name
	$organization_name = get_field( 'organization_name' );
	if ( $organization_name ) {
		$return[ 'organization_name' ] = $organization_name;
	}
	
	// Organization Address
	$address = get_field( 'organization_address' );
	if ( $address ) {
		$return[ 'address' ] = $address;
	}
	
	// Phone Number
	$phone = get_field( 'organization_phone_number' );
	if ( $phone ) {
		$return[ 'phone' ] = $phone;
	}
	
	//Organization Name
	$website = get_field( 'organization_website' );
	if ( $website ) {
		$return[ 'website' ] = $website;
	}
	return $return; 
}