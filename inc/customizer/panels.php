<?php

// WordPress Options
// ---------------------------
$wp_customize->add_panel( 'wordpress_options', array(
	'priority'				=> 10,
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'WordPress Options', 'medlabs' ),
	'description'			=> __( 'Default options for WordPress', 'medlabs' ),
));

// Theme Options
// ---------------------------
$wp_customize->add_panel( 'theme_options', array(
	'priority'				=> 20,
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'Theme Options', 'medlabs' ),
	'description'			=> __( 'Custom options for the theme', 'medlabs' ),
));