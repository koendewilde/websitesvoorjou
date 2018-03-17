<?php get_header(); ?>

<main>
    <section id="section-index">

        <div id="intro-wrapper" class="wrapper-outer clearfix">

            <div class="wrapper-small">

                <header>

                    <h1 class="page-title-serif">
                        Blog
                    </h1>

                </header>

            </div>

        </div>

        <div id="page-content" class="bg-grey clearfix wrapper-outer">

            <div class="wrapper-main">

                <div id="index-tiles-wrapper" class="post-tiles-wrapper">

                    <?php 
                        $i=0;
                        if (have_posts()): while (have_posts()) : the_post();  
                            $i++;
                        
                           kdw_get_post_tile( $i );
                               
                        endwhile; 
                    
                        
                    
                    endif; 		 

                        ?>

                </div>


                <?php
              
                global $wp_query;

                $big = 999999999; // need an unlikely integer

                $pagination = paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'prev_text' => 'Vorige',
                    'next_text' => 'Volgende',
                    'type' => 'list',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages
                ) );
                
                
                if ($pagination != '' ){
                    echo '<div id="pagination" class="numbered-list wrapper-small">';
                        echo $pagination;
                    echo '</div>';
                }
              ?>

            </div>
        </div>

    </section>

</main>
<?php get_footer(); ?>
