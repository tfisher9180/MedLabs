<?php

// Title Tagline Line Two
// -----------------------------
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