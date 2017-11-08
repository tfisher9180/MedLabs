<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MedLabs
 */
?>

<?php

	$site_navigation_buttons = array(
		'one'			=> array(
			'page'			=> get_theme_mod( 'site_navigation_button_one' ),
			'icon'			=> get_theme_mod( 'site_navigation_button_one_icon', 'fa-stethoscope' ),
		),
		'two'			=> array(
			'page'			=> get_theme_mod( 'site_navigation_button_two' ),
			'icon'			=> get_theme_mod( 'site_navigation_button_two_icon', 'fa-map-marker' ),
		),
	);

	$site_navigation_search = get_theme_mod( 'site_navigation_search' );

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav id="mobile-navigation" class="site-navigation">
	<?php
		wp_nav_menu( array(
			'theme_location' => get_theme_mod( 'separate_desktop_mobile_menu' ) == 1 ? 'mobile-navigation' : 'site-navigation',
			'menu_id'        => 'mobile-navigation-menu',
			'menu_class'		 => 'nav-menu site-nav-menu',
			'container'			 => 'false',
		) );
	?>
	<?php
		wp_nav_menu( array(
			'theme_location' => 'secondary-navigation',
			'menu_id'        => 'mobile-secondary-navigation-menu',
			'menu_class'		 => 'nav-menu secondary-nav-menu',
			'container'			 => 'false',
		) );
	?>
</nav><!-- #site-navigation -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'medlabs' ); ?></a>

	<div id="supernav" class="supernav">
		<div class="container">
			<div class="flex-container">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'secondary-navigation',
						'menu_id'        => 'secondary-navigation-menu',
						'menu_class'		 => 'nav-menu secondary-nav-menu flex-container',
						'container'			 => 'false',
					) );
				?>
			</div>
		</div>
	</div>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<div class="container">
				<div class="flex-container">
					<div class="logo">
						<?php if ( has_custom_logo() ) {
							the_custom_logo();
						} else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo get_template_directory_uri() . '/images/logo.svg' ?>" alt="<?php echo get_bloginfo( 'name' ) . ' logo'; ?>" />
							</a>
						<?php } ?>
					</div><!-- .logo -->
					<div class="tagline">
						<?php $description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					</div><!-- .tagline -->
				</div><!-- .flex-container -->
			</div><!-- .container -->
		</div><!-- .site-branding -->

		<div class="site-navbar">
			<div class="mobile-navbar">
				<div class="flex-container">
					<?php foreach ( $site_navigation_buttons as $button ) { ?>
					<div class="nav-btn nav-btn-page">
						<a href="<?php echo get_permalink( $button[ 'page' ] ); ?>">
							<?php echo ( isset( $button[ 'icon' ] ) ) ? '<i class="fa ' . $button[ 'icon' ] .'"></i>' : ''; ?>
							<?php echo get_the_title( $button[ 'page' ] ); ?>
						</a>
					</div>
					<?php } ?>
					<?php if ( $site_navigation_search ) { ?>
					<div class="nav-btn nav-search nav-drawer">
						<a href="#">
							<span class="screen-reader-text"><?php esc_html_e( 'Toggle search bar', 'medlabs' ); ?></span>
							<i class="fa fa-search"></i>
						</a>
						<div class="drawer search-bar">
							<?php get_search_form(); ?>
						</div>
					</div>
					<?php } ?>
					<div class="nav-btn nav-toggle">
						<a href="#" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false">
							<span class="screen-reader-text"><?php esc_html_e( 'Toggle Site Navigation', 'medlabs' ); ?></span>
							<span class="menu-icon"></span>
						</a>
					</div>
				</div><!-- .flex-container -->
			</div><!-- .mobile-navbar -->
			<div class="container">
				<nav id="site-navigation" class="site-navigation">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'site-navigation',
								'menu_id'        => 'site-navigation-menu',
								'menu_class'		 => 'nav-menu flex-container',
								'container'			 => 'false',
							) );
						?>
				</nav><!-- #site-navigation -->
			</div><!-- .container -->
		</div><!-- .site-navbar -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
