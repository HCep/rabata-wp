<?php

if ( ! function_exists( 'materialwp_setup' ) ) :

function materialwp_setup() {

	
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}


	load_theme_textdomain( 'materialwp', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	
	add_theme_support( 'title-tag' );

	function themename_custom_logo_setup() {
		$defaults = array(
			'height'               => 100,
			'width'                => 200,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array( 'site-title', 'site-description' ),
			'unlink-homepage-logo' => true, 
		);
	 
		add_theme_support( 'custom-logo', $defaults );
	}
	 themename_custom_logo_setup();

	add_theme_support( 'post-thumbnails' );

	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'materialwp' ),
		'contact' => __( 'Contact Menu', 'materialwp' ),
	) );


	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	
	add_theme_support( 'custom-background', apply_filters( 'materialwp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; 
add_action( 'after_setup_theme', 'materialwp_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function materialwp_widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget-sidebar %2$s"><div class="">',
		'after_widget'  => '</div></aside>',
		'before_title'  => ' <div class=""><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          =>  'Logo Footer',
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		
	) );
	register_sidebar( array(
		'name'          => 'Footer 2',
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'Menu główne kontakt',
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'materialwp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function materialwp_scripts() {
	wp_enqueue_style( 'mwp-bootstrap-styles', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all' );

	wp_enqueue_style( 'materialwp-style', get_stylesheet_uri() );

	wp_enqueue_style( 'hamburger', get_template_directory_uri() . '/css/hamburgers.css', array(), '', 'all' );

	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css', array(), '', 'all' );
	
	 wp_enqueue_script( 'mwp-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.4', true );

	// wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'materialwp_scripts' );


require get_template_directory() . '/inc/template-tags.php';


require get_template_directory() . '/inc/extras.php';


require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/bootstrap-walker.php';


require get_template_directory() . '/inc/comments-callback.php';


  //** *Enable upload for webp image files.*/
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');
//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);
function cptui_register_portfolio() {

	$labels = [
		"name" => __( "Portfolio", "Rabata" ),
		"singular_name" => __( "portfolio", "Rabata" ),
	];

	$args = [
		"label" => __( "Portfolio", "Rabata" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "projekty", "with_front" => true ],
		"query_var" => true,
		"supports" => [ 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'],
		"taxonomies" => [ "category" ],
		"show_in_graphql" => false,
	];

	register_post_type( "portfolio", $args );
}

add_action( 'init', 'cptui_register_portfolio' );

function cptui_register_projekty() {

	$labels = [
		"name" => __( "Projekty", "Rabata" ),
		"singular_name" => __( "projekty", "Rabata" ),
	];

	$args = [
		"label" => __( "Projekty", "Rabata" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "projekt", "with_front" => true ],
		"query_var" => true,
		"supports" => [ 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'],
		"taxonomies" => [ "category" ],
		"show_in_graphql" => false,
	];

	register_post_type( "projekty", $args );
}

add_action( 'init', 'cptui_register_projekty' );



function cptui_register_opinion() {

	$labels = [
		"name" => __( "Opinie", "Rabata" ),
		"singular_name" => __( "opinie", "Rabata" ),
	];

	$args = [
		"label" => __( "Opinie", "Rabata" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [  ],
		"query_var" => true,
		"supports" => [ "title"],
		"taxonomies" => [ ],
		"show_in_graphql" => false,
	];

	register_post_type( "opinie", $args );
}

add_action( 'init', 'cptui_register_opinion' );

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {

	foreach( $items as &$item ) {
	
		$icon = get_field('icon_menu', $item);
	
		if( $icon ) {
			
			$item->title .= '<img src="'.$icon["url"].'">';
			
		}
		
	}
	return $items;
	
}
//główna strona portfolio 4 ostatnie posty
function shortcode_portfolio(){
  
    $args = array(
                    'post_type'      => 'portfolio',
                    'posts_per_page' => '4',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
  
        while($query->have_posts()) :
  
            $query->the_post() ;
                      
        $result .= '<div class="portfolio-item col-lg-3 col-md-6 px-0" ><a href='. get_the_permalink().'>';
        $result .= '<div class="portfolio-back"><img src="'. get_the_post_thumbnail_url() . '"></div>';
        $result .= '<div class="portfolio-name text-center upper font-weight-bold w-100 text-white">' . get_the_title() . ' <p class="font-40">...</p> </div>';
        $result .= '</a></div>';
  
        endwhile;
  
        wp_reset_postdata();
  
    endif;    
  
    return $result;            
}
  
add_shortcode( 'portfolio_4', 'shortcode_portfolio' ); 


function shortcode_opinie(){
  
	$result .= '  <div class="container-opinion mx-auto" >';
	$result .= '  <button class="next"><img src="'. get_template_directory_uri().'/images/fastleft.svg"></button>';
	$result .= '  <div class="siema opinie-back" style=" background-image:url('.get_template_directory_uri().'/images/slider-back.png);">';

    $args = array(
                    'post_type'      => 'opinie',
                    'posts_per_page' => -1,
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
  
        while($query->have_posts()) :
  
            $query->the_post() ;
                      
        $result .= '<div class="w-100 d-flex flex-column align-items-center text-center px-0 py-5" style="background-image:url('.get_template_directory_uri().'/images/quote.png); background-repeat:no-repeat; background-position:86% 16%;">';
        $result .= '<div class="opinion-content mx-auto pt-5" style="height:250px">' . get_field('content_opinion') . '</div>';
		if(!get_field('image_opinion')){
			$result .= '<div class="opinion-name d-flex align-items-end text-center w-100" style="height:50px"><p class="pt-3 font-20 w-100 text-white font-weight-bold">'.get_field('name_opinion').'</p> </div>';
		}else{
			$result .= '<div class="opinion-name  w-100"><img class="image-opinion" src="'. get_field('image_opinion')['url'].'"> <p class="pt-3 font-20 text-white font-weight-bold">'.get_field('name_opinion').'</p> </div>';
		}
      
        $result .= '</div>';
  
        endwhile;
  
        wp_reset_postdata();
  
    endif;    
	$result.= '</div>';
	$result .= '<button class="prev" style="position:relative; right:45px;"><img src="'. get_template_directory_uri().'/images/fastright.svg"></button>';
	$result .= '</div>';
	
	  
    return  $result;            
}
  
add_shortcode( 'opinie', 'shortcode_opinie' ); 



function social_share_shortcode(){
	global $post;

	 
	$str = get_site_url();
	$str = preg_replace('#^https?://#i', '', $str);
	
	$social .= '<div class="d-flex flex-wrap">';

	$social .= '<div class="fb-share-button" ><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2F'.$str.'/'.$post->post_name.'%2F&amp;src=sdkpreparse" ><img src="'.get_template_directory_uri().'/images/facebook.svg"></a></div>';

	$social .= '<div class="pl-3"><a href="https://www.instagram.com"><img src="'.get_template_directory_uri().'/images/instagram.svg"></a></div>';
	
	$social .= '<div class="pl-3"><a href="https://www.linkedin.com/shareArticle?mini=true&summary='.$post->post_name.'&title='.$post->post_name.'&url='. get_permalink() .'"><img src="'.get_template_directory_uri().'/images/linkedin.svg"></a></div>';

	$social .= '<div class="pl-3"><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text='. get_permalink() .'"><img src="'.get_template_directory_uri().'/images/twitter.svg"></a></div>';

	$social .= '</div>';
	
	return $social;
}
add_shortcode( 'social-share', 'social_share_shortcode' ); 



	