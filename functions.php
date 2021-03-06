<?php
/**
 * MedLabs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MedLabs
 */

$blog_name 						= get_bloginfo( 'name' );
$blog_name_slug 				= strtolower( str_replace( ' ', '-', trim( $blog_name ) ) );
$blog_name_category_name 		= ucwords( $blog_name ) . ' Blog';
$blog_name_category_slug 		= $blog_name_slug . '-blog';

if ( ! function_exists( 'medlabs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function medlabs_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MedLabs, use a find and replace
		 * to change 'medlabs' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'medlabs', get_template_directory() . '/languages' );

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
		set_post_thumbnail_size( 1024, 536, true );
		add_image_size( 'medlabs-blog-featured-image', 1024, 536, true );
		add_image_size( 'medlabs-blog-page-header', 1400, 300, true );

		$nav_menus = array(
			'site-navigation' 			=> esc_html__( 'Site Navigation', 'medlabs' ),
			'secondary-navigation'	=> esc_html__( 'Secondary Navigation', 'medlabs' ),
		);

		if ( get_theme_mod( 'separate_desktop_mobile_menu' ) == 1 ) {
			$nav_menus[ 'mobile-navigation' ] = esc_html__( 'Mobile Navigation', 'medlabs' );

			if ( ! wp_get_nav_menu_object( 'Mobile Navigation' ) ) {
				$menu_id = wp_create_nav_menu( 'Mobile Navigation' );
				$locations = get_theme_mod( 'nav_menu_locations' );
				$locations[ 'mobile-navigation' ] = $menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}
		}

		// This theme uses wp_nav_menu() in two-three locations.
		register_nav_menus( $nav_menus );

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
		add_theme_support( 'custom-background', apply_filters( 'medlabs_custom_background_args', array(
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
add_action( 'after_setup_theme', 'medlabs_setup' );

function medlabs_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Montserrat, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$font_families = array();

	$montserrat = _x( 'on', 'Montserrat font: on or off', 'medlabs' );

	if ( 'off' !== $montserrat ) {
		$font_families[] = 'Montserrat:300,400,500,600,700';
	}

	if ( in_array( 'on', array( $montserrat ) ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

function medlabs_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'medlabs-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'medlabs_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function medlabs_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'medlabs_content_width', 640 );
}
add_action( 'after_setup_theme', 'medlabs_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medlabs_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'medlabs' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'medlabs' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'medlabs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function medlabs_scripts() {
	wp_enqueue_style( 'medlabs-fonts', medlabs_fonts_url(), array(), null );

	wp_enqueue_style( 'medlabs-style', get_stylesheet_uri() );

	wp_enqueue_script( 'medlabs-scripts', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '1.0', true );

	wp_localize_script( 'medlabs-scripts', 'medlabsScreenReaderText', array(
		'expand'			=> __( 'Expand child menu', 'medlabs' ),
		'collapse'		=> __( 'Collapse child menu', 'medlabs' ),
		'back_sr'			=> __( 'Go back', 'medlabs' ),
		'back_menu'		=> __( 'Menu', 'medlabs' ),
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'medlabs_scripts' );

function medlabs_get_social() {
	$social_media = array(
		'facebook'			=> get_theme_mod( 'url_facebook', 'https://www.facebook.com' ),
		'twitter'			=> get_theme_mod( 'url_twitter', 'https://www.twitter.com' ),
		'instagram'			=> get_theme_mod( 'url_instagram', 'https://www.instagram.com' ),
		'google-plus'		=> get_theme_mod( 'url_google', '' ),
		'linkedin'			=> get_theme_mod( 'url_linkedin', 'https://www.linkedin.com' ),
	);
	
	$social_media = array_filter( $social_media, function( $value, $key ) {
		return $value;
	}, ARRAY_FILTER_USE_BOTH ); // for clarity

	if ( ! empty( $social_media ) ) { ?>
		<div class="social">
		<?php foreach ( $social_media as $platform => $url ) { ?>

			<a href="<?php printf( esc_html__( '%s', 'medlabs' ), esc_url( trim( $url ) ) ); ?>" target="_blank" class="icon icon-<?php printf( esc_attr__( '%s', 'medlabs' ), strtolower( $platform ) ); ?>">
				<span class="screen-reader-text"><?php printf( esc_html__( '%s', 'medlabs' ), ucwords( $platform ) ); ?></span>
				<i class="fa fa-<?php printf( esc_html__( '%s', 'medlabs' ), strtolower( $platform ) ); ?>"></i>
			</a>
		<?php } ?>
		</div>
	<?php }
}

function medlabs_get_social_share( $permalink, $article_title ) {
	$social_media = array(
		'facebook'			=> 'http://www.facebook.com/sharer.php?u='.$permalink.'&t='.$article_title,
		'twitter'			=> 'http://www.twitter.com/home/?status='.$article_title.' - '.$permalink,
		'linkedin'			=> 'http://www.linkedin.com/shareArticle?mini=true&url='.$permalink.'&title='.$article_title,
	); ?>

	<div class="social">
	<?php foreach ( $social_media as $platform => $url ) { ?>
		<a href="<?php printf( esc_html__( '%s', 'medlabs' ), esc_url( $url ) ); ?>" target="_blank" class="icon icon-<?php printf( esc_attr__( '%s', 'medlabs' ), strtolower( $platform ) ); ?>">
			<span class="screen-reader-text"><?php printf( esc_html__( '%s', 'medlabs' ), 'Share this article on '.ucwords( $platform ) ); ?></span>
			<i class="fa fa-<?php printf( esc_html__( '%s', 'medlabs' ), strtolower( $platform ) ); ?>"></i>
		</a>
	<?php } ?>
	</div>
<?php }

function medlabs_init_blog_categories() {
	global $blog_name_category_slug;
	global $blog_name_category_name;

	if ( ! term_exists( $blog_name_category_slug, 'category' ) ) {
		wp_insert_term(
			'Blog Footer Post',
			'category',
			array(
				'slug'			=> 'blog-footer-post',
				'description'	=> 'Posts assigned to this category will be appended to the bottom of every post.'
			)
		);
		wp_insert_term(
			$blog_name_category_name,
			'category',
			array(
				'slug'			=> $blog_name_category_slug,
				'description'	=> 'All posts that should be displayed in the site\'s blog should be assigned to this category'
			)
		);
	}
}
add_action( 'init', 'medlabs_init_blog_categories' );

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
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
