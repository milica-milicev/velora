<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package NM_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<div class="error-404__header">
				<div class="container">
					<h1 class="error-404__title">
						<span class="error-404__title-1">4</span>
						<span class="error-404__title-2">0</span>
						<span class="error-404__title-3">4</span>
					</h1>
				</div>
			</div>

			<div class="error-404__content">
				<div class="container">
					<div class="error-404__text">
						<p><?php esc_html_e( 'Poštovani korisniče,', 'nm_theme' ); ?></p>
						<p><?php esc_html_e( 'Stranica ili proizvod koji tražite je trenutno nedostupan.', 'nm_theme' ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404__btn btn">Povratak na početnu stranicu</a>
				</div>
			</div><!-- .page-content -->

			<div class="error-404__tiles">
				<div class="container">
					<?php get_template_part( 'template-views/blocks/tiles/tiles' ); ?>
				</div>
			</div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
