<div id="customQuoteModal" style="display:none;">
    <div class="quote-modal-overlay"></div>
    <div class="quote-modal-container">
    <div class="quote-modal-content">
        <span class="modal-close-btn">&times;</span>
        <h3>Get a Quick Quote</h3>
        <form id="customQuoteForm" method="post">
            <?php wp_nonce_field('quote_request_action', 'quote_nonce'); ?>
            <input type="hidden" id="customQuoteProductId" name="product_id">
            <input type="hidden" id="customQuoteProductName" name="product_name">
            
            <div class="quote-form-group">
                <label for="quoteQuantity">Quantity</label>
                <input type="text" name="quantity" id="quoteQuantity" class="quote-form-control" 
                       placeholder="e.g. 10" required>
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
                <div class="phone-input-group">
                    <select name="country_code" id="countryCode" class="country-code-select">
                        <option value="+91" data-country="IN" selected>India (+91)</option>
                        <option value="+1" data-country="US">USA (+1)</option>
                        <option value="+44" data-country="GB">UK (+44)</option>
                    </select>
                    <input type="tel" name="mobile" id="quoteMobile" class="quote-form-control phone-number-input" 
                           placeholder="9876543210" required>
                </div>
            </div>
            
            <div class="quote-form-group">
                <label for="quoteEmail">Email Address*</label>
                <input type="email" name="email" id="quoteEmail" class="quote-form-control" 
                       placeholder="your@email.com" required>
            </div>
            
            <button type="submit" class="submit-quote-btn">Send Enquiry</button>
        </form>
    </div>
    </div>
</div>