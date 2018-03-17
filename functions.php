<?php
 
require get_template_directory() . '/f/f-header.php';
require get_template_directory() . '/f/f-content.php';
require get_template_directory() . '/f/f-admin.php';
require get_template_directory() . '/f/f-icons.php';
require get_template_directory() . '/f/f-helpers.php';

/* PLUGINS */

// GRAVITY
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
add_filter( 'gform_confirmation_anchor_2', '__return_false' );


// PLUGIN - Advanced Custom Fields
if( function_exists('acf_add_options_page') ) {
    
	// main options
	acf_add_options_page(array(
		'page_title' 	=> 'Opties',
		'menu_title'	=> 'Opties',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' 		=> 9
	));
    
    acf_add_options_sub_page(
        array(
            'page_title' 	=> 'Extra',
            'menu_title'	=> 'Extra',
            'parent_slug'	=> 'theme-general-settings',
        )
    ); 
        
}

// PLUGIN - Yoast metabox to bottom
function da_yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'da_yoasttobottom');

?>
