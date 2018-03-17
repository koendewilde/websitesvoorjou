<?php

/* Register Menu's */ 
function kdw_register_nav_menus() {
    register_nav_menu('header-menu', 'Hoofd Menu' );
}
add_action( 'init', 'kdw_register_nav_menus' );


/* Featured Images */
add_theme_support( 'post-thumbnails', array('post','page') );

/* IMAGE SIZES */
add_image_size('bg-medium',680);
add_image_size('bg-large',1280);
add_image_size('bg-xl',1600);


function kdw_set_medium_large_img() {
    update_option('medium_large_size_w', 960); // originally 768
    update_option('medium_large_size_h',0);   
}
add_action('admin_init', 'kdw_set_medium_large_img');

/* Excerpt */
function kdw_excerpt_more( $more ) {
	global $post;	 
	return '<span class="read-more-dots">&hellip;</span>';
}
add_filter('excerpt_more', 'kdw_excerpt_more');


/* RESPONSIVE VIDEOS (16:9) */
add_filter('embed_oembed_html', 'kdw_wrap_embed_with_div', 10, 3);

function kdw_wrap_embed_with_div($html, $url, $attr) {
        return "<div class=\"embed-container-wrapper\"><div class=\"embed-container\">".$html."</div></div>";
}
