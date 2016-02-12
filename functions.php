<?php
/**
 * ckpersonal functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ckpersonal
 */

if ( ! function_exists( 'ckpersonal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ckpersonal_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ckpersonal, use a find and replace
	 * to change 'ckpersonal' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ckpersonal', get_template_directory() . '/languages' );

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
	set_post_thumbnail_size( 828, 360, true );
	add_image_size( 'lander-thumb-lg', 1400, 1000 );
	add_image_size( 'lander-thumb-md', 700, 500 );
	add_image_size( 'lander-thumb-sm', 420, 300 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'ckpersonal' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ckpersonal_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'ckpersonal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ckpersonal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ckpersonal_content_width', 640 );
}
add_action( 'after_setup_theme', 'ckpersonal_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ckpersonal_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area', 'ckpersonal' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ckpersonal_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ckpersonal_scripts() {
	wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style( 'ckpersonal-style', get_stylesheet_uri() );

	// Load stylesheet and scripts for the front-page only when on the front page	
	wp_enqueue_style( 'front-page-styles', get_stylesheet_directory_uri() . '/style-front-page.css');
	
	

	// Add Google Fonts: Fira Sans, Merriweather, and Rubik 
	wp_enqueue_style( 'ckpersonal-google-fonts', 'https://fonts.googleapis.com/css?family=Muli:400,300|Fira+Sans:400,400italic,700,700italic|Merriweather:400,700,400italic,700italic|Rubik:400,400italic,700,700italic' );
	wp_enqueue_style( 'ckpersonal-google-fonts-hand', 'https://fonts.googleapis.com/css?family=Just+Another+Hand|Architects+Daughter|Schoolbell|Sue+Ellen+Francisco|Indie+Flower|Covered+By+Your+Grace|Gochi+Hand|Neucha' );

	// Add Font Awesome icons (http://fontawesome.io)
	wp_enqueue_style( 'ckpersonal-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );

	wp_enqueue_script( 'ckpersonal-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery'), '20120206', true );
	wp_localize_script( 'ckpersonal-navigation', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'ckpersonal' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'ckpersonal' ) . '</span>',
	) );

	wp_enqueue_script( 'ckpersonal-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'minified-script', get_template_directory_uri() . '/js/script.min.js', array('jquery'), '20151117');
	wp_enqueue_script( 'my-scripts', get_template_directory_uri() . '/js/script.js', array('jquery'), '20151117');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ckpersonal_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
