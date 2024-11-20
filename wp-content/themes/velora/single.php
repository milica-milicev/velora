<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NM_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); ?>

			<div class="container">
				<div class="container__inner">
					<div class="post-wrap">
						<?php get_template_part( 'template-views/shared/content' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;
						?>
					</div>
				</div>
			</div>
		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
