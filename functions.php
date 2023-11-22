<?php
// [Recommended] You can delete '<?php' line from this code
// Mark Order As Completed
function mark_order_complete()
{
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;

    if ($order_id) {
        $current_user = wp_get_current_user();
        $username = $current_user->user_login;

        // Update order status to 'completed'
        $order = wc_get_order($order_id);
        $order->update_status('completed');

        // Return a JSON response with the success status and username
        wp_send_json_success(array('username' => $username));
    } else {
        wp_send_json_error(array('message' => 'Invalid Order ID'));
    }
}

add_action('wp_ajax_mark_order_complete', 'mark_order_complete');
add_action('wp_ajax_nopriv_mark_order_complete', 'mark_order_complete');
