<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MedLabs
 */

global $blog_name_category_slug; 

?>

<?php if ( in_category( $blog_name_category_slug ) ) { ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="featured-image">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php } ?>

	<?php if ( is_home() ) : ?>
	<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php medlabs_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'medlabs' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			if ( is_singular() ) {
				$args = array(
					'post_type'			=> 'post',
					'category_name'		=> 'blog-footer-post',
					'posts_per_page'	=> 1,
				);

				$blog_footer_post = new WP_Query( $args );
			
				if ( $blog_footer_post->have_posts() ) { 
					$blog_footer_post->the_post();

					the_title( '<h2>', '</h2>' ); the_content();
					wp_reset_query();
				}
			}
		?>
	</div><!-- .entry-content -->

	<?php if ( is_singular() ) { ?>
	<footer class="entry-footer">
		<div class="share-this">
			<h3 class="share-this-title"><?php echo esc_html__( 'Share this Article', 'medlabs' ); ?></h3>
			<?php medlabs_get_social_share( get_the_permalink(), get_the_title() ); ?>
		</div>
	</footer><!-- .entry-footer -->
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php } ?>
