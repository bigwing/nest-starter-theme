<?php
// Register Post Type and Taxonomy and Shortcode
add_action( 'init', 'nest_testimonials_register' );
function nest_testimonials_register() {
	// Make sure ACF is installed before adding post type
	if ( ! function_exists( 'acf_add_local_field_group' ) ) { return;
	}

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'bigwing-nest' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'bigwing-nest' ),
		'menu_name'             => __( 'Testimonials', 'bigwing-nest' ),
		'name_admin_bar'        => __( 'Testimonial', 'bigwing-nest' ),
		'archives'              => __( 'Testimonial Archives', 'bigwing-nest' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'bigwing-nest' ),
		'all_items'             => __( 'All Testimonials', 'bigwing-nest' ),
		'add_new_item'          => __( 'Add New Testimonial', 'bigwing-nest' ),
		'add_new'               => __( 'Add New', 'bigwing-nest' ),
		'new_item'              => __( 'New Testimonial', 'bigwing-nest' ),
		'edit_item'             => __( 'Edit Testimonial', 'bigwing-nest' ),
		'update_item'           => __( 'Update Testimonial', 'bigwing-nest' ),
		'view_item'             => __( 'View Testimonial', 'bigwing-nest' ),
		'search_items'          => __( 'Search Testimonial', 'bigwing-nest' ),
		'not_found'             => __( 'Not found', 'bigwing-nest' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bigwing-nest' ),
		'featured_image'        => __( 'Featured Image', 'bigwing-nest' ),
		'set_featured_image'    => __( 'Set featured image', 'bigwing-nest' ),
		'remove_featured_image' => __( 'Remove featured image', 'bigwing-nest' ),
		'use_featured_image'    => __( 'Use as featured image', 'bigwing-nest' ),
		'insert_into_item'      => __( 'Insert into item', 'bigwing-nest' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bigwing-nest' ),
		'items_list'            => __( 'Testimonials list', 'bigwing-nest' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'bigwing-nest' ),
		'filter_items_list'     => __( 'Filter items list', 'bigwing-nest' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'bigwing-nest' ),
		'description'           => __( 'Testimonials', 'bigwing-nest' ),
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
			'with_front' => false,
		),
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonials', $args );

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'bigwing-nest' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'bigwing-nest' ),
		'menu_name'                  => __( 'Categories', 'bigwing-nest' ),
		'all_items'                  => __( 'All Categories', 'bigwing-nest' ),
		'parent_item'                => __( 'Parent Category', 'bigwing-nest' ),
		'parent_item_colon'          => __( 'Parent Category:', 'bigwing-nest' ),
		'new_item_name'              => __( 'New Category Name', 'bigwing-nest' ),
		'add_new_item'               => __( 'Add New Category', 'bigwing-nest' ),
		'edit_item'                  => __( 'Edit Category', 'bigwing-nest' ),
		'update_item'                => __( 'Update Category', 'bigwing-nest' ),
		'view_item'                  => __( 'View Category', 'bigwing-nest' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'bigwing-nest' ),
		'add_or_remove_items'        => __( 'Add or remove Categories', 'bigwing-nest' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'bigwing-nest' ),
		'popular_items'              => __( 'Popular Categories', 'bigwing-nest' ),
		'search_items'               => __( 'Search Categories', 'bigwing-nest' ),
		'not_found'                  => __( 'Not Found', 'bigwing-nest' ),
		'no_terms'                   => __( 'No Categories', 'bigwing-nest' ),
		'items_list'                 => __( 'Categories list', 'bigwing-nest' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'bigwing-nest' ),
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

	// Shortcode
	add_shortcode( 'testimonial', 'nest_testimonial' );
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
	$return['excerpt'] = get_field( 'excerpt' );
	$content = get_field( 'full_content' );
	if ( $content ) {
		$return['content'] = $content;
	}

	// Image ID
	$reviewer_image = get_field( 'reviewer_image' );
	if ( $reviewer_image ) {
		$return['image_id'] = $reviewer_image['id'];
	}

	// Location
	$location = get_field( 'location' );
	if ( $location ) {
		$return['location'] = $location;
	}

	// Organization Name
	$organization_name = get_field( 'organization_name' );
	if ( $organization_name ) {
		$return['organization_name'] = $organization_name;
	}

	// Organization Address
	$address = get_field( 'organization_address' );
	if ( $address ) {
		$return['address'] = $address;
	}

	// Phone Number
	$phone = get_field( 'organization_phone_number' );
	if ( $phone ) {
		$return['phone'] = $phone;
	}

	// Organization Name
	$website = get_field( 'organization_website' );
	if ( $website ) {
		$return['website'] = $website;
	}
	return $return;
}

// Shortcode Output
// Example shortcode: [testimonial cat='all' id='0' limit='5' archive='true' bullets='true']
function nest_testimonial( $args = array() ) {
	$args = shortcode_atts( array(
		'cat'     => 'all',
		'id'      => 0,
		'limit'   => 5,
		'archive' => 'false',
		'bullets' => 'true',
	), $args, 'testimonials' );

	ob_start();
	global $wp_query;
	$temp = $wp_query;
	$query_args = array(
		'post_type'      => 'testimonials',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'posts_per_page' => $args['limit'],
	);
	if ( 'all' !== $args['cat'] ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field'    => 'slug',
				'terms'    => $args['cat'],
			),
		);
	}
	if ( 0 !== $args['id'] ) {
		$query_args['p'] = $args['id'];
	}
	$wp_query = new WP_Query( $query_args );
	if ( have_posts() ) {
		$bullet_titles = array();
		$testimonial_count = 0;
		echo '<div class="orbit testimonials testimonials-shortcode" role="region" aria-label="Testimonials" data-orbit data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;">';
		echo '<ul class="orbit-container testimonial-content">';
		echo '<button class="orbit-previous"><span class="show-for-sr">Previous Testimonial</span>&#9664;&#xFE0E;</button>';
		echo '<button class="orbit-next"><span class="show-for-sr">Next Testimonial</span>&#9654;&#xFE0E;</button>';
		while ( have_posts() ) {
			the_post();
			$bullet_titles[] = get_the_title();
			$class = 'orbit-slide';
			if ( 0 == $testimonial_count ) {
				$class = 'is-active orbit-slide';
			}
			echo sprintf( '<li class="%s">', esc_attr( $class ) );
			get_template_part( 'parts/testimonial', 'shortcode' );
			echo '</li>';
			$testimonial_count += 1;
		}
		echo '</ul>';

		$bullet_count = 0;
		if ( 0 < count( $bullet_titles ) && 'true' == $args['bullets'] ) {
			echo '<nav class="orbit-bullets">';
			foreach ( $bullet_titles as $bullet_title ) {
				if ( 0 == $bullet_count ) {
					echo sprintf( '<button class="is-active" data-slide="0"><span class="show-for-sr">%s.</span><span class="show-for-sr">Current Slide</span></button>', esc_html( $bullet_title ) );
				} else {
					echo sprintf( '<button data-slide="%d"><span class="show-for-sr">%s</span></button>', esc_attr( $bullet_count ), esc_html( $bullet_title ) );
				}

				$bullet_count += 1;
			}
			echo '</nav>';
		}
		if ( 'true' == $args['archive'] ) {
			printf( '<a href="%s" class="button ffab fa-arrow-right">View All Testimonials</a>', esc_url( home_url( '/testimonials' ) ) );
		}

		echo '</div>';
	}// End if().

	$wp_query = $temp;
	wp_reset_query();
	return ob_get_clean();
}

// ACF
if ( function_exists( 'acf_add_local_field_group' ) ) :

	acf_add_local_field_group(array(
		'key' => 'group_57a366c2db6d9',
		'title' => 'Testimonials',
		'fields' => array(
		array(
			'key' => 'field_57a366cd54509',
			'label' => 'Excerpt',
			'name' => 'excerpt',
			'type' => 'textarea',
			'instructions' => 'On a testimonial slider, the excerpt will show.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Place excerpt here with no new paragraphs',
			'maxlength' => '',
			'rows' => 4,
			'new_lines' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_57a3679a5450a',
			'label' => 'Full Content',
			'name' => 'full_content',
			'type' => 'wysiwyg',
			'instructions' => 'Place the full testimonial here. If none is filled out, the excerpt will be used instead.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array(
			'key' => 'field_57a367f45450c',
			'label' => '',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '<h3>The following fields are optional</h3>',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array(
			'key' => 'field_57a367d15450b',
			'label' => 'Reviewer Image',
			'name' => 'reviewer_image',
			'type' => 'image',
			'instructions' => 'Image must be a square (1:1) ratio',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_57a368275450d',
			'label' => 'Location',
			'name' => 'location',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_57a3682d5450e',
			'label' => 'Organization Name',
			'name' => 'organization_name',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_57a3683f5450f',
			'label' => 'Organization Address',
			'name' => 'organization_address',
			'type' => 'textarea',
			'instructions' => 'Two lines for the address',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 2,
			'new_lines' => 'wpautop',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_57a3686254510',
			'label' => 'Organization Phone Number',
			'name' => 'organization_phone_number',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_57a3687654511',
			'label' => 'Organization Website',
			'name' => 'organization_website',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		),
		'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'testimonials',
			),
		),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;
