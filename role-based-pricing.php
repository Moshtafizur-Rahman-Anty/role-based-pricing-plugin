<?php

/**
 * Plugin Name: Role Based Pricing
 * Description: Allows setting different prices for products based on user roles.
 * Version: 1.3
 * Author: Your Name
 */

if (!defined('ABSPATH')) exit;

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/class-role-based-pricing-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-role-based-pricing-meta-box.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-role-based-pricing-pricing.php';
