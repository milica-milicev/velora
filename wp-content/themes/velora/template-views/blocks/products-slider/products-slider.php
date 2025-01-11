<div class="products-slider">
    <div class="products-slider__head">
        <h2 class="section-title products-slider__title">Najpopularnije</h2>
    </div>
    
    <div class="products-slider__wrapper js-swiper-products swiper">
        <div class="swiper-wrapper">
            <?php
            // Povlačimo niz proizvoda iz ACF-a
            $products = get_field('products');

            // Proveravamo da li postoji niz popularnih proizvoda
            if ($products) :
                // Petlja kroz svaki proizvod (product_1, product_2, itd.)
                for ($i = 1; $i <= 5; $i++) :
                    // Dinamički generišemo ime polja za proizvod i hover sliku
                    $product_field_name = 'product_' . $i;
                    $hover_image_field_name = 'hover_image_product_' . $i;
                    
                    // Dobijamo post object za svaki proizvod
                    $product_post = $products[$product_field_name];
                    
                    // Proveravamo da li post object postoji
                    if ($product_post) :
                        global $product;
                        $product_id = $product_post->ID;
                        $product = wc_get_product($product_id);
                        $product_thumb = get_the_post_thumbnail_url($product_id, 'shop_catalog lazy');
                        $product_title = get_the_title($product_id);
                        $product_link = get_the_permalink($product_id);
                        $product_price = $product->get_price_html();
                        $product_hover = get_field('hover_image',$product_id);
                        $hover_anim = "";

                        if (!$product_hover) :
                            $hover_anim = 'product-item__no-hover-anim';
                        endif;
                        ?>
                        <div class="product-item swiper-slide">
                            <div class="product-item__wrap">
                                <a href="<?php echo $product_link; ?>" class="product-item__img-wrapper <?php echo $hover_anim; ?>">
                                    <!-- Hover slika proizvoda -->
                                    <?php if ($product_hover && isset($product_hover['url'])): ?>
                                        <img class="product-item__hover-img" src="<?php echo $product_hover['url']; ?>" alt="<?php echo $product_hover['alt']; ?>">
                                    <?php endif; ?>

                                    <!-- Glavna slika proizvoda -->
                                    <img src="<?php echo $product_thumb; ?>" alt="">

                                    <?php if ($product->is_on_sale()) : ?>
                                        <span class="onsale">Akcija</span>
                                    <?php endif; ?>
                                </a>
                                    
                                <!-- <div class="product-item__actions">
                                    <?php // woocommerce_template_loop_add_to_cart(); ?>
                                </div> -->
                            </div>
                            
                            <div class="product-item__info">
                                <a href="<?php echo $product_link; ?>"><h2 class="product-slider__item-title"><?php echo $product_title; ?></h2></a>
                                <span class="product-item__price"><?php echo $product_price; ?></span>
                            </div>
                        </div>
                        <?php
                    endif;
                endfor;
            endif;
            ?>
        </div>
        
    </div>
    <div class="product-slider__nav-container">
        <!-- Strelice za navigaciju -->
        <div class="product-slider__nav product-slider__nav-prev font-chevron-left swiper-button-prev-products"></div>
        <div class="product-slider__nav product-slider__nav-next font-chevron-right swiper-button-next-products"></div>
    </div>
    <?php $cat_page = get_field('category_page'); ?>
    <?php if ($cat_page) : ?>
        <div class="product-slider__cta">
            <a href="<?php echo esc_url( get_term_link( $cat_page ) ); ?>" class="btn">Pogledaj sve proizvode</a>
        </div>
    <?php endif; ?>
</div>
