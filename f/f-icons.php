<?php
//
// Follow us
//

 
function kdw_follow_us($class){
    
    $facebookURL = esc_url( get_field( 'kdw_options_facebook', 'options' ) );
    $twitterURL = esc_url( get_field( 'kdw_options_twitter', 'options' ) );
    $instagramURL = esc_url( get_field( 'kdw_options_instagram', 'options' ) );
    $pinterestURL = esc_url( get_field( 'kdw_options_pinterest', 'options' ) );
    
    // Follow buttons
    $content = '<div id="header-social-wrapper">';
    
    $content .= '<div class="kdw-share-social '.$class.'">';
    
    if ($facebookURL){
        $content .= '<a class="share-link share-facebook" href="'.$facebookURL.'" target="_blank"></a>';
    }
    if ($twitterURL){
        $content .= '<a class="share-link share-twitter" href="'. $twitterURL .'" target="_blank"></a>';
    }
    if (instagramURL){
        $content .= '<a class="share-link share-instagram" href="'.$instagramURL.'" target="_blank"></a>';
    }
    if ($pinterestURL){
        $content .= '<a class="share-link share-pinterest" href="'.$pinterestURL.'" target="_blank"></a>';
    }
    
    $content .= '</div>';
    
    $content .= '</div>';
    
    echo $content;
    
}



/* SHARE BUTTONS */
function kdw_social_sharing_buttons($class='') {
    
	global $post;
	
    // Get current page URL 
    $shareURL = urlencode(get_permalink());

    // Get current page title
    $shareTitle = str_replace( ' ', '%20', get_the_title());

    // Get Post Thumbnail for pinterest
    $shareThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'exra-large' );

    // Construct sharing URL
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shareURL;
    $twitterURL = 'https://twitter.com/intent/tweet?text='.$shareTitle.'&amp;url='.$shareURL.'&amp;via=share';
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$shareURL.'&amp;media='.$shareThumbnail[0].'&amp;description='.$shareTitle;
    $whatsappURL = 'whatsapp://send?text='.$shareTitle . ' ' . $shareURL;
    
    // Sharing buttons
    
    $content = '';
    
    if ( $class == 'header'){
     $content .= '<div id="header-social-wrapper">';
    }
    
    $content .= '<div class="kdw-share-social '.$class.'">';
    $content .= '<a class="share-link share-facebook" href="'.$facebookURL.'" target="_blank"><span>Delen</span></a>';
    $content .= '<a class="share-link share-twitter" href="'. $twitterURL .'" target="_blank"><span>Tweet</span></a>';
    
    $content .= '<a class="share-link share-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><span>Pinnen</span></a>';
    $content .= '<a class="share-link share-whatsapp" href="'.$whatsappURL.'" target="_blank"><span>WhatsApp</span></a>';
    $content .= '</div>';
    
    if ( $class == 'header'){
     $content .= '</div>';
    }
    
    echo $content;
	
}
