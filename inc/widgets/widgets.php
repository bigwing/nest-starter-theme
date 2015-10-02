<?php
add_action( 'widgets_init', function() {
    register_sidebar(array(
        'name' => __('Internal Pages', 'opubco'),
        'description' => __('For pages and post types', 'opubco'),
        'id' => 'widget-internal-pages',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Blog Pages', 'opubco'),
        'description' => __('For blog areas', 'opubco'),
        'id' => 'widget-blogs',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
} );
