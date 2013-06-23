<?php
/**
 * Crisp Persona functions and definitions
 *
 * @package Crisp Persona
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 762; /* pixels */

/*
 * Load admin interface file.
 */
require_once ( get_stylesheet_directory() . '/theme-options.php' );

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'crisp_persona_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function crisp_persona_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Crisp Persona, use a find and replace
	 * to change 'crisp_persona' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'crisp_persona', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 100 );
	add_image_size( 'medium', 300, 200 );
	add_image_size( 'large', 900, 9999 );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'footer' => __( 'Footer Menu', 'crisp_persona' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // crisp_persona_setup
add_action( 'after_setup_theme', 'crisp_persona_setup' );



/**
 * Register widgetized area and update sidebar with default widgets
 */
function crisp_persona_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'crisp_persona' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'crisp_persona_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function crisp_persona_scripts() {
	wp_enqueue_style( 'crisp-persona-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'crisp-persona-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'crisp-persona-socialite', get_template_directory_uri() . '/js/socialite.min.js', array(), '20130601', false );
	wp_enqueue_script( 'crisp-persona-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20130601', false );
	wp_enqueue_script( 'crisp-persona-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130601', true );
	
	/*
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'crisp-persona-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130601' );
	}
	*/
}
add_action( 'wp_enqueue_scripts', 'crisp_persona_scripts' );



/**
 * Custom truncation function
 */
function crisp_persona_truncate($content, $len = 100){
	$content = trim(strip_tags($content));
	if(!$content) return "";
	if(strlen($content) < $len) return $content;

	$content = substr($content, 0, $len);
	$content = substr($content, 0, strrpos($content, ' '));
	$content = trim($content, ".,;");
	return $content.'...';
}



/**
 * This and the function below it track post views
 * Note: This won't work if a caching plugin is enabled
 * This code was adapted from here: http://www.wpbeginner.com/wp-tutorials/how-to-track-popular-posts-by-views-in-wordpress-without-a-plugin/
 */
function crisp_persona_increment_post_views($postId) {
    $key = 'post_view_count';
    $count = get_post_meta($postId, $key, true);
    if(!$count){
        $count = 1;
        delete_post_meta($postId, $key);
        add_post_meta($postId, $key, $count);
    }else{
        $count++;
        update_post_meta($postId, $key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function crisp_persona_track_post_view($postId) {
    if ( !is_single() ) return;
    if ( !$postId ) {
        global $post;
        $postId = $post->ID;    
    }
    if ( !$postId ) return;

    crisp_persona_increment_post_views($postId);
}
add_action( 'wp_head', 'crisp_persona_track_post_view' );



/**
 * Add css attributes to next/prev wordpress links
 */
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function posts_link_attributes() {
    return 'class="pure-button"';
}

function post_link_attributes($output) {
	$injection = 'class="pure-button"';
	return str_replace('<a href=', '<a '.$injection.' href=', $output);
}
