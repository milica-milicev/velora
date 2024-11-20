<div class="post-item">
	<div class="post-item__img">
		<?php $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
		<a href="<?php echo get_the_permalink(); ?>" class="post-item__img-link">
			<img class="lazy" data-src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>">
		</a>
	</div>
	<div class="post-item__info">
		<h2 class="post-item__title">
			<a href="<?php echo get_the_permalink(); ?>" class="post-item__link"><?php echo get_the_title(); ?></a>
		</h2>
		<!-- post info -->
		<div class="post-item__excerpt">
			<?php echo get_the_excerpt(); ?>
		</div>
		<a href="<?php echo get_the_permalink(); ?>" class="post-item__btn btn">Read Full Article</a>
	</div>
</div>