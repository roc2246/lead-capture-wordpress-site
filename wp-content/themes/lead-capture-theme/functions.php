<?php
/**
 * Lead Capture Theme functions and definitions
 *
 * @package Lead_Capture_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lead_capture_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'lead-capture-theme' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'lead_capture_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lead_capture_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lead_capture_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'lead_capture_theme_content_width', 0 );

/**
 * Register widget area.
 */
function lead_capture_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'lead-capture-theme' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Main sidebar', 'lead-capture-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'lead_capture_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lead_capture_theme_scripts() {
	wp_enqueue_style( 'lead-capture-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'lead-capture-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'lead-capture-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('tip') AND $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

//   if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
//     $today = date('Ymd');
//     $query->set('meta_key', 'event_date');
//     $query->set('orderby', 'meta_value_num');
//     $query->set('order', 'ASC');
//     $query->set('meta_query', array(
//               array(
//                 'key' => 'event_date',
//                 'compare' => '>=',
//                 'value' => $today,
//                 'type' => 'numeric'
//               )
//             ));
//   }
}

add_action('pre_get_posts', 'adjust_queries');

add_action( 'wp_enqueue_scripts', 'lead_capture_theme_scripts' );
