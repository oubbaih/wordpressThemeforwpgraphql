<?php
add_action( 'graphql_register_types', function() {

register_graphql_object_type( 'GetHeader', [
  'fields' => [
    'logo' => [
      'type' => 'String',
      'description' => __( 'will the url logo of wordpress', 'wpgraphqltheme' ),
    ],
    'favicon' => [
      'type' => 'String',
      'description' => __( 'will show thr icon url of wordpress', 'wpgraphqltheme' ),
    ],
  ]
] );

register_graphql_field( 'RootQuery', 'getHeader', [
  'type' => 'GetHeader',
  'description' => __( 'Hi roy', 'wpgraphqltheme' ),
  'resolve' => function() {
    //get the logo url 
    $logo = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $logo , 'full' );
    $image_url = $image[0];

    //get favicon
    $favicon = get_site_icon_url();

    $guitar = [
      'logo' =>  $image_url,
      'favicon' => $favicon,
    ];
    return $guitar;
  }
] );

} );