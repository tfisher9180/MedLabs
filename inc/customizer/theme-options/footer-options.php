<?php

$wp_customize->add_section( 'footer_options', array(
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'Footer Options', 'medlabs' ),
	'panel'						=> 'theme_options',
));

// Footer Disclaimer
// -----------------------------
$wp_customize->add_setting( 'footer_disclaimer', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'transport'					=> '',
	'sanitize_callback'	=> 'sanitize_text_field',
));

$wp_customize->add_control( 'footer_disclaimer', array(
	'type'							=> 'textarea',
	'section'						=> 'footer_options',
	'label'							=> __( 'Footer Disclaimer', 'medlabs' ),
	'description'				=> __( 'Shown on wider screens.', 'medlabs' ),
));
