<?php
/**
 * monitoramentodeafluentes-theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package monitoramentodeafluentes-theme
 */

if ( ! function_exists( 'monitoramentodeafluentes_udesc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function monitoramentodeafluentes_udesc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on monitoramentodeafluentes-theme, use a find and replace
	 * to change 'monitoramentodeafluentes-udesc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'monitoramentodeafluentes-udesc', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Menu Principal', 'monitoramentodeafluentes-udesc' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'monitoramentodeafluentes_udesc_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'monitoramentodeafluentes_udesc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monitoramentodeafluentes_udesc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'monitoramentodeafluentes_udesc_content_width', 640 );
}
add_action( 'after_setup_theme', 'monitoramentodeafluentes_udesc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function monitoramentodeafluentes_udesc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'monitoramentodeafluentes-udesc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'monitoramentodeafluentes-udesc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'monitoramentodeafluentes_udesc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function monitoramentodeafluentes_udesc_scripts() {
	// wp_register_style( 'bxslider-css', get_template_directory_uri().'/modules/jquery-bxslider/jquery.bxslider.css');

	// monitoramentodeafluentes-udesc-style that contains the main style, Bootstrap core CSS,
	wp_enqueue_style('monitoramentodeafluentes-udesc-style', get_stylesheet_uri(), array());

	wp_enqueue_script('jquery-min', get_stylesheet_directory_uri().'/assets/js/jquery/jquery.min.js', array(), false, true);

	wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri().'/assets/js/bootstrap-js/bootstrap.min.js', array(), false, true);
	
	wp_enqueue_script('menu-principal-js', get_template_directory_uri().'/assets/js/menu-principal.js', array(), false, true);

	// IE10 viewport hack for Surface/desktop Windows 8 bug
	wp_enqueue_script('ie10-viewport-bug-workaround', get_stylesheet_directory_uri().'/assets/js/ie10-viewport-bug-workaround.js', array(), false, true);
	
	wp_enqueue_script('monitoramentodeafluentes-udesc-functions', get_stylesheet_directory_uri().'/assets/js/function.js', array(), false, true);

	wp_enqueue_script('monitoramentodeafluentes-udesc-navigation', get_template_directory_uri().'/assets/js/navigation.js', array(), '20151215', true);

	wp_enqueue_script('monitoramentodeafluentes-udesc-skip-link-focus-fix', get_template_directory_uri().'/assets/js/skip-link-focus-fix.js', array(), '20151215', true);

	wp_enqueue_script('canvasjs', get_template_directory_uri().'/assets/js/canvasjs.min.js', array(), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'monitoramentodeafluentes_udesc_scripts' );

/**
 * Enqueue styles to page login.
 */
function my_login_logo() {
	wp_enqueue_style( 'login-style', get_template_directory_uri() . '/layouts/login-style.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**
 * Change the link from page login to redirect to home page.
 */
function my_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

/**
 * Change the title from logo from page login.
 */
function my_login_logo_url_title() {
	return 'Monitoramento de Afluentes';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

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
