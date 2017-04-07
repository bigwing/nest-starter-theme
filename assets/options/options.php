<?php
// Custom H1
if ( function_exists( 'acf_add_local_field_group' ) ) :
	$nest_post_types = array_keys( get_post_types( '', 'names' ) );
	$nest_acf_post_types = array();
	foreach ( $nest_post_types as $post_type ) {
		$nest_acf_post_types[] = array(
		array(
			'param' => 'post_type',
			'operator' => '==',
			'value' => $post_type,
		),
			);
	}
	acf_add_local_field_group(array(
		'key' => 'group_57dc101c1f0f7',
		'title' => 'Headline',
		'fields' => array(
		array(
			'key' => 'field_57dc219736cbf',
			'label' => 'Custom Headline',
			'name' => 'custom_h1',
			'type' => 'text',
			'instructions' => 'Enter a Custom Page Title. If no page title is entered, the original title will be used',
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

// Custom Post Type Archive Options
class Nest_Archives_SEO {

	/**
	 * Option key, and option page slug
	 *
	 * @var string
	 */
	private $key = '';

	/**
	 * Options page metabox id
	 *
	 * @var string
	 */
	private $metabox_id = '';

	/**
	 * Options Page title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 *
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * This post Type
	 *
	 * @var string
	 */
	protected $post_type = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var Myprefix_Admin
	 **/
	private static $instance = null;

	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 */
	public function __construct( $post_type ) {
		// Set our vars
		$this->title = 'SEO Options';
		$this->key = $post_type . '_options';
		$this->post_type = $post_type;

		$this->add_options_page();
	}

	/**
	 * Add menu options page
	 *
	 * @since 0.1.0
	 */
	public function add_options_page() {
		if ( ! function_exists( 'acf_add_options_sub_page' ) ) { return;
		}

		$options_page = 'edit.php?post_type=' . $this->post_type;
		if ( 'post' === $this->post_type ) {
			$options_page = 'edit.php';
		}
		$this->options_page = acf_add_options_sub_page(
			array(
				'page_title' => 'Options',
				'menu_title' => 'Options ' . $this->post_type,
				'parent_slug' => $options_page,
				'menu_slug' => 'acf-seo-' . $this->post_type,
				'post_id' => $this->post_type,
			)
		);

	}
}
add_action( 'init', 'nest_archives_seo_init', 200, 0 );
function nest_archives_seo_init() {
	$post_types = get_post_types( array(
		'has_archive' => true,
	), 'names' );
	$post_types['post'] = 'post';
	$post_types = array_keys( $post_types );
	foreach ( $post_types as $post_type ) {
		new Nest_Archives_SEO( $post_type );
	}
	// ACF SEO Options for title / description
	if ( function_exists( 'acf_add_local_field_group' ) ) :

		$nest_post_types = array_keys( get_post_types( '', 'names' ) );
		$nest_acf_options_post_types = array();
		foreach ( $nest_post_types as $post_type ) {
			$nest_acf_options_post_types[] = array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-seo-' . $post_type,
			),
				);
		}
		acf_add_local_field_group(array(
			'key' => 'group_57dc4ed63b26c',
			'title' => 'Archive Options',
			'fields' => array(
			array(
				'key' => 'field_57dc4eeb03026',
				'label' => 'Archive Title',
				'name' => 'archive_title',
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
			),
			array(
				'key' => 'field_57dc4efa03027',
				'label' => 'Archive Content',
				'name' => 'archive_content',
				'type' => 'wysiwyg',
				'instructions' => '',
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
			),
			'location' => $nest_acf_options_post_types,
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

}

// Override archive title and description
add_filter( 'get_the_archive_title', 'nest_archive_seo_title' );
function nest_archive_seo_title( $title ) {
	$post_type = get_post_type();
	if ( ! $post_type && is_home() ) {
		$post_type = 'post';
	}
	if ( $post_type && function_exists( 'get_field' ) ) {
		$maybe_post_title = get_field( 'archive_title', $post_type );
		if ( $maybe_post_title ) {
			return $maybe_post_title;
		}
	}
	return $title;
}

add_filter( 'get_the_archive_description', 'nest_archive_seo_description' );
function nest_archive_seo_description( $description ) {
	$post_type = get_post_type();
	if ( $post_type && function_exists( 'get_field' ) ) {
		$maybe_post_description = get_field( 'archive_content', $post_type );
		if ( $maybe_post_description ) {
			return apply_filters( 'nest_the_content', $maybe_post_description );
		}
	}
	return $description;
}





