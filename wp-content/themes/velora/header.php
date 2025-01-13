<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NM_Theme
 */

?>
<!doctype html>
<html lang="sr-RS">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
	$clear_header_class = "";
	if ( is_front_page() ) : 
		$clear_header_class = "site--header-clear";
	endif; 
?>
<div id="page" class="site <?php echo $clear_header_class; ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nm_theme' ); ?></a>

	<header id="masthead" class="site-header js-site-header">
		<div class="container">
			<div class="site-header__container">
				<nav id="site-navigation" class="main-navigation__menu-wrap js-navigation">
					<div class="main-navigation__menu-wrap-inner">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'main-navigation__menu',
									'walker'         => new Custom_Walker_Nav_Menu(), // Dodali smo custom walker
								)
							);
						?>
					</div>
				</nav>
				<button type="button" class="site-header__navigation-toggle js-menu-btn">
					<span class="site-header__navigation-toggle-stripe"></span>
					<span class="site-header__navigation-toggle-stripe"></span>
					<span class="site-header__navigation-toggle-stripe"></span>
				</button>
				<div class="site-header__branding">
					<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					    <svg class="site-header__logo-img" version="1.0" xmlns="http://www.w3.org/2000/svg" width="553.333" height="90.667" viewBox="0 0 415 68"><path d="M.7 1.7C.5 2.2 5.3 17 11.3 34.8l11 32.3 10.5-.3 10.5-.3L54.1 35C60 17.7 64.9 2.9 64.9 2.2c.1-1-2-1.2-8.6-1l-8.7.3-7.1 23.2c-3.8 12.7-7.3 23.4-7.6 23.7-.3.4-3.6-9.4-7.4-21.6-3.7-12.3-7.1-23.1-7.7-24.1C17.1 1.3 15.5 1 9 1c-4.3 0-8.1.3-8.3.7zM81.7 1.7c-.4.3-.7 15.2-.7 33V67h46V54H97V41h28V28H97V15h30V1h-22.3c-12.3 0-22.7.3-23 .7zM146 34v33h43V54h-27l-.2-26.3-.3-26.2-7.7-.3-7.8-.3V34zM225 1.9c-8.7 2.7-15.6 8.7-19.4 17-1.7 3.7-2.1 6.6-2.1 15.2 0 10.2.1 10.9 3.5 17.5 5.9 11.4 13.8 15.9 28.1 15.8 12.6 0 22.1-6.1 27.3-17.3 1.7-3.8 2.1-6.5 2.1-15.6 0-9.4-.3-11.7-2.4-16.3-2.9-6.5-10.4-13.4-16.8-15.6-4.8-1.7-15.9-2-20.3-.7zm18.5 16.4c3.7 3.7 5.5 8.9 5.5 16.2 0 10.7-4.2 17.7-11.3 19-12.2 2.3-19.8-7.1-18.4-22.5 1-10.9 5.9-16 15.6-16 4.7 0 5.7.4 8.6 3.3zM284 33.9V67h15V45h8.9l5.8 11 5.8 11h8.3c4.5 0 8.2-.3 8.2-.8 0-.4-2.9-5.9-6.3-12.3l-6.3-11.6 3.9-3.3c5-4.2 6.7-8.3 6.7-16 0-9.5-4.1-16-12.5-19.6-3.1-1.4-7.8-1.9-20.7-2.2L284 .8v33.1zm31.7-16.4c2.2 2.5 2.9 6.7 1.7 10-1.1 2.7-6 4.5-12.4 4.5h-6v-8.3c0-4.6.3-8.7.8-9.1.4-.5 3.6-.6 7.2-.3 5.4.4 6.8.9 8.7 3.2zM371.5 2c-.4.6-5.5 15.5-11.4 33.1l-10.7 32 8.5-.3 8.4-.3 2.2-6.5 2.2-6.5h22.8l1.9 6.7 2 6.8h8.3c6 0 8.3-.3 8.2-1.3 0-.6-4.8-15.4-10.7-32.7L392.5 1.5l-10.2-.3c-6.3-.2-10.4.1-10.8.8zm13.9 26.2c1.6 5.1 3.1 10.1 3.3 11 .5 1.6-.3 1.8-6.6 1.8-3.9 0-7.1-.3-7.1-.7 0-1.8 6.4-21.3 7-21.3.3 0 1.9 4.2 3.4 9.2z"></path></svg>
					</a>
				</div>
				<div class="site-header__actions">
					<ul class="site-header__actions-list">
						<li class="site-header__actions-item">
							<a class="site-header__actions-link cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Pogledajte vašu korpu' ); ?>">
								<span class="icon font-cart"></span>
								<span class="site-header__actions-link-sup js-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">
