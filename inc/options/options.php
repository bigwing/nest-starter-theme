<?php
class Nest_Custom_Plugin {
    public function __construct() {
        
    }
    
    /**
     * Run plugin init actions
     * 
     * Called after class has been instantiated
     *
     * @since 1.0
     *
     */
    public function run() {
        add_action( 'init', array( $this, 'create_post_types' ), 11 );
        add_action( 'init', array( $this, 'create_taxonomies' ), 12 );
        add_action( 'cmb2_init', array( $this, 'create_custom_fields' ), 10 );
        add_action( 'init', array( $this, 'create_shortcodes' ), 14 );
        add_action( 'save_post', array( $this, 'save_post' ) );
    }
    
    public function save_post( $post_id ) {
        // If this is just a revision, don't send the email.
        if ( wp_is_post_revision( $post_id ) )
            return;
    }
    
    /**
     * Create custom post types here
     * 
     * Create custom post types here
     *
     * @since 1.0
     *
     */
    public function create_post_types() {
    }
    
    /**
     * Create custom taxonomies here
     * 
     * Create custom taxonomies here
     *
     * @since 1.0
     *
     */
    public function create_taxonomies() {
        
    }
    
    /**
     * Create custom post types here
     * 
     * Create custom post types here
     *
     * @since 1.0
     *
     */
    public function create_custom_fields() {
            
        /* Custom H1 */
        $custom_h1 = new_cmb2_box( array(
            'id' => '_custom_h1',
            'title' => 'Custom H1',
            'object_types' =>  array_keys( get_post_types( '', 'names' ) ),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true
        ) );
        $custom_h1->add_field( array(
            'id' => '_custom_h1',
            'desc' => 'Custom Title',
            'type' => 'text',
        ) );
    }
    
    /**
     * Create shortcodes here
     * 
     * Create shortcodes here
     *
     * @since 1.0
     *
     */
    public function create_shortcodes() {
        
    }
    
    
} //end Nest_Custom_Plugin
$custom_plugin = new Nest_Custom_Plugin();
$custom_plugin->run(); 



 
?>