<?php

$wp_customize->add_section( 'social_media', array(
	'capability'				=> 'edit_theme_options',
	'title'							=> __( 'Social Media', 'srcc' ),
	'description'				=> 'Filled in fields will show a social media FontAwesome icon in certain areas.',
	'panel'							=> 'theme_options',
) );


// Facebook
// -----------------------------
$wp_customize->add_setting( 'url_facebook', array(
	'default'			=> 'https://www.facebook.com',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_facebook', array(
	'type'				=> 'url',
	'section'			=> 'social_media',
	'label'				=> __( 'Facebook URL', 'srcc' ),
	'description'		=> '',
) );


// Twitter
// -----------------------------
$wp_customize->add_setting( 'url_twitter', array(
	'default'			=> 'https://www.twitter.com',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_twitter', array(
	'type'				=> 'url',
	'section'			=> 'social_media',
	'label'				=> __( 'Twitter URL', 'srcc' ),
	'description'		=> '',
) );


// Instagram
// -----------------------------
$wp_customize->add_setting( 'url_instagram', array(
	'default'			=> 'https://www.instagram.com',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_instagram', array(
	'type'				=> 'url',
	'section'			=> 'social_media',
	'label'				=> __( 'Instagram URL', 'srcc' ),
	'description'		=> '',
) );


// Google
// -----------------------------
$wp_customize->add_setting( 'url_google', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_google', array(
	'type'				=> 'url',
	'section'			=> 'social_media',
	'label'				=> __( 'Google URL', 'srcc' ),
	'description'		=> '',
) );


// LinkedIn
// -----------------------------
$wp_customize->add_setting( 'url_linkedin', array(
	'default'			=> 'https://www.linkedin.com',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_linkedin', array(
	'type'				=> 'url',
	'section'			=> 'social_media',
	'label'				=> __( 'LinkedIn URL', 'srcc' ),
	'description'		=> '',
) );