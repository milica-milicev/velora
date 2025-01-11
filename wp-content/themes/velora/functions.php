<?php
/**
 * NM Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NM_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nm_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on NM Theme, use a find and replace
		* to change 'nm_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nm_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nm_theme' ),
			'menu-2' => esc_html__( 'Secondary', 'nm_theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nm_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nm_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nm_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nm_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'nm_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nm_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nm_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nm_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nm_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nm_theme_scripts() {
	wp_enqueue_style( 'nm_theme-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'nm_theme-script', get_template_directory_uri() . '/dist/site.min.js', _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nm_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

/**
 * Add woocommerce support in the theme
 */
function nm_theme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'nm_theme_add_woocommerce_support' );

/**
 * Woocommerce disable css
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );



add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

function custom_related_products_args( $args ) {
    $args['posts_per_page'] = 6; // Broj proizvoda koji želite da prikažete
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'custom_related_products_args' );

function custom_reorder_single_product_hooks() {
    // Ukloni postojeće hooks
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

    // Dodaj hooks u novom redosledu
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 ); // Prebacujemo add_to_cart na mesto excerpta
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 ); // Prebacujemo excerpt na mesto add_to_cart
}
add_action( 'woocommerce_init', 'custom_reorder_single_product_hooks' );

function enqueue_qty_counter_script() {
    wp_enqueue_script(
        'qty-counter-script',
        get_template_directory_uri() . '/assets/js/_site/qty-counter.js',
        array('jquery'),
        _S_VERSION,
        true
    );

	// Dodaj atribut type="module" za skriptu
    add_filter('script_loader_tag', function ($tag, $handle, $src) {
        if ('qty-counter-script' === $handle) {
            $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }, 10, 3);

    wp_localize_script('qty-counter-script', 'custom_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_qty_counter_script');



function custom_update_cart() {
    if (isset($_POST['form_data'])) {
        parse_str($_POST['form_data'], $form_data);

        foreach ($form_data['cart'] as $cart_key => $cart_value) {
            WC()->cart->set_quantity($cart_key, $cart_value['qty'], true);
        }
        WC()->cart->calculate_totals();

        // Prikupljanje celokupnog HTML sadržaja tabele korpe
        ob_start();
        wc_get_template('cart/cart.php');
        $cart_html = ob_get_clean();

        // Prikupljanje HTML sadržaja za ukupan iznos (totals)
        ob_start();
        woocommerce_cart_totals();
        $cart_totals_html = ob_get_clean();

        wp_send_json_success(array(
            'cart_html' => $cart_html,        // HTML za tabelu korpe
            'cart_totals' => $cart_totals_html, // HTML za ukupne cene
            'cart_count' => WC()->cart->get_cart_contents_count(), // Ukupan broj proizvoda
        ));
    } else {
        wp_send_json_error('Podaci nisu validni');
    }
}

add_action('wp_ajax_update_cart', 'custom_update_cart');
add_action('wp_ajax_nopriv_update_cart', 'custom_update_cart');


/**
 * Woocommerce remove unnecessary fields from the checkout form
 */
add_filter( 'woocommerce_checkout_fields', 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    // Uklanjanje nepotrebnih polja
    unset( $fields['billing']['billing_last_name'] ); // Uklanjanje polja za prezime
    unset( $fields['billing']['billing_state'] ); // Uklanjanje polja za državu
    unset( $fields['billing']['billing_address_2'] ); // Uklanjanje polja za dodatnu adresu
    unset( $fields['billing']['billing_company'] ); // Uklanjanje polja za naziv kompanije
    unset( $fields['shipping']['shipping_state'] ); // Uklanjanje polja za dostavu (ako je potrebno)

    // Promena oznake za polje imena
    $fields['billing']['billing_first_name']['label'] = 'Ime i Prezime';

    // Uklanjanje placeholdera za polje adrese
    $fields['billing']['billing_address_1']['placeholder'] = '';

    return $fields;
}

// Hide shipping when free delivery is available
add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );

function hide_shipping_when_free_is_available( $rates, $package ) {
    // Proverite da li besplatna dostava postoji
    $free_shipping = false;

    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free_shipping = true;
            break;
        }
    }

    if ( $free_shipping ) {
        foreach ( $rates as $rate_id => $rate ) {
            if ( 'flat_rate' === $rate->method_id ) {
                unset( $rates[$rate_id] );
            }
        }
    }

    return $rates;
}

add_action('wp_footer', 'add_custom_mini_cart');
function add_custom_mini_cart() {
    ?>
    <div id="mini-cart" style="display:none;">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
}


/* Dynamic Button for Simple & Variable Product */

/**
 * Add "Buy Now" button next to "Add to Cart" on product pages
 */
function sbw_wc_add_buy_now_button_single() {
    global $product;

    // Prikaz dugmeta "Kupi odmah" bez dodatnog inputa
    printf(
        '<button id="sbw-wc-adding-button" type="submit" name="sbw-wc-buy-now" value="%d" class="buy_now_button single-buy-now-button button alt">%s</button>',
        $product->get_id(),
        esc_html__( 'Kupi odmah', 'woocommerce' )
    );
}
add_action( 'woocommerce_after_add_to_cart_button', 'sbw_wc_add_buy_now_button_single' );



/**
 * Handle "Buy Now" button functionality
 */
function sbw_wc_handle_buy_now() {
    if ( ! isset( $_REQUEST['sbw-wc-buy-now'] ) ) {
        return;
    }

    // Očisti korpu pre dodavanja proizvoda
    WC()->cart->empty_cart();

    $product_id = absint( $_REQUEST['sbw-wc-buy-now'] );
    $quantity   = isset( $_REQUEST['quantity'] ) ? absint( $_REQUEST['quantity'] ) : 1;

    if ( isset( $_REQUEST['variation_id'] ) && $_REQUEST['variation_id'] > 0 ) {
        $variation_id = absint( $_REQUEST['variation_id'] );
        WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
    } else {
        WC()->cart->add_to_cart( $product_id, $quantity );
    }

    wp_safe_redirect( wc_get_checkout_url() );
    exit;
}

add_action( 'wp_loaded', 'sbw_wc_handle_buy_now' );


function add_vat_text_below_price() {
    echo '<p class="vat-info">Sa PDV-om</p>';
}
add_action( 'woocommerce_single_product_summary', 'add_vat_text_below_price', 11 );

// Dodavanje klasa za stilizaciju
add_filter( 'woocommerce_get_availability', 'custom_get_availability_classes', 10, 2 );
function custom_get_availability_classes( $availability, $product ) {
    if ( isset( $availability['availability'] ) ) {
        // Dodavanje klase "low-stock" ako tekst sadrži "1 na zalihama" ili "2 na zalihama"
        if ( strpos( $availability['availability'], '1 na zalihama' ) !== false || strpos( $availability['availability'], '2 na zalihama' ) !== false ) {
            $availability['class'] = 'low-stock';
        } elseif ( strpos( $availability['availability'], 'Na zalihama' ) !== false ) {
            $availability['class'] = 'in-stock';
        }
    }
    return $availability;
}

// Promena teksta dostupnosti
add_filter( 'woocommerce_get_availability_text', 'custom_availability_text', 10, 2 );
function custom_availability_text( $availability, $product ) {
    // Menjamo tekst "Samo X je preostalo na zalihama" u "X na zalihama"
    if ( strpos( $availability, 'Samo' ) !== false ) {
        $availability = str_replace( 'Samo ', '', $availability );
        $availability = str_replace( ' je preostalo na zalihama', ' na zalihama', $availability );
    }
    return $availability;
}


//Promena mesta paginacije, da bude odmah ispod proizvoda, a ne posle teksta.

add_action( 'template_redirect', function() {
    if ( is_shop() || is_product_category() || is_product_taxonomy() ) {
        remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
    }
} );


//Funkcija za azuriranje mini korpe
add_action('wp_ajax_update_header_cart', 'update_header_cart');
add_action('wp_ajax_nopriv_update_header_cart', 'update_header_cart');

function update_header_cart() {
    $cart_count = WC()->cart->get_cart_contents_count(); // Dohvati broj proizvoda u korpi

    wp_send_json_success(array(
        'cart_count' => $cart_count, // Vraća broj proizvoda
    ));
}

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Start element
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $attributes = '';
        !empty($item->attr_title) and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target) and $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn) and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url) and $attributes .= ' href="' . esc_attr($item->url) . '"';

        // Dodaj klasu na <a> ako stavka menija ima submenu
        $link_classes = '';
        if (in_array('menu-item-has-children', $classes)) {
            $link_classes = ' class="has-submenu"';
        }

        $link_output = $args->before;
        $link_output .= '<a' . $attributes . $link_classes . '>';
        $link_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $link_output .= '</a>';

        // Dodaj span samo ako stavka ima submenu
        if (in_array('menu-item-has-children', $classes)) {
            $link_output .= ' <span class="submenu-icon font-chevron-down"></span>';
        }
        $link_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $link_output, $item, $depth, $args);
    }
}

/**
 * Force WooCommerce terms and conditions link to open in a new page when clicked on the checkout page
 *
 * @author   Golden Oak Web Design <info@goldenoakwebdesign.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GPLv2+
 */
function remove_woocommerce_checkout_terms_and_conditions_acc() {
    remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
}
add_action( 'wp', 'remove_woocommerce_checkout_terms_and_conditions_acc' );