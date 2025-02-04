<?php
/*
    Plugin Name: CRUD App
    Description: A simple CRUD application using AJAX in WordPress.
    Version: 1.0
    Author: Mahbub Hussain
*/


if (!defined('ABSPATH')) {
    exit;
}

// Admin Menu loaded
include_once plugin_dir_path(__FILE__) . '/includes/admin-menu.php';
// DB file loaded
include_once plugin_dir_path(__FILE__) . '/includes/db-setup.php';
// DB all operations file loaded
include_once plugin_dir_path(__FILE__) . '/includes/crud-operations.php';
// ajax Handler
include_once plugin_dir_path(__FILE__) . '/includes/ajax-handlers.php';
//remove table during plugin deactivate
include_once plugin_dir_path(__FILE__) . '/includes/deactivate.php';

include_once plugin_dir_path(__FILE__) . '/includes/shortcodes/user-auth.php';
include_once plugin_dir_path(__FILE__) . '/includes/users/auth.php';
