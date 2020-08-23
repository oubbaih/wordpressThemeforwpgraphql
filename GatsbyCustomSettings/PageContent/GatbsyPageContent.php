<?php 
    
    add_settings_section( 'gatsby-section-id','Section Info Of Gatsby', 'Section_Inf_Func', 'gatsby' );
    add_settings_field('gatsby-image-log-id' , 'Image Logo' , 'gatsby_Image_logo_Func' , 'gatsby' , 'gatsby-section-id' , array());
    add_settings_field('gatsby-img-icon-id' , 'Image Icon' , 'gatsby_img_icon_Func' , 'gatsby' , 'gatsby-section-id' , array());
    add_settings_field('gatsby-text-logo-id' , 'Text Logo' , 'gatsby_Text_logo_Func' , 'gatsby' , 'gatsby-section-id' , array());
    add_settings_field('gatsby-subtitle-logo-id' , 'SubTitle Logo' , 'gatsby_subtitle_logo_Func' , 'gatsby' , 'gatsby-section-id' , array());

    //Section Function 
    function Section_Inf_Func(){
    }

    // image logo field function

    function gatsby_Image_logo_Func(){
        $image_logo= esc_attr( get_option('image_logo') );
        echo '<input type="file" name="image_logo" value="'.$image_logo.'" />';
         echo get_option('image_logo'); 
    }
    // image icon field function

    function gatsby_img_icon_Func(){
        $img_icon= esc_attr( get_option('img_icon') );
        echo '<input type="file" name="img_icon" value="'.$img_icon.'" />';
         echo get_option('img_icon'); 
    }

    // Text logo field function

    function gatsby_Text_logo_Func(){
        $text_logo= esc_attr( get_option('text_logo') );
        echo '<input type="text" name="text_logo" value="'.$text_logo.'" />'; 
    }
    // Sub Title Field Function

    function gatsby_subtitle_logo_Func(){
        $subtitle_logo= esc_attr( get_option('subtitle_logo') );
        echo '<input type="text" name="subtitle_logo" value="'.$subtitle_logo.'" />'; 
    }