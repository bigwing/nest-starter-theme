<?php
// Custom H1
if( function_exists('acf_add_local_field_group') ):
$nest_post_types = array_keys( get_post_types( '', 'names' ) );
$nest_acf_post_types = array();
foreach( $nest_post_types as $post_type ) {
	$nest_acf_post_types[] = array(
		array(
			'param' => 'post_type',
			'operator' => '==',
			'value' => $post_type	
		)
	);
}
acf_add_local_field_group(array (
	'key' => 'group_57dc101c1f0f7',
	'title' => 'Headline',
	'fields' => array (
		array (
			'key' => 'field_57dc219736cbf',
			'label' => 'Custom Headline',
			'name' => 'custom_h1',
			'type' => 'text',
			'instructions' => 'Enter a Custom Page Title. If no page title is entered, the original title will be used',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => $nest_acf_post_types,
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
?>