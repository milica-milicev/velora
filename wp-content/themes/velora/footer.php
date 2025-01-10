<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NM_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="site-footer__container">
				<div class="site-footer__item">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="">
					<ul>
						<li><span>Mili Shop d.o.o</span></li>
						<li>Telefon: <a href="tel:0603214261">0603214261</a></li>
						<li>E-mail: <a href="mailto:info@velora.rs">info@velora.rs</a></li>
						<li><span>PIB: 114776247</span></li>
						<li><span>Matični broj: 67846397</span></li>
					</ul>
				</div>
				<div class="site-footer__item">
					<h2>Informacije</h2>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'secondary-menu',
							'menu_class'     => 'site-footer__item-list',
						)
					);
					?>
				</div>

				<div class="site-footer__item">
					<h2>Pratite nas</h2>
					<div class="site-footer__item-media">
						<a href="javascript:;"><span class="font-instagram"></span></a>
						<a href="javascript:;"><span class="font-facebook"></span></a>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<p class="site-footer__copyright">Sva prava zadržana &copy; <?php echo date('Y'); ?> Velora</p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
