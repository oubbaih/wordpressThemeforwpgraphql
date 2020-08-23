<?php 
//field_5f4292ddf4239

   // create our contact form submission with wpgraphql 
    
   add_action('graphql_register_types' ,function (){
    register_graphql_mutation('newslettersubscriber' , [

        // input that data we need to get from gatsby
        'inputFields' => [
        
            'email' => [
                'type' => 'String',
                'description' => 'User Email',
            ],
            
        ] ,

        // message that we return if data submit or not (success , faild)
        'outputFields' => [
            'success' => [
                'type' => 'Boolean',
                'description' => 'Whether or not data was stored successfully',
                'resolve' => function ($payload, $args, $context, $info) {
                    return isset($payload['success']) ? $payload['success'] : null;
                }
            ],
            'data' => [
                'type' => 'String',
                'description' => 'Payload of submitted fields',
                'resolve' => function ($payload, $args, $context, $info) {
                    return isset($payload['data']) ? $payload['data'] : null;
                }
            ]
        ],
        'mutateAndGetPayload' => function ($input, $context, $info) {

            if (!class_exists('ACF')) return [
                'success' => false,
                'data' => 'ACF is not installed'
            ];

            $sanitized_data = [];
            $errors = [];
            $acceptable_fields = [ 'email' => 'field_5f4292ddf4239'];

            foreach ($acceptable_fields as $field_key => $acf_key) {
                if (!empty($input[$field_key])) {
                    $sanitized_data[$field_key] = sanitize_text_field($input[$field_key]);
                } else {
                    $errors[] = $field_key . ' was not filled out.';
                }
            }

            if (!empty($errors)) return [
                'success' => false,
                'data' => $errors
            ];

            $form_submission = wp_insert_post([
                'post_type' => 'newsletter_subscribe',
                'post_title' => $sanitized_data['email'] ,
            ], true);

            if (is_wp_error($form_submission)) return [
                'success' => false,
                'data' => $form_submission->get_error_message()
            ];

            foreach ($acceptable_fields as $field_key => $acf_key) {
                update_field($acf_key, $sanitized_data[$field_key], $form_submission);
            }

            return [
                'success' => true,
                'data' => json_encode($sanitized_data)
            ];

        }

    ]);
});

