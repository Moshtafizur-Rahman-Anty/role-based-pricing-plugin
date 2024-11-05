<?php

if (!defined('ABSPATH')) exit;

class Role_Based_Pricing_Settings
{
    public function __construct()
    {
        add_action('woocommerce_settings_tabs_array', [$this, 'add_settings_tab'], 50);
        add_action('woocommerce_settings_role_based_pricing', [$this, 'settings_tab_content']);
        add_action('woocommerce_update_options_role_based_pricing', [$this, 'update_settings']);
    }

    public function add_settings_tab($settings_tabs)
    {
        $settings_tabs['role_based_pricing'] = __('Role Based Pricing', 'rbp');
        return $settings_tabs;
    }

    public function settings_tab_content()
    {
        woocommerce_admin_fields($this->get_settings());
    }

    public function update_settings()
    {
        woocommerce_update_options($this->get_settings());
    }

    private function get_settings()
    {
        return array(
            array(
                'name' => __('Role Based Pricing Settings', 'rbp'),
                'type' => 'title',
                'id'   => 'role_based_pricing_options',
            ),
            array(
                'name'    => __('Enable Role Based Pricing', 'rbp'),
                'id'      => 'rbp_enable',
                'type'    => 'checkbox',
                'default' => 'no',
            ),
            array(
                'type' => 'sectionend',
                'id'   => 'role_based_pricing_options',
            ),
        );
    }
}

new Role_Based_Pricing_Settings();
