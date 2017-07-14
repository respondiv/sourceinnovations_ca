<?php

/**
 * Add a notice on checkout page.
 *
 * Reference: http://www.skyverge.com/blog/edit-woocommerce-templates/
 */
add_action( 'woocommerce_before_checkout_form', 'source_add_checkout_content', 9 );
function source_add_checkout_content() {
    echo '<p style="color:red;">If you are purchasing multiple items and the freight cost seems high, please call us at <a href="tel:14034445457">403-444-5457</a> to provide alternate freight options. </p>';
}