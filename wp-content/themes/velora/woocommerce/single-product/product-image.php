<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

// main image ID
$post_thumbnail_id = $product->get_image_id();
// gallery images IDs
$attachment_ids = $product->get_gallery_image_ids();
?>

<div class="product__gallery js-product-gallery">
	<!-- Main slider images-->
	<?php if ( ! empty( $attachment_ids ) && count( $attachment_ids ) > 0 ) : ?>
		<div class="product__gallery-main-slider-wrap">
			<div class="product__gallery-main-slider js-product-main">
				<div class="swiper-wrapper">
					<?php foreach ( $attachment_ids as $attachment_id ) : ?>
						<div class="swiper-slide product__gallery-main-slider-img">
							<?php echo wp_get_attachment_image( $attachment_id, 'woocommerce_single' ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<!-- Strelice za navigaciju -->
			<div class="product__gallery-main__nav product__gallery-main__nav-prev font-chevron-left js-product-main-prev-btn"></div>
			<div class="product__gallery-main__nav product__gallery-main__nav-next font-chevron-right js-product-main-next-btn"></div>
		</div>
    <?php else: ?>
        <!-- Main product image if gallery is empty -->
        <div class="product__gallery-main-img js-gallery-main-img">
            <?php echo wp_get_attachment_image( $post_thumbnail_id, 'woocommerce_single' ); ?>
        </div>
    <?php endif; ?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>

<!-- Modal za prikazivanje velikih slika -->

<div class="product__gallery-modal js-product-gallery-modal">
	<span class="product__gallery-modal-overlay js-product-gallery-modal-overlay"></span>
	<span class="product__gallery-modal-close-btn js-product-gallery-modal-close-btn"><span class="font-close"></span></span>
    <div class="product__gallery-modal-inner js-product-gallery-modal-inner">
        <div class="product__gallery-modal-slider js-product-gallery-modal-slider">
			<div class="swiper-wrapper">
			<?php if ( ! empty( $attachment_ids ) && count( $attachment_ids ) > 0 ) : ?>
				<?php foreach ( $attachment_ids as $attachment_id ) : ?>
					<div class="swiper-slide product__gallery-modal-slider-img">
						<?php echo wp_get_attachment_image( $attachment_id, 'woocommerce_single' ); ?>
					</div>
				<?php endforeach; ?>
				<?php else : ?>
					<div class="swiper-slide product__gallery-modal-slider-img">
						<?php echo wp_get_attachment_image( $post_thumbnail_id, 'woocommerce_single' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<!-- Add Arrows -->
		<div class="swiper-button-prev js-product-modal-prev-btn"></div>
		<div class="swiper-button-next js-product-modal-next-btn"></div>
    </div>
</div>


