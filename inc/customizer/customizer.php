<?php
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
 require( 'class-customizer-address.php' );
add_action( 'customize_register', function( $wp_customize ) {
    
    /* Add Address Info to Customizer */
    $wp_customize->add_section( 
    	'nest_address_options', 
    	array(
    		'title'       => __( 'Address Settings', 'mytheme' ),
    		'priority'    => 800,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Address Settings', 'mytheme'), 
    	) 
    );
    /* Street */
    $wp_customize->add_setting( 'nest_street',
	array(
		'type' => 'option',
        )
    );
    
    /* City */
    $wp_customize->add_setting( 'nest_city',
	array(
		'type' => 'option',
        )
    );
    
    /* State */
    $wp_customize->add_setting( 'nest_state',
	array(
		'type' => 'option',
        )
    );
    
    /* Zip */
    $wp_customize->add_setting( 'nest_zip',
	array(
		'type' => 'option',
        )
    );
    
    /* Phone */
    $wp_customize->add_setting( 'nest_phone',
	array(
		'type' => 'option',
        )
    );
    
    /* Fax */
    $wp_customize->add_setting( 'nest_fax',
	array(
		'type' => 'option',
        )
    );
    
    /* E-mail */
    $wp_customize->add_setting( 'nest_email',
	array(
		'type' => 'option',
        )
    );
    
    /* Long */
    $wp_customize->add_setting( 'nest_long',
	array(
		'type' => 'option',
        )
    );
    
    /* Lat */
    $wp_customize->add_setting( 'nest_lat',
	array(
		'type' => 'option',
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Control( 
    	$wp_customize, 
    	'nest_street_address',
    	array(
    		'label'    => 'Street Address', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_street',
    		'priority' => 10,
    	)
    )); 
    $wp_customize->add_control( new WP_Customize_Control( 
    	$wp_customize, 
    	'nest_city',
    	array(
    		'label'    => 'City', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_city',
    		'priority' => 11,
    	)
    ));
    
    $wp_customize->add_control( new WP_Customize_Control( 
    	$wp_customize, 
    	'nest_state',
    	array(
    		'label'    => 'State', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_state',
    		'priority' => 11,
    	)
    ));
    
    $wp_customize->add_control( new WP_Customize_Control( 
    	$wp_customize, 
    	'nest_zip',
    	array(
    		'label'    => 'ZIP', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_zip',
    		'priority' => 11,
    	)
    ));
    
    $wp_customize->add_control( new WP_Customize_Control( 
    	$wp_customize, 
    	'nest_phone',
    	array(
    		'label'    => 'Phone Number', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_phone',
    		'priority' => 11,
    	)
    ));
    
    $wp_customize->add_control( new Nest_Address_Customizer_Control( 
    	$wp_customize, 
    	'nest_fax',
    	array(
    		'label'    => 'Fax Number', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_fax',
    		'priority' => 11,
    	)
    ));
    
    $wp_customize->add_control( new Nest_Address_Customizer_Control( 
    	$wp_customize, 
    	'nest_email',
    	array(
    		'label'    => 'E-mail Address', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_email',
    		'priority' => 11,
    	)
    ));
    
    $wp_customize->add_control( new Nest_Address_Customizer_Control( 
    	$wp_customize, 
    	'nest_long',
    	array(
    		'label'    => 'Longitude', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_long',
    		'priority' => 11,
    	)
    ));
    
    $wp_customize->add_control( new Nest_Address_Customizer_Control( 
    	$wp_customize, 
    	'nest_lat',
    	array(
    		'label'    => 'Latitude', 
    		'section'  => 'nest_address_options',
    		'settings' => 'nest_lat',
    		'priority' => 11,
    	)
    ));
    
    /* Retina */
    $wp_customize->add_setting( 'nest_retina_logo',
	array(
		'type' => 'option',
        )
    );
    
     /* Regular Logo */
    $wp_customize->add_setting( 'nest_logo',
	array(
		'type' => 'option',
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( 
    	$wp_customize, 
    	'nest_retina_logo',
    	array(
    		'label'    => 'Retina Logo', 
    		'section'  => 'title_tagline',
    		'settings' => 'nest_retina_logo',
    		'priority' => 300,
    	)
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( 
    	$wp_customize, 
    	'nest_logo',
    	array(
    		'label'    => 'Regular Logo', 
    		'section'  => 'title_tagline',
    		'settings' => 'nest_logo',
    		'priority' => 300,
    	)
    ));
    
       
}  );

