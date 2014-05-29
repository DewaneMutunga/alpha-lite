<?php
/**
 * alpha_lite functions and definitions
 *
 * @package alpha_lite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'alpha_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function alpha_lite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on alpha_lite, use a find and replace
	 * to change 'alpha_lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'alpha_lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'alpha_lite' ),
		'header' => __( 'Header Menu', 'alpha_lite' )
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'alpha_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // alpha_lite_setup
add_action( 'after_setup_theme', 'alpha_lite_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function alpha_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'alpha_lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'alpha_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function alpha_lite_scripts() {
	wp_enqueue_style( 'alpha_lite-style', get_stylesheet_uri() );
	wp_enqueue_style( 'googlefonts', 'http://fonts.googleapis.com/css?family=Droid+Sans:700|Nobile:400,400italic,700' );
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_script( 'alpha_lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'alpha_lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'alpha_lite_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/** ===============
 * Constants and important files
 */
define( 'AL_NAME', 'Alpha Lite' );
define( 'AL_AUTHOR', 'Dewane Mutunga' );
define( 'AL_VERSION', '1.0' );
define( 'AL_HOME', 'http://dewanemutunga.com' );