<?php
/* WordPress - Add Edit Link to Options-Reading Pages */
class nest_reader_edit {
	public function __construct() {
		add_action( 'admin_head-options-reading.php', array( $this, 'init' ) );
	}
	public function init() {
		add_filter( 'wp_dropdown_pages', array( 'nest_reader_edit', 'add_edit_links' ) );
	}
	public static function add_edit_links( $output ) {
		if ( 'page' != get_option( 'show_on_front' ) ) return $output;
		
		if ( strstr( $output, 'page_on_front' ) ) {
			$page_id = absint( get_option( 'page_on_front' ) );
			if ( $page_id > 0 ) {
				$output = $output . sprintf( '&nbsp;&nbsp;<a href="%s">Edit</a>', esc_url( add_query_arg( array( 'post' => $page_id, 'action' => 'edit' ), admin_url( 'post.php' ) ) ) );
			}
		} elseif ( strstr( $output, 'page_for_posts' ) ) {
			$page_id = absint( get_option( 'page_for_posts' ) );
			if ( $page_id > 0 ) {
				$output = $output . sprintf( '&nbsp;&nbsp;<a href="%s">Edit</a>', esc_url( add_query_arg( array( 'post' => $page_id, 'action' => 'edit' ), admin_url( 'post.php' ) ) ) );
			}
		}
		return $output;	
	}
}
new nest_reader_edit;