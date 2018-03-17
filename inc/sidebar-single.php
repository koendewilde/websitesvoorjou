<div class="wrapper-sidebar">

    <div id="sidebar-wrapper-content">

        <?php

        //read more
         
        echo '<div class="sidebar-block sidebar-read-more">';


            echo '<h4 class="widget-title">Meer lezen'.esc_attr(get_field('kdw_sidebar_title_readmore', 'options')).'</h4>';

           echo '<div id="sidebar-recent-posts-wrapper">';
    

                global $post;
        
                // latest popular posts
                $argspp = array(
                    'range' => 'last30days',
                    'limit' => 5,
                    'exclude' => $post->ID, 
                    'post_type' => 'post'
                );
                $popular = new WPP_query( $argspp );
                $latest = $popular->get_posts(); 
                // create an array of popular posts
                $ppostIDs = array();
                foreach($latest as $late){ $ppostIDs[] = $late->id; }

                $args = array( 
                    'posts_per_page' => 5,
                    'include' => $ppostIDs
                    
                );

                $lastposts = get_posts( $args );

                foreach ( $lastposts as $post ){

                    setup_postdata( $post ); 

                    echo '<a href="'. get_the_permalink().'"/>';
                    
                    $style = '';
                    
                    if ( has_post_thumbnail() ){ 
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id() , 'thumbnail-square-small' );
                        
                        $style = 'style="background-image: url('.esc_url($image[0]).')"';
                    }
                    
                    echo '<span '.$style.'></span>';
                    echo  the_title();

                    echo '</a>';

                 }
                wp_reset_postdata();
    
            echo '</div>';
    
    
        echo '</div>';


    
        // random action block 1
        echo '<div class="sidebar-block sidebar-random-action">';
        
            $random_post_group = get_field('kdw_options_blog_featured_posts','options');
            shuffle($random_post_group);
            $fpgroup = $random_post_group[0];
        
            echo '<a href="'.get_permalink( $fpgroup['link'] ).'">';
                echo '<h4><span class="serif">'.esc_attr($fpgroup['title1']).'</span> '.esc_attr($fpgroup['title2']).'</h4>';
                echo '<p class="serif">'.esc_attr($fpgroup['content']).'</p>';
            echo '</a>';

        echo '</div>';
        
        
        // single yellow - action block 2
        echo '<div id="sidebar-yellow-action" class="sidebar-block">';
        
            $single_cta = get_field('kdw_opties_blog_cta','options');
            $single_cta_title = $single_cta['title']; 
            $single_cta_link = $single_cta['link']; 
        
            echo '<div>';
                echo '<p>'.$single_cta_title.'</p>';
                if($single_cta_link['url']){
                    echo '<a href="'.$single_cta_link['url'].'" target="'.$single_cta_link['target'].'" class="button-yellow-outline">'.$single_cta_link['title'].'</a>';
                }
            echo '</div>';
        echo '</div>';
    
    
?>
    </div>
</div>
