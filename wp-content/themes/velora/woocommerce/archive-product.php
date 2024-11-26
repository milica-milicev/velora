<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10
 * @hooked woocommerce_breadcrumb - 20
 */
//do_action( 'woocommerce_before_main_content' );
?>

<div class="banner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/_demo/blog-banner.webp');">
    <div class="container">
        <div class="banner__content">
            <?php woocommerce_breadcrumb(); ?>
            <h1 class="banner__title"><?php woocommerce_page_title(); ?></h1>
        </div>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_archive_description.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
do_action( 'woocommerce_archive_description' );


// Continue with the existing product loop and other content
if ( woocommerce_product_loop() ) : ?>
    <div class="products-list">
        <div class="container">
            <div class="products-list__container">
                <div class="products-list__aside">
                    <?php
                    $current_category = get_queried_object();

                    // Check if the current category is a subcategory (has a parent)
                    if ($current_category instanceof WP_Term) :
                        // If the category has a parent, display the parent category link
                        if ($current_category->parent !== 0) :
                            $parent_category = get_term($current_category->parent, 'product_cat'); // Get the parent category
                            if ($parent_category && !is_wp_error($parent_category)) :
                                ?>
                                <div class="filter">
                                    <ul>
                                        <li class="filter__item">
                                            <a href="<?php echo esc_url(get_term_link($parent_category)); ?>" class="filter__item-link filter__item-link--icon">
                                                <span class="icon font-chevron-left"></span>
                                                Vrati se na <?php echo esc_html($parent_category->name); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                            endif;
                        endif;

                        // Check if it's a main category (top-level category)
                        if ($current_category->parent === 0) :
                            // Fetch only top-level categories
                            $product_categories = get_terms('product_cat', array(
                                'order'      => 'ASC',
                                'hide_empty' => false,
                                'parent'     => 0, // Only main categories
                                'exclude'    => array(16) // Exclude Uncategorized category ID
                            ));

                            // Check if there are any product categories
                            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                                ?>
                                <div class="filter">
                                    <!-- <h3 class="filter__title">Kategorije:</h3> -->
                                    <ul>
                                        <?php foreach ($product_categories as $category) : ?>
                                            <?php 
                                            // Add class for the current category
                                            $class = ($current_category->term_id === $category->term_id) ? 'filter__item-active' : ''; 
                                            // Get the value of the ACF "active_category" field for this category
                                            $is_active = get_field('active_category', 'product_cat_' . $category->term_id);

                                            // Add the "soon" class if the field is not checked
                                            $class_active = $is_active ? '' : 'filter__item-soon';
                                            ?>
                                            <li class="filter__item <?php echo esc_attr($class); ?> <?php echo esc_attr($class_active); ?>">
                                                <a href="<?php echo esc_url(get_term_link($category)); ?>" class="filter__item-link">
                                                    <?php echo esc_html($category->name); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php
                            endif;
                        endif;
                    endif;
                    ?>  
                </div>

                <div class="products-list__main">
                    <?php
                    // Display subcategories if on a category archive
                    if ( is_product_category() ) :
                        $term = get_queried_object();
                        $args = array(
                            'parent'       => $term->term_id,
                            'taxonomy'     => 'product_cat',
                            'hide_empty'   => false, // Change to true to hide empty categories
                        );

                        $subcategories = get_terms( $args );

                        if ( ! empty( $subcategories ) && ! is_wp_error( $subcategories ) ) : ?>

                            <div class="categories categories--listing">
                                <div class="categories__row">
                                    <?php foreach ( $subcategories as $subcategory ) : ?>
                                        <?php
                                        // Get the image ID for the category
                                        $category_image_id = get_term_meta( $subcategory->term_id, 'thumbnail_id', true );
                                        // Get the URL of the image
                                        $category_image_url = wp_get_attachment_url( $category_image_id ) ?: get_stylesheet_directory_uri() . '/assets/images/cat-placeholder-image.jpg'; // Default image if none is set
                                        ?>
                                        <div class="categories__item">
                                            <a href="<?php echo esc_url( get_term_link( $subcategory ) ); ?>">
                                                <img src="<?php echo esc_url( $category_image_url ); ?>" alt="<?php echo esc_attr( $subcategory->name ); ?>">
                                                <span><?php echo esc_html( $subcategory->name ); ?></span>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif;
                    endif; ?>
                    <div class="products-list__info">
                        <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                    </div> 
                    <?php if ( wc_get_loop_prop( 'total' ) ) : ?>
                        <div class="products-list__row">
                            <?php while ( have_posts() ) : ?>
                                <div class="products-list__item">
                                    <?php
                                        the_post();
                                        do_action( 'woocommerce_shop_loop' );
                                        wc_get_template_part( 'content', 'product' ); 
                                    ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    do_action( 'woocommerce_after_shop_loop' );
else :
    do_action( 'woocommerce_no_products_found' );
endif;

do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
