<?php

add_theme_support( 'title-tag' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 

 
function kdw_enqueue_template_scripts() {
	
	wp_enqueue_script( 'jquery' );
     
	wp_register_script('template-footer-custom-js', get_template_directory_uri() . '/js/custom.min.js', '', '', true);	
	
    wp_enqueue_script( 'template-footer-custom-js' );
    
    wp_enqueue_style('main-style',get_template_directory_uri() . '/style.css',array(),'0.6');
    
}
add_action('wp_enqueue_scripts', 'kdw_enqueue_template_scripts');
