<?php
/*
Template Name: Order Details
*/
get_header();

// Check if the order_id parameter is set in the URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Output detailed order information
if ($order_id) {
  $order = wc_get_order($order_id);

  if ($order) {
    // Output detailed order information as needed
    echo '<div class="order-details-container">';
    echo '<div class="order-details-header">';
    echo '<h2>Order Details</h2>';
    echo '</div>';
    
    echo '<p>Order Number: ' . esc_html($order->get_order_number()) . '</p>';
    echo '<p>Order Status: ' . esc_html(wc_get_order_status_name($order->get_status())) . '</p>';
    echo '<p>Order Total: ' . wc_price($order->get_total()) . '</p>';

    
    // Output billing information
    echo '<h3>Billing Information</h3>';
    $billing_data = $order->get_address('billing');
    echo '<p>Name: ' . esc_html($billing_data['first_name'] . ' ' . $billing_data['last_name']) . '</p>';
    echo '<p>Email: ' . esc_html($order->get_billing_email()) . '</p>';
    echo '<p>Phone: ' . esc_html($order->get_billing_phone()) . '</p>';
    // Add more billing details as needed

    // Output payment information
    echo '<h3>Payment Information</h3>';
    echo '<p>Payment Method: ' . esc_html($order->get_payment_method()) . '</p>';
    // Add more payment details as needed

    // Output ordered items
    echo '<h3>Ordered Items</h3>';
    foreach ($order->get_items() as $item_id => $item) {
      $product = $item->get_product();
      echo '<p>Product Title: ' . esc_html($product->get_title()) . '</p>';
      echo '<p>Quantity: ' . esc_html($item->get_quantity()) . '</p>';
      echo '<p>Price per Unit: ' . wc_price($item->get_total() / $item->get_quantity()) . '</p>';
      echo '<p>Product Details: ' . esc_html($product->get_description()) . '</p>';
      // Add more item details as needed
    }

    // Output shipping information
    echo '<h3>Shipping Information</h3>';
    $shipping_data = $order->get_address('shipping');
    echo '<p>Shipping Name: ' . esc_html($shipping_data['first_name'] . ' ' . $shipping_data['last_name']) . '</p>';
    echo '<p>Shipping Address: ' . esc_html($shipping_data['address_1'] . ', ' . $shipping_data['address_2']) . '</p>';
    echo '<p>Shipping City: ' . esc_html($shipping_data['city']) . '</p>';
    echo '<p>Shipping Country: ' . esc_html($shipping_data['country']) . '</p>';
    // Add more shipping details as needed
    // Add more sections for additional order details

    // Output order activity
    echo '<h3>Order Activity</h3>';

    // Display the "Mark as Complete" button with AJAX
    echo '<div id="mark-as-complete-container">';
    if (wc_get_order_status_name($order->get_status()) == 'Completed') {
      echo '<p>This order is completed</p>';
      echo '<button class="woocommerce-button button" disabled>Mark as Complete</button>';
    } else {
      echo '<button id="mark-as-complete-btn" class="woocommerce-button button">Mark as Complete</button>';
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';
    // JavaScript to handle the button click event and perform AJAX request
?>

<script src="/main.js"></script>

<?php

  } else {
    echo '<p>Invalid Order ID</p>';
  }
} else {
  echo '<p>Order ID not specified</p>';
}

// Get footer
get_footer();
?>