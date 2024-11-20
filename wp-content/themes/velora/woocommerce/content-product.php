<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( 'product-item', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */

	$product_id = get_the_ID(); // Uzimanje ID-a trenutnog proizvoda
	$hover_image = get_field('hover_image', $product_id); // Dohvatanje ACF hover slike
	$hover_anim = "";

	if (!$hover_image) :
		$hover_anim = 'product-item__no-hover-anim';
	endif;
	?>

	<div class="product-item__wrap">
		<a href="<?php the_permalink(); ?>" class="product-item__img-wrapper woocommerce-LoopProduct-link <?php echo $hover_anim; ?>">
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */

			if ($hover_image) : ?>
				<img class="product-item__hover-img" src="<?php echo $hover_image['url']; ?>" alt="<?php echo esc_attr(get_the_title($product_id)); ?>" />
			<?php endif;

			do_action( 'woocommerce_before_shop_loop_item_title' ); 
			?>
		</a>

		<!-- <div class="product-item__actions">
			<?php //woocommerce_template_loop_add_to_cart(); ?>
		</div> -->
	</div>

	<div class="product-item__info">
		<?php
		woocommerce_template_loop_product_link_open();
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		woocommerce_template_loop_product_link_close();

		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		//do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
		<div class="product-item__price">
			<?php woocommerce_template_loop_price(); ?>
		</div>
		<?php /**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		// do_action( 'woocommerce_after_shop_loop_item' );
		?>

		
	</div>
</div>
