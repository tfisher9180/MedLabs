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

	$wp_customize->get_section( 'colors' )->panel								= 'wordpress_options';
	$wp_customize->get_section( 'background_image' )->panel			= 'wordpress_options';
	$wp_customize->get_section( 'custom_css' )->panel						= 'wordpress_options';
	$wp_customize->get_section( 'static_front_page' )->panel		= 'wordpress_options';

	$wp_customize->get_section( 'title_tagline' )->panel				= 'theme_options';

	$wp_customize->add_panel( 'wordpress_options', array(
		'priority'				=> 10,
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'WordPress Options', 'medlabs' ),
		'description'			=> __( 'Default options for WordPress', 'medlabs' ),
	));

	$wp_customize->add_panel( 'theme_options', array(
		'priority'				=> 20,
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Theme Options', 'medlabs' ),
		'description'			=> __( 'Custom options for the theme', 'medlabs' ),
	));

	$wp_customize->add_section( 'desktop_mobile_menu', array(
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Desktop/Mobile Menu', 'medlabs' ),
		'panel'						=> 'theme_options',
	));

	$wp_customize->add_section( 'site_navigation', array(
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Site Navigation', 'medlabs' ),
		'panel'						=> 'theme_options',
	));

	$wp_customize->add_setting( 'title_tagline_two', array(
		'default'						=> 'Open 7 Days a Week',
		'type'							=> 'theme_mod',
		'capability'				=> 'edit_theme_options',
		'transport'					=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));

	$wp_customize->add_control( 'title_tagline_two', array(
		'type'							=> 'text',
		'section'						=> 'title_tagline',
		'label'							=> __( 'Tagline 2', 'medlabs' ),
		'description'				=> __( 'Shown on wider screens.', 'medlabs' ),
	));

	$wp_customize->add_setting( 'separate_desktop_mobile_menu', array(
		'default'						=> '1',
		'type'							=> 'theme_mod',
		'capability'				=> 'edit_theme_options',
		'transport'					=> '',
		'sanitize_callback'	=> 'medlabs_sanitize_checkbox',
	));

	$wp_customize->add_control( 'separate_desktop_mobile_menu', array(
		'type'							=> 'checkbox',
		'section'						=> 'desktop_mobile_menu',
		'label'							=> __( 'Separate desktop and mobile menus', 'medlabs' ),
		'description'				=> __( 'If checked, you will be able to create a different menu in the WordPress backend for devices less than 768px, and devices larger than 768px. If unchecked, both locations will use the same WordPress menu.', 'medlabs' ),
	));

	$site_navigation_default_button_one = get_posts( 'post_type=page&post_name=services&posts_per_page=1' );
	$site_navigation_default_button_two = get_posts( 'post_type=page&post_name=locations&posts_per_page=1' );
	$wp_customize->add_setting( 'site_navigation_button_one', array(
		'default'						=> $site_navigation_default_button_one->ID,
		'type'							=> 'theme_mod',
		'capability'				=> 'edit_theme_options',
		'transport'					=> '',
		'sanitize_callback'	=> 'medlabs_sanitize_select',
	));

	$wp_customize->add_control( 'site_navigation_button_one', array(
		'type'							=> 'select',
		'section'						=> 'site_navigation',
		'label'							=> __( 'Button 1', 'medlabs' ),
		'choices'						=> $medlabs_pages,
	));

	$wp_customize->add_setting( 'site_navigation_button_one_icon', array(
		'default'						=> 'fa-stethoscope',
		'type'							=> 'theme_mod',
		'capability'				=> 'edit_theme_options',
		'transport'					=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));

	$wp_customize->add_control( 'site_navigation_button_one_icon', array(
		'type'							=> 'text',
		'section'						=> 'site_navigation',
		'label'							=> __( 'Button 1 Font Awesome Icon', 'medlabs' ),
	));

	$wp_customize->add_setting( 'site_navigation_button_two', array(
		'default'						=> $site_navigation_default_button_two->ID,
		'type'							=> 'theme_mod',
		'capability'				=> 'edit_theme_options',
		'transport'					=> '',
		'sanitize_callback'	=> 'medlabs_sanitize_select',
	));

	$wp_customize->add_control( 'site_navigation_button_two', array(
		'type'							=> 'select',
		'section'						=> 'site_navigation',
		'label'							=> __( 'Button 2', 'medlabs' ),
		'choices'						=> $medlabs_pages,
	));

	$wp_customize->add_setting( 'site_navigation_button_two_icon', array(
		'default'						=> 'fa-map-marker',
		'type'							=> 'theme_mod',
		'capability'				=> 'edit_theme_options',
		'transport'					=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));

	$wp_customize->add_control( 'site_navigation_button_two_icon', array(
		'type'							=> 'text',
		'section'						=> 'site_navigation',
		'label'							=> __( 'Button 2 Font Awesome Icon', 'medlabs' ),
	));

	$wp_customize->add_setting( 'site_navigation_search', array(
		'default'						=> '1',
		'type'							=> 'theme_mod',
		'capability'				=> 'edit_theme_options',
		'transport'					=> '',
		'sanitize_callback'	=> 'medlabs_sanitize_checkbox',
	));

	$wp_customize->add_control( 'site_navigation_search', array(
		'type'							=> 'checkbox',
		'section'						=> 'site_navigation',
		'label'							=> __( 'Show search menu (mobile devices less than 768px)', 'medlabs' ),
	));

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

	function medlabs_sanitize_select( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	function medlabs_sanitize_checkbox( $checked ) {
		// Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
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
