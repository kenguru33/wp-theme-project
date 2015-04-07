<?php
/**
 * MySite functions and definitions
 *
 * @package MySite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
//if ( ! isset( $content_width ) ) {
//	$content_width = 640; /* pixels */
//}

if ( ! function_exists( 'mysite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mysite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MySite, use a find and replace
	 * to change 'mysite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mysite', 'assets/languages' );

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
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mysite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mysite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mysite_setup
add_action( 'after_setup_theme', 'mysite_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mysite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mysite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'mysite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mysite_scripts() {
	wp_enqueue_style( 'mysite-style', get_stylesheet_uri() );

	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/assets/css/style.css' );

    wp_enqueue_script("jquery");
    //wp_enqueue_script("app.js", get_template_directory_uri() . '/assets/js/app.js', array(), '01022015', true);

	wp_enqueue_script( 'mysite-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'mysite-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );
    wp_enqueue_script("parallax-window.js", get_template_directory_uri() . '/assets/js/parallax-window.js', array(), '01022015', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mysite_scripts' );

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

/**
 * Theme admin setup
 */

function theme_header_options_settings() {
	echo "theme header options settings";
}

function setup_theme_admin_menus() {
	add_submenu_page('themes.php',
		'Header Options', 'Header Options', 'manage_options',
		'header-options', 'theme_header_options_settings');
}

add_action("admin_menu", "setup_theme_admin_menus");


add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
	add_theme_page('My Plugin Theme', 'My Plugin', 'edit_theme_options', 'my-unique-identifier', 'my_plugin_function');
}




// add our custom header options hook
add_action('custom_header_options', 'my_custom_image_options');

/* Adds two new text fields, custom_option_one and custom_option_two to the Custom Header options screen */
function my_custom_image_options()
{
	?>
	<table class="form-table">
		<tbody>
		<tr valign="top" class="hide-if-no-js">
			<th scope="row"><?php _e( 'Custom Option One:' ); ?></th>
			<td>
				<p>
					<input type="text" name="custom_option_one" id="custom_option_one" value="<?php echo esc_attr( get_theme_mod( 'custom_option_one', 'Default Value' ) ); ?>" />
				</p>
			</td>
		</tr>
		<tr valign="top" class="hide-if-no-js">
			<th scope="row"><?php _e( 'Custom Option Two:' ); ?></th>
			<td>
				<p>
					<input type="text" name="custom_option_two" id="custom_option_two" value="<?php echo esc_attr( get_theme_mod( 'custom_option_two', 'Default Value' ) ); ?>" />
				</p>
			</td>
		</tr>
		</tbody>
	</table>
<?php
} // end my_custom_image_options

