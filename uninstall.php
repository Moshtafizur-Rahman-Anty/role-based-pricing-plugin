<?php
// If uninstall not called from WordPress, exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete the plugin settings
delete_option('rbp_enable');

// Delete all role-based pricing post meta data
$products = get_posts(array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'fields'         => 'ids',
));

foreach ($products as $product_id) {
    $roles = wp_roles()->roles;
    foreach ($roles as $role => $details) {
        delete_post_meta($product_id, '_rbp_price_' . $role);
    }
}
