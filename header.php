<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">

    <?php 
    wp_head();  
    
    kdw_website_color();
    
    kdw_bg_image_css();
    
    if ( get_field('kdw_options_admin_scripts_header','options') ) { echo get_field('kdw_options_admin_scripts_header','options'); 	}
    if ( get_field('kdw_options_single_scripts_header') ) { echo get_field('kdw_options_single_scripts_header'); }
    
    ?>

</head>

<body <?php body_class(); ?>>
    <div id="header-wrapper">


        <header class="site-header wrapper-large">

            <div id="header-logo">
                <a href="<?php echo get_home_url(); ?>">
                    <div id="main-logo" class="site-color">
                        <?php echo esc_attr(get_field('kdw_options_website_title', 'options') ); ?>
                    </div>
                    <div id="main-logo-sub">.websites voor jou</div>
                </a>
            </div>

        </header>

    </div>

    <div id="bg-image">
        <div id="bg-filter"></div>
    </div>
