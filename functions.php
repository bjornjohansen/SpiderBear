<?php
/**
 * SpiderBear functions and definitions
 *
 * @package SpiderBear
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spiderbear_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'spiderbear_content_width', 1000 );
}
add_action( 'after_setup_theme', 'spiderbear_content_width', 0 );


if ( ! function_exists( 'spiderbear_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function spiderbear_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on SpiderBear, use a find and replace
	 * to change 'spiderbear' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'spiderbear', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'spiderbear-large', '1440', '960', false );

	// Enable support for custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 400,
		'width'       => 1200,
		'flex-height' => true,
		'flex-width'  => true
	) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Slide-Out Menu', 'spiderbear' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'spiderbear_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
endif; // spiderbear_setup
add_action( 'after_setup_theme', 'spiderbear_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function spiderbear_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'spiderbear' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'spiderbear' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'spiderbear' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'spiderbear' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'spiderbear_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function spiderbear_scripts() {
	wp_enqueue_style( 'spiderbear-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), filemtime( get_template_directory() . '/genericons/genericons.css' ) );

	wp_enqueue_script( 'spiderbear-script', get_template_directory_uri() . '/js/spiderbear.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/spiderbear.js' ), true );

	wp_enqueue_script( 'spiderbear-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), filemtime( get_template_directory() . '/js/skip-link-focus-fix.js' ), true );

	if ( is_single() ) {
		wp_enqueue_style( 'highlight-style', get_template_directory_uri() . '/js/highlight/styles/atom-one-dark.css', array(), filemtime( get_template_directory() . '/js/highlight/styles/atom-one-dark.css' ) );
		wp_enqueue_script( 'highlight-script', get_template_directory_uri() . '/js/highlight/highlight.pack.js', [ 'jquery' ], filemtime( get_template_directory() . '/js/highlight/highlight.pack.js' ), true );
		wp_enqueue_script( 'spiderbear-highlight-script', get_template_directory_uri() . '/js/spiderbear-highlight.js', [ 'jquery', 'highlight-script' ], filemtime( get_template_directory() . '/js/spiderbear-highlight.js' ), true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//wp_enqueue_style( 'spiderbear-lato', spiderbear_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'spiderbear_scripts' );

/**
 * Register Google Fonts
 */
function spiderbear_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
	 * supported by Lato, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$arimo = esc_html_x( 'on', 'Lato font: on or off', 'spiderbear' );

	if ( 'off' !== $arimo ) {
		$font_families = array();
		$font_families[] = 'Lato:300,400,700,300italic,400italic,700italic&subset=latin,latin-ext';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

if ( ! function_exists( 'spiderbear_continue_reading_link' ) ) :
/**
 * Returns an ellipsis and "Continue reading" plus off-screen title link for excerpts
 */
function spiderbear_continue_reading_link() {
	return '<a href="'. esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( 'Read More <span class="screen-reader-text">%1$s</span>', 'spiderbear' ), esc_attr( strip_tags( get_the_title() ) ) ) . '</a>';
}
endif; // spiderbear_continue_reading_link

/**
 * Always display a Read More link when using the_excerpt()
 */
function spiderbear_excerpt_more( $output ) {
	return $output . spiderbear_continue_reading_link();
}
add_filter( 'the_excerpt', 'spiderbear_excerpt_more' );

/**
 * Wrap the intro text in a container for styling, and insert the content-meta template part.
 */
add_filter ( 'the_content', function ( $content ) {
	if ( ! is_singular() ) {
		return $content;
	}

	ob_start();
	get_template_part( 'template-parts/content-meta', get_post_type() );
	$meta = ob_get_clean();

	if ( strpos( $content, '<!--more-->' ) ) {
		$content = '<div class="entry-intro">' . str_replace( '<!--more-->', '</div>' . $meta . '<!--more-->', $content );
	} elseif ( strpos( $content, '<p><span id="more-' ) ) {
		$content = '<div class="entry-intro">' . str_replace( '<p><span id="more-', '</div>' . $meta . '<p><span id="more-', $content );
	} elseif ( strpos( $content, '<span id="more-' ) ) {
		$content = '<div class="entry-intro">' . str_replace( '<span id="more-', '</div>' . $meta . '<span id="more-', $content );
	} else {
		$content = $meta . $content;
	}

	return $content;
}, 10, 1 );

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

