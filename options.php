<?php

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Upload Logo', 'options_framework_theme'),
		'desc' => __('Upload your logo here.', 'options_framework_theme'),
		'id' => 'logo_upload',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Upload a Favicon', 'options_framework_theme'),
		'desc' => __('Upload your .ico here.', 'options_framework_theme'),
		'id' => 'favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __(' Contact Info', 'options_framework_theme'),
		'type' => 'section');

	$options[] = array(
		'name' => __('Street Address', 'options_framework_theme'),
		'desc' => __('Enter your street address.', 'options_framework_theme'),
		'id' => 'street-address',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('City', 'options_framework_theme'),
		'desc' => __('Enter your city.', 'options_framework_theme'),
		'id' => 'city',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('State', 'options_framework_theme'),
		'desc' => __('Enter your state.', 'options_framework_theme'),
		'id' => 'state',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Zip', 'options_framework_theme'),
		'desc' => __('Enter your zip code.', 'options_framework_theme'),
		'id' => 'zip',
		'type' => 'text');

	$options[] = array(
		'name' => __('Phone', 'options_framework_theme'),
		'desc' => __('Enter your company phone #.', 'options_framework_theme'),
		'id' => 'phone',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Social Media', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Facebook URL', 'options_framework_theme'),
		'desc' => __('Enter your Facebook URL.', 'options_framework_theme'),
		'id' => 'facebook',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter URL', 'options_framework_theme'),
		'desc' => __('Enter your Twitter URL.', 'options_framework_theme'),
		'id' => 'twitter',
		'type' => 'text');
	$options[] = array(
		'name' => __('Pinterest URL', 'options_framework_theme'),
		'desc' => __('Enter your Pinterest URL.', 'options_framework_theme'),
		'id' => 'pinterest',
		'type' => 'text');
	$options[] = array(
		'name' => __('YouTube URL', 'options_framework_theme'),
		'desc' => __('Enter your YouTube URL.', 'options_framework_theme'),
		'id' => 'youtube',
		'type' => 'text');
	$options[] = array(
		'name' => __('LinkedIn URL', 'options_framework_theme'),
		'desc' => __('Enter your LinkedIn URL.', 'options_framework_theme'),
		'id' => 'linkedin',
		'type' => 'text');
	$options[] = array(
		'name' => __('Instagram URL', 'options_framework_theme'),
		'desc' => __('Enter your Instagram URL.', 'options_framework_theme'),
		'id' => 'instagram',
		'type' => 'text');
	$options[] = array(
		'name' => __('Google Plus URL', 'options_framework_theme'),
		'desc' => __('Enter your Google Plus URL.', 'options_framework_theme'),
		'id' => 'google',
		'type' => 'text');

	return $options;
}