<?php 

    add_settings_section( "gatsby-social-media-id", 'Customize Social Media ', 'gatsby_social_media_section_function', 'social-media' );
    add_settings_field( 'fb_field-id', 'Facebook Link ', 'social_media_fb_link_func', 'social-media','gatsby-social-media-id' );
    add_settings_field( 'im_field-id', 'Instagram Link ', 'social_media_im_link_func', 'social-media','gatsby-social-media-id' );
    add_settings_field( 'tw_field-id', 'Twetter Link ', 'social_media_tw_link_func', 'social-media','gatsby-social-media-id' );
    add_settings_field( 'lk_field-id', 'Linked Link ', 'social_media_lk_link_func', 'social-media','gatsby-social-media-id' );
    add_settings_field( 'yt_field-id', 'Youtube Link ', 'social_media_yt_link_func', 'social-media','gatsby-social-media-id' );
    
   

    //section function 
        function gatsby_social_media_section_function(){
        }

    // Facebook Function Link
        function social_media_fb_link_func(){
            $Facebook_Link= esc_attr( get_option('Facebook_Link') );
            echo '<input type="text" name="Facebook_Link" value="'.$Facebook_Link.'" />'; 
        }

    // Instagramme Function Link
    
        function social_media_im_link_func(){
             $Instagram_Link= esc_attr( get_option('Instagram_Link') );
            echo '<input type="text" name="Instagram_Link" value="'.$Instagram_Link.'" />'; 
        }
    // Twetter Function Link
    
        function social_media_tw_link_func(){
             $Twetter_Link= esc_attr( get_option('Twetter_Link') );
            echo '<input type="text" name="Twetter_Link" value="'.$Twetter_Link.'" />'; 
        }
    // Linked Function Link
    
        function social_media_lk_link_func(){
             $Linked_Link= esc_attr( get_option('Linked_Link') );
            echo '<input type="text" name="Linked_Link" value="'.$Linked_Link.'" />'; 
        }
    // Youtube  Function Link
    
        function social_media_yt_link_func(){
             $Youtube_Link= esc_attr( get_option('Youtube_Link') );
            echo '<input type="text" name="Youtube_Link" value="'.$Youtube_Link.'" />'; 
        }