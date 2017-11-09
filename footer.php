<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MedLabs
 */
?>

<?php

	$disclaimer_txt = get_theme_mod( 'footer_disclaimer', '' );

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="flex-container">
				<div class="disclaimer"><?php printf( esc_html__( '%s', 'medlabs' ), $disclaimer_txt ); ?></div>
				<div class="site-info">
					<div class="social-box">
						<div class="h1"><?php echo esc_html__( 'Connect With Us', 'medlabs' ); ?></div>
						<?php medlabs_get_social(); ?>
					</div>
					<div class="copyright">
						<?php printf( esc_html__( '&copy; %1$s %2$s', 'medlabs' ), date( 'Y' ), get_bloginfo( 'name' ) ); ?>
					</div>
				</div><!-- .site-info -->
			</div><!-- .flex-container -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
