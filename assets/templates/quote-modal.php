<div id="customQuoteModal">
    <div class="quote-modal-content">
        <span class="modal-close-btn">&times;</span>
        <h3>Get a Quick Quote</h3>
        <form id="customQuoteForm" method="post">
            <?php wp_nonce_field('quote_request_action', 'quote_nonce'); ?>
            <input type="hidden" id="customQuoteProductId" name="product_id">
            <input type="hidden" id="customQuoteProductName" name="product_name">
            
            <div class="quote-form-group">
                <label for="quoteQuantity">Quantity</label>
                <input type="text" name="quantity" id="quoteQuantity" class="quote-form-control" required>
            </div>
            
            <div class="quote-form-group">
                <label for="quoteUnit">Measurement Unit</label>
                <select name="unit" id="quoteUnit" class="quote-form-control">
                    <option value="Ton">Ton</option>
                    <option value="Kg">Kg</option>
                </select>
            </div>
            
            <div class="quote-form-group">
                <label for="quoteMobile">Mobile No.*</label>
                <input type="text" name="mobile" id="quoteMobile" class="quote-form-control" required>
            </div>
            
            <div class="quote-form-group">
                <label for="quoteEmail">Email Address*</label>
                <input type="email" name="email" id="quoteEmail" class="quote-form-control" required>
            </div>
            
            <button type="submit" class="submit-quote-btn">Send Enquiry</button>
        </form>
    </div>
</div>