<?php
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'custom-logo' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

// add widget to my theme 
if ( function_exists('register_sidebar') ){
  register_sidebar(array(
    'name' => 'sidebar',
    'id'  => "sidebar",
  ));
  register_sidebar(array(
    'name' => 'Footer',
    'id'  => "footer",
  ));
}
// Add Menu Support 
add_theme_support( 'menus' );

    add_action( 'init', 'register_my_menus' );

    function register_my_menus() {
        register_nav_menus(
            array(
                'MENU_1' => __( 'Primary Menu' ),
                'secondary-menu' => __( 'Secondary Menu' )
            )
        );
    }

// Add Custom Mutation To Extends WpGraphql Mutation 

		// Register Like Posts Mutation 
		require_once(get_template_directory().'./postLikes/PostLikes.php');
		// Register DisLike Posts Mutation
		require_once(get_template_directory().'./postDislike/PostDisLike.php');
		// Register Post Views Mutation 
		require_once(get_template_directory().'./postViews/PostViews.php');


//  Add Admin Pages To WordPress Core 

		//for Create Pages
		add_action('admin_menu' , 'create_admin_page');
		// add Fields And Sections to pages 
		add_action('admin_init' , 'create_admin_settings');
		// used to register our field to graphql 
		add_action('init' , 'register_admin_settings');

		// function for create menu pages in wordpress dashboard

function create_admin_page(){
	add_menu_page( 'Gatsby Settings Page', 'gatsby', 'manage_options','gatsby', 'Gatsby_Main_Page_Func' ,get_template_directory_uri().'./GatsbyCustomSettings/images/icon.png',120);
	// add subMenu pages General
	add_submenu_page( 'gatsby', 'General', 'General', 'manage_options','gatsby','Gatsby_Main_Page_Func');
	add_submenu_page( 'gatsby', 'Gatsby Social Media', 'Social Media', 'manage_options','social-media','Gatsby_SociaL_Media_Function');
}
			// function for Data That you will show in gatbsy page
				function Gatsby_Main_Page_Func(){
					echo '<h1>Gatsby Settings Theme</h1>';
					//gatsby page
					require_once(get_template_directory().'./GatsbyCustomSettings/AssignDataToPages/Gatsby.php');
					//
				}
				// gatsby Social Media Page 
				 	function Gatsby_SociaL_Media_Function(){
						 echo '<h1>Setup Gatsby Social Media Links</h1>';
						 require_once(get_template_directory().'./GatsbyCustomSettings/AssignDataToPages/SocialMedia.php');
					 }



// function for create fields and sections in pages menu that we create

function create_admin_settings(){
	//gatsby page
	require_once(get_template_directory().'./GatsbyCustomSettings/PageContent/GatbsyPageContent.php');
	// Social Media
	require_once(get_template_directory().'./GatsbyCustomSettings/PageContent/SocialMediaPageContent.php');

}



// function for register our fields to graphql 


function register_admin_settings(){
	//gatsby page
	require_once(get_template_directory().'./GatsbyCustomSettings/RegisterToGraphql/GatsbyRegisterToGraphql.php');
	//Social Media Page
	require_once(get_template_directory().'./GatsbyCustomSettings/RegisterToGraphql/SocialMediaRegisterToGraphql.php');

}

// Register Contact Form Mutation 

require_once(get_template_directory().'./RegisterContactFormMutation/ContactFormMutation.php');

// Register Logo & Icon Mutation 

require_once(get_template_directory().'./RegisterLogoAndIconsMutation/getHeader.php');


// Register NewsLetter Mutation

require_once(get_template_directory().'./RegisterNewsLettersUbscribers/NewsLetterSubscrib.php');

// Increase The Number Of Wpgraphql Posts Query 

add_filter( 'graphql_connection_max_query_amount', function( $amount, $source, $args, $context, $info  ) {
	if ( current_user_can( 'manage_options' ) ) {
			 $amount = 1000;
	}
	return $amount;
}, 10, 5 );