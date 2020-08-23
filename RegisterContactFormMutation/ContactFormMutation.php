<?php 

    // create our contact form submission with wpgraphql 
    
    add_action('graphql_register_types' ,function (){
        register_graphql_mutation('submissioncontactform' , [

            // input that data we need to get from gatsby
            'inputFields' => [
                'firstName' => [
                    'type' => 'String' ,
                    'description' => ' Use First Name',
                ],
                'lastName' =>[
                    'type' => 'String',
                    'description' => 'User Last Name',
                ],
                'email' => [
                    'type' => 'String',
                    'description' => 'User Email',
                ],
                'message' => [
                    'type' => 'String',
                    'description' => 'User Message'
                ]
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
                $acceptable_fields = [
                    'firstName' => 'field_5f4289687b1cc',
                    'lastName' => 'field_5f42897c7b1cd',
                    'email' => 'field_5f42897c7b1cd',
                    'message' => 'field_5f4289967b1cf',
                ];
    
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
                    'post_type' => 'contact_form',
                    'post_title' => $sanitized_data['firstName'] . ' ' . $sanitized_data['lastName'],
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
    
    