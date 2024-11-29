<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Madera
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="banner-single">
				<div class="container container--sm">
					<div class="banner-single-content">
						<h1 class="banner-single-conten__title"><?php the_title(); ?></h1>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</div>
		

			<div class="main-content">
				<div class="container">
					<div class="banner-single__img">
						<img src="<?php the_post_thumbnail_url('banner-single'); ?>" alt="">
					</div>
				</div>
				<div class="container container--sm">
					<?php
					while ( have_posts() ) : the_post(); ?>
						<div class="entry-content  single-post__content">
							<?php the_content(); ?>
						</div>
						<!-- <div class="author-info">
							<div class="author-avatar">
								<?php echo get_avatar(get_the_author_meta('user_email'), 64); ?>
							</div>
							<div class="author-details">
								<span class="author-name"><?php the_author(); ?></span>
								<span class="author-bio"><?php echo get_the_author_meta('description'); ?></span>
							</div>
						</div> -->
						<?php
					endwhile; // End of the loop.
					?>
				</div>
			</div>

			<div class="recente-blogs">
				<div class="container container--sm">
					<div class="entry-content">
						<h2>Poslednji blog postovi</h2>
					</div>
				
					<div class="recente-blogs__container">
					
						<?php
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => 2
							);

							$recent_posts = new WP_Query($args);

							if ($recent_posts->have_posts()) :
								while ($recent_posts->have_posts()) : $recent_posts->the_post();
							?>
								
								<div class="recente-blog__single">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="<?php the_title(); ?>">
										<div class="entry-content">
											<h3><?php the_title(); ?></h3>
											<p><?php echo get_the_excerpt(); ?></p>
										</div>
										
										<span class="btn">Pročitajte više</span>
									</a>
								</div>
								
							<?php
								endwhile;
								wp_reset_postdata();
							endif;
						?>
					</div>
				</div>
			</div>
		</main><!-- #main -->						
	</div><!-- #primary -->

<?php
get_footer();