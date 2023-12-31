/*
 Template Name: Abramo main JavaScript
 Theme Name:   Abramo
 Theme URI:    http://abramo.xyz/
 Description:  Abramo Child Theme
 Author:       Abramo
 Author URI:   http://Abramo.xyz
 Template:     Abramo
 Version:      1.0
 Text Domain:  abramo-child
*/

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('mark-as-complete-btn').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.onload = function() {
      if (xhr.status >= 200 && xhr.status < 400) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          document.getElementById('mark-as-complete-container').innerHTML = '<p>Order marked as completed by: ' + response.username + '</p>';
        } else {
          console.error(response.message);
        }
      } else {
        console.error('Request failed');
      }
    };
    xhr.onerror = function() {
      console.error('Request failed');
    };
    xhr.send('action=mark_order_complete&order_id=<?php echo $order_id; ?>');
  });
});
