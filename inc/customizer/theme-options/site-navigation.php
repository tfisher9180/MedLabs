<?php

$wp_customize->add_section( 'site_navigation', array(
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'Site Navigation', 'medlabs' ),
	'panel'						=> 'theme_options',
));

// Get servives  and locations pages for select boxes
// -----------------------------
$site_navigation_default_button_one = get_posts( 'post_type=page&post_name=services&posts_per_page=1' );
$site_navigation_default_button_two = get_posts( 'post_type=page&post_name=locations&posts_per_page=1' );


// Button One
// -----------------------------
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

// Button One Icon
// -----------------------------
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

// Button Two
// -----------------------------
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

// Button Two Icon
// -----------------------------
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

// Search button
// -----------------------------
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