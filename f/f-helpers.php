<?php
function excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, '<span class="read-more-dots">&hellip;</span>');
}


function kdw_get_footer_list($fieldname){
    
    $repeater = get_field($fieldname, 'options');
    
    if ($repeater){
    echo '<ul class="footer-list">';
    foreach( $repeater as $row ){
        $link = $row['link'];    
        echo '<li><a href="'.$link['url'].'" target="'.$link['target'].'">'.$link['title'].'</a></li>'; 
    }
    echo '</ul>';
    }
}

function kdw_website_color(){
    
    $color = get_field('kdw_options_website_color', 'options');
    
    if ($color){
    
        $css = '<style>';
        $css .= '.site-color { color: '.$color.'; }';
        $css .= 'a.site-color-hover:hover, .site-color-hover a:hover { color: '.$color.'; }';
        $css .= '.entry-content a { color: '.$color.'}';
        $css .= '#header-wrapper:after, #footer:after { background: '.$color.';}';
        
        $css .= '#links-wrapper .simple .qcopd-single-list ul li a:hover { background: rgb(250, 250, 250); color: '.$color.'; border-bottom: 1px solid '.$color.' !important; }';
        $css .= '#links-wrapper .simple .upvote-section-simple .upvote-btn:hover,#links-wrapper .simple li:hover .upvote-btn,#links-wrapper .simple li:hover .upvote-count { color: '.$color.'}';
        
        $css .= '</style>';
    
        echo $css;
    }
    
}

function kdw_get_post_tile($i=0){
    
    global $post;
    $cpt = $post->post_type;
    if ($cpt == 'post-stylists')
    {
        // post-stylists    
        echo '<div class="post-tile post-tile'.$i.' post-tile-'.$cpt.'">';

                    if ( has_post_thumbnail() ) {
                        $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id() , 'thumbnail-stylists');
                        $tile_bg = 'background-image:url('.$bg_img[0].');';  
                        echo '<a href="'.get_the_permalink().'" class="post-tile-bg" style="'.$tile_bg.'"><span></span></a>';
                    } else {
                        echo '<a href="'.get_the_permalink().'" class="post-tile-bg post-tile-bg-empty"><span></span></a>';
                    }

                    echo '<div class="post-tile-content">';
                        echo '<h2>'.get_the_title().' <a href="'.get_the_permalink().'" class="button-green-outline">Bekijken</a></h2>';

                        echo '<div class="tile-meta"><span class="tile-location">';
                        $terms = wp_get_post_terms( $post->ID, 'category-stylists-region');
        
        
                        // parents first
                        foreach ( $terms as $term ){
                            if ($term->parent == 0){ 
                               $myparent = $term; 
                                echo $term->name;     
                            }
                        }
        
                        $comma = true;
                        foreach( $terms as $term){
                            if ($term->parent == $myparent->term_id){
                                if ($comma){ echo ', '; }
                                echo $term->name;
                                $comma = false;
                            }
                        }
                        echo '</span> </div>';


                echo '<p class="serif">'.excerpt(36).'</p>'; 
            echo '</div>'; 
        echo '</div>'; 
    } 
    else if ($cpt == 'post-shops' || $cpt == 'post-webshops')
    {
        // post-shops
        echo '<div class="post-tile post-tile'.$i.' '.$cpt.'">';

            if ( has_post_thumbnail() ) {
                $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id() , 'medium');
                $tile_bg = 'background-image:url('.$bg_img[0].');';  
                echo '<a href="'.get_the_permalink().'" class="post-tile-bg" style="'.$tile_bg.'"><span></span></a>';
            } else {
                echo '<a href="'.get_the_permalink().'" class="post-tile-bg post-tile-bg-empty"><span></span></a>';
            }

            echo '<div class="post-tile-content">';
                echo '<h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';

                echo '<p class="serif">';
                    if ( get_field('kdw_shops_alt_excerpt') ){
                        echo '<span class="excerpt-regular">'.esc_attr(get_field('kdw_shops_alt_excerpt')).'</span>';
                    } else {
                        echo '<span class="excerpt-regular">'.excerpt(11).'</span>';
                    }
                echo '</p>';

                echo '<div class="tile-footer">';
                    if ($cpt == 'post-shops'){ 
                        $tax = 'category-shops-region';
                        echo '<span class="tile-footer-left tile-location">'.kdw_the_primary_category_id($post->ID, $tax, 'name').'</span>';
                    }
                    echo '<a href="'.get_the_permalink().'" class="tile-footer-right button-green-outline">Bekijken</a>';
                echo '</div>';

            echo '</div>';

        echo '</div>'; 
    }
    else 
    {
        // post
        echo '<a href="'.get_the_permalink().'" class="post-tile post-tile'.$i.' post-tile-'.$cpt.'">';

            if ( has_post_thumbnail() ) {
                $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id() , 'medium');
                $tile_bg = 'background-image:url('.$bg_img[0].');';  
                echo '<div class="post-tile-bg" style="'.$tile_bg.'"><span></span></div>';
            } else {
                echo '<div class="post-tile-bg post-tile-bg-empty"><span></span></div>';
            }

            echo '<div class="post-tile-content">';
                echo '<h2>'.get_the_title().'</h2>';

                echo '<p class="serif">';

                    echo '<span class="excerpt-regular">'.excerpt(24).'</span>';

                    if ( $i == 1){
                        echo '<span class="excerpt-long">'.excerpt(48).'</span>';
                    } 

                echo '</p>';

            echo '</div>';

        echo '</a>';
    }
}




//
// header image
//

// header image css
 function kdw_bg_image_css(){
     
    global $post;
     
    $sizeM = 'bg-medium';
    $sizeL = 'bg-large';
    $sizeXL = 'bg-xl';
     
   $bg_imgID = esc_attr( get_field('kdw_options_website_bg', 'options' ) );
       
    
     
     
    // generate css
    
    if ( $bg_imgID ){

        echo '<style>';

            // size M  
            $bg_medium = wp_get_attachment_image_src( $bg_imgID, $sizeM );
            $bg_url_medium = $bg_medium[0];
            echo '#bg-image{ background-image: url('.$bg_url_medium.');}';
        
            // size L
            echo '@media screen and (min-width: 540px) {';     
                $bg_large = wp_get_attachment_image_src( $bg_imgID, $sizeL );
                $bg_url_large = $bg_large[0];
                echo '#bg-image{ background-image: url('.$bg_url_large.');}';
            echo '}';
        
            // size XL
            echo '@media screen and (min-width: 1280px) {';    
                $bg_xl = wp_get_attachment_image_src( $bg_imgID, $sizeXL );
                $bg_url_xl = $bg_xl[0];
                echo '#bg-image{ background-image: url('.$bg_url_xl.');}';
            echo '}';
        
         echo '</style>';
    }  
   
}  


// yoast primary cat 
function kdw_the_primary_category_id( $postID, $tax, $return){
    
    // get all post categories
    $category = get_the_terms( $postID, $tax );
    
    // If post has a category assigned.
    if ($category){
         
        if ( class_exists('WPSEO_Primary_Term') )
        {
            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
            $wpseo_primary_term = new WPSEO_Primary_Term( $tax, $postID );
            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
            $term = get_term( $wpseo_primary_term );
            if (is_wp_error($term)) { 
                // Default, first category
                $catID = $category[0]->term_id;
                $catName = $category[0]->name;
            } else { 
                // Yoast Primary category
                $catID = $term->term_id;
                $catName = $term->name;
            }
        } 
        else {
            // Default, first category
            $catID = $category[0]->term_id;
            $catName = $category[0]->name;
        }
        
        if ($return == 'name'){ 
            return $catName; 
        } else if ($return == 'link'){ 
            return $catName; 
        } else { 
            return $catID; 
        } 
        
    }  

}








// homepage

function kdw_get_row_three_posts(){
    
    global $post;
    
    if (get_sub_field('row_two_posts')){ 
        $count = 2;
    } else {
        $count = 3;
    }
    
    $choose = get_sub_field('row_choose_posts');
    
    if ($choose == 'recent'){    
        $catID = 'recent';
    } else if ( $choose == 'populair'){
        $catID = 'ppost';
    } else {
        $catID = get_sub_field('row_category');
    }
    
    $catName = get_sub_field('row_title');
    
    $catLinktitle = get_sub_field('row_title_link');
    
    
    // start 
    
    
    if ($catID == 'ppost'){
          
         
        $catLink = get_permalink(get_option('page_for_posts')).'?order=populair';
        
        $args = array(
            'meta_key' => 'views_monthly',
            'posts_per_page' => $count,
            'orderby' => 'meta_value_num',
            'post_type' => 'post'
        );

    } else if ( $catID == 'recent'){
        
        
        $catLink = get_permalink(get_option('page_for_posts'));
        
        $args = array( 
            'posts_per_page' => $count
        );
        
    } else {
        
        
        $catLink = get_category_link($catID);
        
        $args = array( 
            'posts_per_page' => $count, 
            'category' => $catID
        );
        
    }
    
    
    
    echo '<div class="row-three-posts row-posts-only'.$count.' wrapper-outer clearfix">';
    
        echo '<div class="wrapper-main">'; 
  
                echo '<div class="three-posts-intro clearfix">';
    
                    echo '<h3 class="serif">'.$catName.'</h3>';
                
                    echo '<a href="'.$catLink.'">'.$catLinktitle.'</a>';
                
                echo '</div>';
    
                echo '<div class="three-posts-wrapper post-tiles-wrapper">';
                
                $latestposts = get_posts($args);
                $i=0;
                foreach( $latestposts as $post ){
                        $i++;
                        
                        setup_postdata( $post ); 
                        echo '<a href="'.get_the_permalink().'" class="post-tile post-tile'.$i.'">';

                            if ( has_post_thumbnail() ) {
                                $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id() , 'medium');
                                $tile_bg = 'background-image:url('.$bg_img[0].');';  
                                echo '<div class="post-tile-bg" style="'.$tile_bg.'"><span></span></div>';
                            } else {
                                echo '<div href="'.get_the_permalink().'" class="post-tile-bg post-tile-bg-empty"><span></span></div>';
                            }
                           
                            echo '<div class="post-tile-content">';
                                echo '<h2>'.get_the_title().'</h2>';

                                echo '<p class="serif">';
                                
                                    echo '<span class="excerpt-regular">'.excerpt(26).'</span>';
                                
                                    if ( $count == 2 && $i == 1){
                                        echo '<span class="excerpt-long">'.excerpt(48).'</span>';
                                    } 
                    
                                echo '</p>';

                            echo '</div>';
                            
                        echo '</a>';
                        wp_reset_postdata();   

                }    

                echo '</div>';  

        echo '</div>';
    
    echo '</div>';

}


function kdw_get_featured_tiles(){
    
    global $post;
    
    
    
    // intro 
    $rowName = get_sub_field('row_title');
    $rowLink = get_sub_field('row_title_link');
    
    // color
    $rowColor = get_sub_field('row_colors');
    
    // blocks
    $blocks = get_sub_field('row_blocks');
    
    
    echo '<div class="row-featured-tiles wrapper-outer clearfix color-'.$rowColor.'">';

            echo '<div class="wrapper-main">'; 

                echo '<div class="three-posts-intro clearfix">';
    
                    echo '<h3 class="serif">'.$rowName.'</h3>';
                
                    echo '<a href="'.$rowLink['url'].'" target="'.$rowLink['target'].'">'.$rowLink['title'].'</a>';
                
                echo '</div>';
    
                echo '<div class="featured-tiles-wrapper">';
                
                // start repeater
               
                kdw_create_custom_tile(1, $blocks[0]);
                kdw_create_custom_tile(2, $blocks[1]);
                kdw_create_custom_tile(3, $blocks[2]);
    
                // end repeater
    
                echo '</div>';  

        echo '</div>';
    
    echo '</div>';
    
   
    
}
// helper 
 function kdw_create_custom_tile($i, $block ){
     
        $tile = $block['row_choose_block'];
        $style = '';
        $tile_linked = false; 
        $tile_cta = false; 
        $tile_img = false; 
     
        if ($tile == 'cta'){
            $tile_cta = true;
        } else if ($tile == 'img'){
            $tile_img = $block['block_img'];
        } else {
            if ( $block['block_link'] ){
                $tile_linked = $block['block_link'];
            } 
            // bg color 
            $rowColor = get_sub_field('row_colors');
            if ($rowColor == 'picker' && $i == 1 ){
                $rowColorHex = get_sub_field('row_color_picker');  
                $style = 'style="background-color: '. $rowColorHex.'"';
            }  
            // content 
            $tile_title1 = $block['block_title1'];
            $tile_title2 = $block['block_title2'];
            $tile_content = $block['block_content'];
            $tile_content_link = $block['block_content_link'];

        }
     
        
        if ($tile_cta)
        {
           
            echo '<div class="fs-cta fs-block fs-block'.$i.'">';
                echo '<div>';
                    echo '<p class="serif">'.$block['block_content'].'</p>';
                    $link = $block['block_content_link'];
                    echo '<a href="'.$link['url'].'" target="'.$link['target'].'" class="button-yellow-outline">'.$link['title'].'</a>';
                
                    
                echo '</div>';
            echo '</div>'; 
        
        } 
        else if ($tile_img)
        {
            
            $imgURL = wp_get_attachment_image_src( $tile_img , 'medium');
                                  
            echo '<div class="fs-block fs-block-bgimg fs-block'.$i.'" style="background-image: url('.$imgURL[0].');">';
                echo '<div>';
                echo '</div>';
            echo '</div>';  
            
        } 
        else
        {
            
            // tile txt
            if ($tile_linked) {  
                echo '<a href="'.esc_url($tile_linked).'" class="fs-block fs-block'.$i. ' color-'.$rowColor.'" '.$style.'>'; 
            } else {  
                echo '<div class="fs-block fs-block'.$i.' color-'.$rowColor.'" '.$style.'>'; 
            }
       
                echo '<div>';
                    echo '<h4><span class="serif">'.$tile_title1.'</span> '.$tile_title2.'</h4>';
                    echo '<p class="serif">'.$tile_content.'</p>';
            
                    if (!$tile_linked && $tile_content_link ) {
                        echo '<a href="'.$tile_content_link['url'].'" target="'.$tile_content_link['target'].'" class="serif fs-block-link">'.$tile_content_link['title'].'</a>';
                    } else if ($tile_content_link){
                        echo '<span class="serif fs-block-link">'.$tile_content_link['title'].'</span>'; 
                    }
            
                    echo '</div>';
            
            if ($tile_linked) { echo '</a>'; } else { echo '</div>'; }
            
        }
}


function kdw_get_row_extra_content($id, $v){
    
    if ($v == 'page') { $acf_field = $id; $acf_id = $post->ID; }
    else if ($v == 'term'){ $acf_field = 'kdw_extra_content_repeater'; $acf_id = 'term_'.$id;}
    else if ($v == 'options'){ $acf_field = $id; $acf_id = 'options'; }
       
    $blocks = get_field($acf_field, $acf_id);
    
    if ($blocks){

        $count = count($blocks);
        $class = 'content-no'.$count;

        echo '<div class="row-extra-content wrapper-outer clearfix '.$class.'">';

            echo '<div class="wrapper-main">'; 

                    echo '<div class="divider clearfix"></div>';

                    echo '<div class="extra-content-wrapper">';

                        $i=0;

                        foreach($blocks as $block){ 

                            $i++;

                            echo '<div class="ec-block'.$i.'">';
                                 echo '<div>';
                                    echo '<h2>'.esc_attr($block['title']).'</h2>';
                                    echo '<div class="entry-content serif size15 grey">'.$block['content'].'</div>';
                                echo '</div>';
                            echo '</div>';  

                        }
                    echo '</div>';  

            echo '</div>';

        echo '</div>';
    }
    
}

function kdw_row_extra_page_content(){
      
    $block1 = get_field('kdw_extra_content_first_editor');
    $block2 = get_field('kdw_extra_content_second_editor');
    
    $class = false;
    
    if ( $block1 != '' && $block2 != ''  ){ 
        $class = 'col2';
    } else if ( $block1 != '' || $block2 != ''  ){
        $class = 'col1';
    }
        
      
                                                  
    if ( $class  ){

        
        echo '<div class="row-extra-page-content wrapper-outer clearfix">';
            echo '<div class="wrapper-main">'; 
        
                    echo '<div class="extra-page-content-wrapper wrapper-small '.$class.'">';
       
                        if ( $block1 != '') {
                            
                            $title1 = get_field('kdw_extra_content_first_title');
                            
                            
                            echo '<div class="ec-block ec-block1">';
                                echo '<h1 class="title--v2 site-color">'.esc_attr($title1).'</h1>';
                                echo '<div class="entry-content">'.$block1.'</div>';
                            echo '</div>';  
                        }

                        if ( $block2 != '') {
                            
                            $title2 = get_field('kdw_extra_content_second_title');
                            
                            echo '<div class="ec-block ec-block2">';
                                echo '<h2 class="title--v2 site-color">'.esc_attr($title2).'</h2>';
                                echo '<div class="entry-content">'.$block2.'</div>';
                            echo '</div>';  
                        }
                                        
 
                    echo '</div>';  
            echo '</div>';
        echo '</div>';
        
    }
    
}

 
 



/* ACF helpers: link button */
function kdw_link_button($acf, $class=''){

    $link = get_field($acf);
    
    if( $link ){
	   echo '<a class="'.$class.'" href="'. $link['url'].'" target="'. $link['target'].'">' . $link['title'].'</a>';
    }
    
}


// phone number link
function get_phone_link($number){
    $phone = preg_replace('/[^\d+]/', '', $number);
    $link = '<a href="tel:'.$phone.'">'.$number.'</a>';
    return $link;
}


/* Safe email shortcode */
// Example: [antispam email="name@website.nl" name="optioneel"]
function sEmail($emailname) {
	extract(shortcode_atts(array( 	'email' => '#', 'name' => ''	), $emailname, 'antispam'));
	if ($name == '') { $name = $email; };
	return hide_email_txt($email, $name);
}
add_shortcode('antispam', 'sEmail');


// Safe email functions */
function hide_email($email) { 
	$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[email]</span>'.$script; 
	}
	
function hide_email_txt($email,$txt) { 
	$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a id=\\"action-button\\" href=\\"mailto:"+d+"\\">'.$txt.'</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[email]</span>'.$script; 
	}

function hide_email_icontxt($email) { 
	$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a class=\\"icon-email\\" href=\\"mailto:"+d+"\\"><span><i class=\\"ion-ios-email\\"></i></span>"+d+"</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[email]</span>'.$script; 
	}
	
function hide_email_icon($email) { 
	$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\" title=\\""+d+"\\" ><span><i class=\\"ion-ios-email\\"></i></span></a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[email]</span>'.$script; 
	}

function hide_email_button($email,$txt) { 
	$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a class=\\"button-green-outline\\" href=\\"mailto:"+d+"\\">'.$txt.'</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[email]</span>'.$script; 
	}
