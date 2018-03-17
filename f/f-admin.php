<?php

// Admin css
function da_custom_admin_css() {    
	wp_enqueue_style('admin_css', get_template_directory_uri() . '/css/backend.css',false,'1.1','all');
}
add_action('admin_enqueue_scripts', 'da_custom_admin_css');
add_action('login_enqueue_scripts', 'da_custom_admin_css');


/* TinyMCE  */
function da_theme_add_editor_styles(){
	add_editor_style( 'css/editor-style.css' );
}
add_action( 'init', 'da_theme_add_editor_styles' );



/* ADMIN CLEANUP */

/* remove items from top toolbar */
function da_remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('search');
	$wp_admin_bar->remove_menu('themes');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('customize');
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('menus');
	$wp_admin_bar->remove_menu('new-media');
	$wp_admin_bar->remove_menu('new-user');	
}
add_action( 'wp_before_admin_bar_render', 'da_remove_admin_bar_links' );



// remove dashboard widgets
function da_remove_dashboard_widgets() {
	
	 remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	 remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );	 
	 remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	 remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );	 
	 remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );	 
	 remove_action('welcome_panel', 'wp_welcome_panel');
	 
} 
add_action('admin_init', 'da_remove_dashboard_widgets' );




// remove admin menu items
function kdw_change_admin_menu() {
	
	//remove categories 
	//remove_meta_box( 'categorydiv','post','normal' );
	//remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
	
	// remove tags
	remove_meta_box( 'tagsdiv-post_tag','post','normal' );	
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	
	// remove comments
	remove_menu_page('edit-comments.php');
	
	// remove only for non-admin
	if (!current_user_can('administrator')) {
		
		remove_menu_page('tools.php');		 
	
	}	
		
}
add_action('admin_menu', 'kdw_change_admin_menu');
