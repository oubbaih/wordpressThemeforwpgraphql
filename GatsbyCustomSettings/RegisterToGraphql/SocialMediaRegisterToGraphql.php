<?php 

$args = array(
    'type'              => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => null,
    'show_in_graphql'   => true,
    'show_in_rest'      => true,
);

register_setting( 'generalinfoMedia', 'Facebook_Link', $args );
register_setting( 'generalinfoMedia', 'Instagram_Link', $args );
register_setting( 'generalinfoMedia', 'Twetter_Link', $args );
register_setting( 'generalinfoMedia', 'Linked_Link', $args );
register_setting( 'generalinfoMedia', 'Youtube_Link', $args );
