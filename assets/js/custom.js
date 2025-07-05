jQuery(document).ready(function($) {
    // Open modal when any quote button is clicked
    $(document).on('click', '.custom-quote-btn', function() {
        // Get product details
        var productId = $(this).data('product-id');
        var productName = $(this).data('product-name');
        
        // Set product info in form
        $('#customQuoteProductId').val(productId);
        $('#customQuoteProductName').val(productName);

        // Show modal
        $('body').addClass('modal-open');
        $('#customQuoteModal').css({
            'display': 'flex',
            'position': 'fixed'
        });
    });
    
    // Close modal handler
    $(document).on('click', '.modal-close-btn, .quote-modal-overlay', function() {
        $('body').removeClass('modal-open');
        $('#customQuoteModal').hide();
    });
    
    // Close when clicking outside
    $(window).click(function(e) {
        if (e.target.id === 'customQuoteModal') {
            $('#customQuoteModal').hide();
        }
    });
    
       // Prevent modal content from closing when clicking inside
    $('.quote-modal-content').click(function(e) {
        e.stopPropagation();
    });

   // AJAX form submission
    $('#customQuoteForm').submit(function(e) {
        e.preventDefault();

        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var countryCode = $('#countryCode').val();
        var mobileNumber = $('input[name="mobile"]').val();
        var fullPhoneNumber = countryCode + mobileNumber;
        
        $submitBtn.text('Sending...').prop('disabled', true);
        
        $.ajax({
            url: blocksy_child_vars.ajax_url,
            type: 'POST',
            data: {
                action: 'process_quote_request',
                product_name: $('#customQuoteProductName').val(),
                quantity: $('input[name="quantity"]').val(),
                unit: $('select[name="unit"]').val(),
                mobile: fullPhoneNumber, // Now includes country code
                email: $('input[name="email"]').val(),
                security: $('#quote_nonce').val()
            },
            success: function(response) {
                if(response.success) {
                    alert(response.data.message);
                    $('#customQuoteModal').hide();
                    window.location.href = window.location.href + '?quote=success';
                } else {
                    alert('Error: ' + response.data);
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            },
            complete: function() {
                $submitBtn.text('Send Enquiry').prop('disabled', false);
            }
        });
    });
});