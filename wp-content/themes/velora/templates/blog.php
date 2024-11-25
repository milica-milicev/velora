<?php
/**
 * Template Name: Blog
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NM_Theme
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php // get content blocks
			
			// get_template_part( 'template-views/blocks/banner/banner-blog' );
            // get_template_part( 'template-views/blocks/blog/blog' );
		?>
	</main>
</div>

<?php
get_footer();