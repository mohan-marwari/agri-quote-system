<?php
// Handle quote form submission
add_action('wp_ajax_process_quote_request', 'handle_quote_request');
add_action('wp_ajax_nopriv_process_quote_request', 'handle_quote_request');

function handle_quote_request() {
    // Verify nonce
    if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'quote_request_action')) {
        wp_send_json_error('Security check failed', 403);
        wp_die();
    }

    // Sanitize data
    $product_name = sanitize_text_field($_POST['product_name']);
    $quantity = sanitize_text_field($_POST['quantity']);
    $unit = sanitize_text_field($_POST['unit']);
    $mobile = sanitize_text_field($_POST['mobile']); // Now includes country code
    $email = sanitize_email($_POST['email']);

    // Validate required fields
    if (empty($product_name) || empty($mobile) || empty($email)) {
        wp_send_json_error('Required fields are missing', 400);
        wp_die();
    }

    // Additional phone number validation
    if (!preg_match('/^\+[0-9]{1,3}[0-9]{4,14}$/', $mobile)) {
        wp_send_json_error('Please enter a valid phone number with country code', 400);
        wp_die();
    }

    // Send email
    $to = get_option('admin_email');
    $subject = "New Quote Request: " . $product_name;
    $message = "Product: $product_name\n";
    $message .= "Quantity: $quantity $unit\n";
    $message .= "Phone: $mobile\n"; // Now includes country code
    $message .= "Email: $email";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    $email_sent = wp_mail($to, $subject, $message, $headers);

    if ($email_sent) {
        wp_send_json_success(array(
            'message' => 'Thank you for your quote request! We will contact you soon.'
        ));
    } else {
        wp_send_json_error('Failed to send email', 500);
    }
    
    wp_die();
}