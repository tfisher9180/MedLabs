<?php
/**
 * MedLabs Theme Customizer
 *
 * @package MedLabs
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function medlabs_customize_register( $wp_customize ) {
	$medlabs_pages = array();
	$medlabs_pages_object = get_posts( 'post_type=page&posts_per_page=-1' );
	$medlabs_pages[ '' ] = __( 'Choose page', 'medlabs' );
	foreach ( $medlabs_pages_object as $medlabs_page ) {
		$medlabs_pages[ $medlabs_page->ID ] = $medlabs_page->post_title;
	}


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Customizer Panels
	 */
	require get_template_directory() . '/inc/customizer/panels.php';

	/**
	 * WordPress Options
	 */
	require get_template_directory() . '/inc/customizer/wordpress-options.php';

	/**
	 * Theme Options - Site Identity
	 */
	require get_template_directory() . '/inc/customizer/theme-options/site-identity.php';

	/**
	 * Theme Options - Social Media
	 */
	require get_template_directory() . '/inc/customizer/theme-options/social-media.php';

	/**
	 * Theme Options - Desktop/Mobile Menu
	 */
	require get_template_directory() . '/inc/customizer/theme-options/desktop-mobile-menu.php';

	/**
	 * Theme Options - Site Navigation
	 */
	require get_template_directory() . '/inc/customizer/theme-options/site-navigation.php';

	/**
	 * Theme Options - Footer Options
	 */
	require get_template_directory() . '/inc/customizer/theme-options/footer-options.php';

	/**
	 * Sanitize Callbacks
	 */
	require get_template_directory() . '/inc/customizer/sanitizations.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'medlabs_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'medlabs_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'medlabs_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function medlabs_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function medlabs_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function medlabs_customize_preview_js() {
	wp_enqueue_script( 'medlabs-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'medlabs_customize_preview_js' );
