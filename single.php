<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MedLabs
 */

global $blog_name_category_slug; 

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post(); ?>

			<?php
			if ( ! in_category( $blog_name_category_slug ) ) {
				global $wp_query;
				$wp_query->set_404();
				status_header( 404 );
				get_template_part( 404 ); 
				exit();
			}
			?>

			<header class="page-header">
				<div class="container">
					<div class="entry-meta">
						<?php medlabs_posted_on(); ?>
					</div>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
			</header>

			<div class="container">
			<div class="sidebar-layout">
			<?php get_template_part( 'template-parts/content', get_post_type() );

			//the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			endwhile; // End of the loop.
			get_sidebar(); ?>
			</div><!-- .sidebar-layout -->
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
