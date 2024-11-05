<?php

if (!defined('ABSPATH')) exit;

class Role_Based_Pricing_Meta_Box
{
    public function __construct()
    {
        add_action('woocommerce_product_options_pricing', [$this, 'add_custom_price_fields']);
        add_action('woocommerce_process_product_meta', [$this, 'save_custom_price_fields']);
    }

    public function add_custom_price_fields()
    {
        global $post;
        $roles = wp_roles()->roles;

        echo '<div class="options_group">';
        foreach ($roles as $role => $details) {
            echo '<p class="form-field">';
            echo '<label for="rbp_price_' . esc_attr($role) . '">' . esc_html($details['name']) . ' Price</label>';
            echo '<input type="number" step="0.01" id="rbp_price_' . esc_attr($role) . '" name="rbp_price_' . esc_attr($role) . '" value="' . esc_attr(get_post_meta($post->ID, '_rbp_price_' . $role, true)) . '" />';
            echo '</p>';
        }
        echo '</div>';
    }

    public function save_custom_price_fields($post_id)
    {
        $roles = wp_roles()->roles;
        foreach ($roles as $role => $details) {
            if (isset($_POST['rbp_price_' . $role])) {
                update_post_meta($post_id, '_rbp_price_' . $role, sanitize_text_field($_POST['rbp_price_' . $role]));
            }
        }
    }
}

new Role_Based_Pricing_Meta_Box();
