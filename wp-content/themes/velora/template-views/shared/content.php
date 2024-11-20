<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NM_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-article' ); ?>>
	<div class="post-article__head">
		<h2 class="section-title post-article__title"><?php the_title(); ?></h2>
	</div>
	<div class="entry-content post-article__content">
		<?php the_content(); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
