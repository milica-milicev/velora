<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( $related_products ) : ?>

    <div class="products-slider products-slider--related">
        <?php
        $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Možda te i ovo zanima', 'woocommerce' ) );

        if ( $heading ) : ?>
            <div class="products-slider__head">
                <h2 class="section-title products-slider__title"><?php echo esc_html( $heading ); ?></h2>
            </div>
        <?php endif; ?>

        <!-- Swiper container -->
        <div class="products-slider__wrapper js-swiper-products swiper">
            <div class="swiper-wrapper">
                <?php foreach ( $related_products as $related_product ) : ?>
                    <?php
                    $post_object = get_post( $related_product->get_id() );

                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    ?>
                    <!-- Each product as a swiper-slide -->
                    <div class="product-item swiper-slide">
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="product-slider__nav-container">
            <!-- Strelice za navigaciju -->
            <div class="product-slider__nav product-slider__nav-prev font-chevron-left swiper-button-prev-products"></div>
            <div class="product-slider__nav product-slider__nav-next font-chevron-right swiper-button-next-products"></div>
        </div>
    </div>
<?php
endif;

wp_reset_postdata();