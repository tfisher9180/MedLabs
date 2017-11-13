<?php

$wp_customize->add_section( 'desktop_mobile_menu', array(
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'Desktop/Mobile Menu', 'medlabs' ),
	'panel'						=> 'theme_options',
));

// Separate desktop and mobile menus
// -----------------------------
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