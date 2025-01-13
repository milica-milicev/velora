<?php
// Fetch the 'banner_box' field data
$banner_box = get_field('banner_box');

// Check if 'banner_box' field exists and contains data
if ($banner_box) :
    // Get the product URL if a product is selected
    $category_page = $banner_box['category']; ?>

    <div class="banner-box">
        <div class="container">
            <!-- Use the product URL as the link for the banner -->
            <a href="<?php echo esc_url( get_term_link( $category_page ) ); ?>" class="banner-box__wrap">
                <!-- Use ACF background image if set, otherwise use the default image -->
                <img class="banner-box__img" src="<?php echo esc_url($banner_box['background_image']['url']); ?>" alt="<?php echo esc_attr($banner_box['background_image']['alt']); ?>">
                
                <div class="banner-box__content">
                    <!-- Use the ACF title field -->
                    <h2 class="banner-box__title"><?php echo esc_html($banner_box['title']); ?></h2>
                    
                    <!-- Use the ACF text field -->
                    <p class="banner-box__text"><?php echo esc_html($banner_box['text']); ?></p>
                    
                    <!-- Button will be shown under the product link, or if no product, it defaults -->
                    <span class="btn btn--white">Saznajte više</span>
                </div>
            </a>
        </div>
    </div>
<?php endif; ?>