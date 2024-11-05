<?php

if (!defined('ABSPATH')) exit;

class Role_Based_Pricing_Pricing
{
    public function __construct()
    {
        add_filter('woocommerce_get_price', [$this, 'get_role_based_price'], 10, 2);
        add_filter('woocommerce_get_regular_price', [$this, 'get_role_based_price'], 10, 2);
        add_filter('woocommerce_get_price_html', [$this, 'display_role_based_price_html'], 10, 2);
    }

    public function get_role_based_price($price, $product)
    {
        if ('yes' === get_option('rbp_enable')) {
            $user = wp_get_current_user();
            foreach ($user->roles as $role) {
                $custom_price = get_post_meta($product->get_id(), '_rbp_price_' . $role, true);
                if ($custom_price && $custom_price > 0) {
                    return $custom_price;
                }
            }
        }
        return $price;
    }

    public function display_role_based_price_html($price_html, $product)
    {
        if ('yes' === get_option('rbp_enable')) {
            $custom_price = $this->get_role_based_price($product->get_price(), $product);
            if ($custom_price) {
                return wc_price($custom_price);
            }
        }
        return $price_html;
    }
}

new Role_Based_Pricing_Pricing();
