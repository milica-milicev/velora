<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<div class="categories categories--listing categories--centar">
		<div class="container">
			<div class="categories__header">
				<h2 class="section-title section-title--sm categories__title">Istražite naše najpopularnije kategorije:</h2>
			</div>
			<div class="categories__row">
				<?php
				// Definišite ID-jeve kategorija koje želite da prikažete
				$category_ids = array( 17, 38 );

				// Povucite podatke o tim kategorijama
				$product_categories = get_terms( array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => true,
					'include'    => $category_ids, // Uključuje samo specifične kategorije
				) );

				// Proverite da li postoje kategorije
				if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) : ?>
					<?php foreach ( $product_categories as $category ) :
						$category_link = get_term_link( $category );
						if ( ! is_wp_error( $category_link ) ) : ?>
							<div class="categories__item">
								<a href="<?php echo esc_url( $category_link ); ?>">
									<span><?php echo esc_html( $category->name ); ?></span>
								</a>
							</div>
						<?php endif;
					endforeach; ?>
				<?php else :
					echo '<p>' . __( 'No categories available.', 'woocommerce' ) . '</p>';
				endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>