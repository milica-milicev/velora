<div class="categories">
    <div class="container">
        <div class="categories__header">
            <h2 class="section-title categories__title">Kategorije</h2>
        </div>
        <div class="categories__row">
            <?php
            // Get the top-level WooCommerce product categories
            $args = array(
                'taxonomy'   => 'product_cat',   // WooCommerce product category taxonomy
                'hide_empty' => true,            // Hide categories with no products
                'parent'     => 0,               // Only top-level categories (no subcategories)
            );
            $categories = get_terms($args);

            // Loop through the categories and display each one
            if (!empty($categories) && !is_wp_error($categories)) :
                foreach ($categories as $category) :
                    // Get the category URL
                    $category_url = get_term_link($category);

                    // Get the category image (you may want to set a default image)
                    $category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $category_image_url = wp_get_attachment_url($category_image_id) ?: get_stylesheet_directory_uri() . '/assets/images/cat-placeholder-image.jpg';

                    // Get the value of the ACF "active_category" field for this category
                    $is_active = get_field('active_category', 'product_cat_' . $category->term_id);

                    // Add the "soon" class if the field is not checked
                    $class = $is_active ? 'categories__item' : 'categories__item categories__item--soon';
                    ?>
                    <div class="<?php echo esc_attr($class); ?>">
                        <a href="<?php echo esc_url($category_url); ?>">
                            <img src="<?php echo esc_url($category_image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                            <span><?php echo esc_html($category->name); ?></span>
                        </a>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>