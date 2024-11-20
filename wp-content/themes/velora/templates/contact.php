<?php
/**
 * Template Name: Contact
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
			
			get_template_part( 'template-views/blocks/banner/banner' );
            get_template_part( 'template-views/blocks/contact/contact' );
			// get_template_part( 'template-views/blocks/hero/hero' );
			// get_template_part( 'template-views/blocks/services/services' );
			// get_template_part( 'template-views/blocks/categories/categories' );
			// get_template_part( 'template-views/blocks/products-slider/products-slider' );
			// get_template_part( 'template-views/blocks/banner-box/banner-box' );
			// get_template_part( 'template-views/blocks/recent-posts/recent-posts' );
			// get_template_part( 'template-views/blocks/basic-block/basic-block' );
		?>
	</main>
</div>

<?php
get_footer();