<footer id="footer" class="clearfix wrapper-outer">
    <nav id="main-nav">
        <ul id="nav-header" class="site-color-hover">
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => false, 'items_wrap' => '%3$s' ) ); ?>
        </ul>
    </nav>
</footer>

<?php wp_footer(); ?>

<?php 
if ( get_field('kdw_options_admin_scripts_footer','options') ) { echo get_field('kdw_options_admin_scripts_footer','options'); 	} 
if ( get_field('kdw_options_single_scripts_footer') ) { echo get_field('kdw_options_single_scripts_footer'); 	} 
?>

</body>

</html>
