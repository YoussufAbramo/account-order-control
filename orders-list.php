<?php
/*
 Template Name: Orders List
 Theme Name:   Abramo
 Theme URI:    http://abramo.xyz/
 Description:  Abramo Child Theme
 Author:       Abramo
 Author URI:   http://Abramo.xyz
 Template:     Abramo
 Version:      1.0
 Text Domain:  abramo-child
*/
get_header();

// Check if the current user has one of the specified roles
if (current_user_can('shop_manager') || current_user_can('editor') || current_user_can('administrator')) {

  // Query WooCommerce orders
  echo '<div class="orders-container">';
  $orders = wc_get_orders(array(
    'status' => array('processing'), // Adjust status as needed
    'limit'  => -1, // Retrieve all orders
  ));

  // Check if there are orders
  if ($orders) {
    // Loop through each order and display relevant information
    foreach ($orders as $order) {
      // Get order details
      $order_number = $order->get_order_number();
      $order_status = wc_get_order_status_name($order->get_status());
      $order_total = wc_price($order->get_total());

      // Output order details
      echo '<div class="order-item">';
      echo '<div class="order-details">';
      echo '<p>Order Number: ' . esc_html($order_number) . '</p>';
      echo '<p>Order Status: ' . esc_html($order_status) . '</p>';
      echo '<p>Order Total: ' . wc_price($order->get_total()) . '</p>';

      // Add "View Details" button/link
      echo '<a href="' . esc_url(get_permalink(get_page_by_title('Order Details'))) . '?order_id=' . esc_attr($order->get_id()) . '" class="view-details-btn">View Details</a>';
      echo '</div>';
      echo '</div>';


      echo '<hr>'; // Add a horizontal line for better separation
    }
  } else {
    // Display a message if there are no orders
    echo '<p>No orders found.</p>';
  }
} else {
  // Display a message if the user doesn't have the required role
  echo '<p>Access Denied. You do not have permission to view this page.</p>';
}

echo '</div>';
// Get footer
get_footer();
