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
            <?php
            // Dodavanje podnaslova
            $current_category = get_queried_object(); // Dohvatanje trenutne kategorije
            if ( $current_category && isset( $current_category->term_id ) ) {
                $subtitle = get_field( 'subcategory_subtitle', 'product_cat_' . $current_category->term_id ); // Dohvatanje vrednosti ACF polja
                if ( $subtitle ) {
                    echo '<p class="banner__subtitle">' . esc_html( $subtitle ) . '</p>'; // Prikaz podnaslova
                }
            }
            ?>
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

if ( woocommerce_product_loop() ) : ?>
    <div class="products-list">
        <div class="container">
            <div class="products-list__container">
                <div class="products-list__aside">
                    <?php
                    $current_category = get_queried_object();

                    if ($current_category instanceof WP_Term) :
                        if ($current_category->parent !== 0) :
                            $parent_category = get_term($current_category->parent, 'product_cat');
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

                        if ($current_category->parent === 0) :
                            $product_categories = get_terms('product_cat', array(
                                'order'      => 'ASC',
                                'hide_empty' => false,
                                'parent'     => 0,
                                'exclude'    => array(16)
                            ));

                            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                                ?>
                                <div class="filter">
                                    <ul>
                                        <?php foreach ($product_categories as $category) : ?>
                                            <?php 
                                            $class = ($current_category->term_id === $category->term_id) ? 'filter__item-active' : ''; 
                                            $is_active = get_field('active_category', 'product_cat_' . $category->term_id);
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
                    if ( is_product_category() ) :
                        $term = get_queried_object();
                        $args = array(
                            'parent'       => $term->term_id,
                            'taxonomy'     => 'product_cat',
                            'hide_empty'   => false,
                        );

                        $subcategories = get_terms( $args );

                        if ( ! empty( $subcategories ) && ! is_wp_error( $subcategories ) ) : ?>

                            <div class="categories categories--listing">
                                <div class="categories__row">
                                    <?php foreach ( $subcategories as $subcategory ) : ?>
                                        <?php
                                        $category_image_id = get_term_meta( $subcategory->term_id, 'thumbnail_id', true );
                                        $category_image_url = wp_get_attachment_url( $category_image_id ) ?: get_stylesheet_directory_uri() . '/assets/images/cat-placeholder-image.jpg';
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
                        <?php
                        // Provera da li ima više od 16 proizvoda za prikazivanje paginacije
                        if ( wc_get_loop_prop( 'total' ) > 16 ) :
                        ?>
                            <div class="products-pagination">
                                <?php woocommerce_pagination(); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <?php
                    // Dodavanje WYSIWYG sadržaja ispod proizvoda
                    $current_category = get_queried_object();
                    if ( $current_category && isset( $current_category->term_id ) ) {
                        $subcategory_content = get_field( 'subcategory_content', 'product_cat_' . $current_category->term_id );
                        if ( $subcategory_content ) {
                            echo '<div class="entry-content">';
                            echo wp_kses_post( $subcategory_content );
                            echo '</div>';
                        }
                    }
                    ?>
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
