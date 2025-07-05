<?php
// Hide Woocommerce Prices
add_filter('woocommerce_get_price_html', function($price) {
    return '';
});

// Remove default WooCommerce buttons
function remove_default_woocommerce_buttons() {
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    add_filter('woocommerce_is_purchasable', '__return_false');
}
add_action('init', 'remove_default_woocommerce_buttons');

// Add Custom Quote Button
function add_custom_quote_button() {
    global $product;
    $product_name = $product->get_name();
    $product_id = $product->get_id();
    
    echo '<button class="custom-quote-btn" 
            data-product-id="'.esc_attr($product_id).'"
            data-product-name="'.esc_attr($product_name).'">
            Get a Quick Quote
          </button>';
    
    // Include modal template
    include get_stylesheet_directory() . '/assets/templates/quote-modal.php';
}

// Add button to shop/archive pages
add_action('woocommerce_after_shop_loop_item', 'add_custom_quote_button', 20);

// Add button to single product page
add_action('woocommerce_single_product_summary', 'add_custom_quote_button', 30);

// Hide Quantity Selector
add_filter('woocommerce_is_sold_individually', function($return, $product) {
    return true;
}, 10, 2);