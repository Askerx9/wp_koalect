<?php
/**
 * Koalect_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Koalect_Theme
 */

if ( ! function_exists( 'koalect_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function koalect_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Koalect_Theme, use a find and replace
		 * to change 'koalect_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'koalect_theme', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'koalect_theme' ),
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
		add_theme_support( 'custom-background', apply_filters( 'koalect_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'koalect_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function koalect_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'koalect_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'koalect_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function koalect_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'koalect_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'koalect_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'koalect_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function koalect_theme_scripts() {
	wp_enqueue_style( 'koalect_theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'koalect_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'koalect_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'koalect_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Registers the `years` taxonomy,
 * for use with 'event'.
 */
function years_init() {
	register_taxonomy( 'years', array( 'event' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Years', 'YOUR-TEXTDOMAIN' ),
			'singular_name'              => _x( 'Years', 'taxonomy general name', 'YOUR-TEXTDOMAIN' ),
			'search_items'               => __( 'Search Years', 'YOUR-TEXTDOMAIN' ),
			'popular_items'              => __( 'Popular Years', 'YOUR-TEXTDOMAIN' ),
			'all_items'                  => __( 'All Years', 'YOUR-TEXTDOMAIN' ),
			'parent_item'                => __( 'Parent Years', 'YOUR-TEXTDOMAIN' ),
			'parent_item_colon'          => __( 'Parent Years:', 'YOUR-TEXTDOMAIN' ),
			'edit_item'                  => __( 'Edit Years', 'YOUR-TEXTDOMAIN' ),
			'update_item'                => __( 'Update Years', 'YOUR-TEXTDOMAIN' ),
			'view_item'                  => __( 'View Years', 'YOUR-TEXTDOMAIN' ),
			'add_new_item'               => __( 'Add New Years', 'YOUR-TEXTDOMAIN' ),
			'new_item_name'              => __( 'New Years', 'YOUR-TEXTDOMAIN' ),
			'separate_items_with_commas' => __( 'Separate years with commas', 'YOUR-TEXTDOMAIN' ),
			'add_or_remove_items'        => __( 'Add or remove years', 'YOUR-TEXTDOMAIN' ),
			'choose_from_most_used'      => __( 'Choose from the most used years', 'YOUR-TEXTDOMAIN' ),
			'not_found'                  => __( 'No years found.', 'YOUR-TEXTDOMAIN' ),
			'no_terms'                   => __( 'No years', 'YOUR-TEXTDOMAIN' ),
			'menu_name'                  => __( 'Years', 'YOUR-TEXTDOMAIN' ),
			'items_list_navigation'      => __( 'Years list navigation', 'YOUR-TEXTDOMAIN' ),
			'items_list'                 => __( 'Years list', 'YOUR-TEXTDOMAIN' ),
			'most_used'                  => _x( 'Most Used', 'years', 'YOUR-TEXTDOMAIN' ),
			'back_to_items'              => __( '&larr; Back to Years', 'YOUR-TEXTDOMAIN' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'years',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'years_init' );

/**
 * Sets the post updated messages for the `years` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `years` taxonomy.
 */
function years_updated_messages( $messages ) {

	$messages['years'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Years added.', 'YOUR-TEXTDOMAIN' ),
		2 => __( 'Years deleted.', 'YOUR-TEXTDOMAIN' ),
		3 => __( 'Years updated.', 'YOUR-TEXTDOMAIN' ),
		4 => __( 'Years not added.', 'YOUR-TEXTDOMAIN' ),
		5 => __( 'Years not updated.', 'YOUR-TEXTDOMAIN' ),
		6 => __( 'Years deleted.', 'YOUR-TEXTDOMAIN' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'years_updated_messages' );
