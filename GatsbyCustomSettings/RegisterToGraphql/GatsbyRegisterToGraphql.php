<?php 

$args = array(
    'type'              => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => null,
    'show_in_graphql'   => true,
    'show_in_rest'      => true,
);
$argsImage = array(
    'type'              => 'string',
    'sanitize_callback' => 'handle_file_upload',
    'default'           => null,
    'show_in_graphql'   => true,
    'show_in_rest'      => true,
);
$argsIcon = array(
    'type'              => 'string',
    'sanitize_callback' => 'handle_file_upload_icon',
    'default'           => null,
    'show_in_graphql'   => true,
    'show_in_rest'      => true,
);
register_setting( 'generalinfo', 'image_logo', $argsImage );
register_setting( 'generalinfo', 'img_icon', $argsImage );
register_setting( 'generalinfo', 'text_logo', $args );
register_setting( 'generalinfo', 'subtitle_logo', $args );


function handle_file_upload($option)
{
  if(!empty($_FILES["image_logo"]["tmp_name"]))
  {
    $urls = wp_handle_upload($_FILES["image_logo"], array('test_form' => FALSE));
    $temp = $urls["url"];
    return $temp;  
  }
 
  return $option;
}
function handle_file_upload_icon($option)
{
  if(!empty($_FILES["img_icon"]["tmp_name"]))
  {
    $urls = wp_handle_upload($_FILES["img_icon"], array('test_form' => FALSE));
    $temp = $urls["url"];
    return $temp;  
  }
 
  return $option;
}