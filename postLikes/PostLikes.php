<?php 
// Register Post Likes Mutation 

add_action( 'graphql_register_types', function() {

	register_graphql_field( 'Post', 'likeCount', [
		'type' => 'Int',
		'description' => __( 'The number of likes for the post', 'your-textdomain' ),
		'resolve' => function( $post ) {
			$likes = get_post_meta( $post->ID, 'likes', true );
			return isset( $likes ) ? (int) $likes : 0;
		}
  ] );

  register_graphql_mutation( 'likePost', [
		'inputFields' => [
			'id' => [
				'type' => [
					'non_null' => 'ID'
				],
				'description' => __( 'ID of the post to like', 'your-textdomain' ),
			],
		],
		'outputFields' => [
			'post' => [
				'type' => 'Post',
				'description' => __( 'The post that was liked', 'your-textdomain' ),
			],
		],
		'mutateAndGetPayload' => function( $input ) {

			$id = null;

			if ( absint( $input['id'] ) ) {
				$id = absint( $input['id'] );
			} else {
				$id_parts = \GraphQLRelay\Relay::fromGlobalId( $input['id'] );
				if ( ! empty( $id_parts['id'] ) && absint( $id_parts['id'] ) ) {
					$id = absint( $id_parts['id'] );
				}
			}

			/**
			 * If the ID is invalid or the post object doesn't exist, throw an error
			 */
			if ( empty( $id ) || false == $post = get_post( absint( $id ) ) ) {
				throw new \GraphQL\Error\UserError( __( 'The ID entered is invalid' ) );
			}

			/**
			 * If you wanted to only allow certain users to "like" a post, you could do
			 * some capability checks here too, or whatever validation you want to apply. . .
			 */

			$current_likes = (int) get_post_meta( $post->ID, 'likes', true );
			update_post_meta( $post->ID, 'likes', absint( $current_likes + 1 ) );

			return [
				'post' => $post
			];

		}
	] );
  

});