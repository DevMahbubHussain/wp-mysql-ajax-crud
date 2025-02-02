<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

global $wpdb;
$table_name = $wpdb->prefix . 'crud_app';

// Delete table
$wpdb->query("DROP TABLE IF EXISTS $table_name;");

// Optionally, delete plugin settings from wp_options
delete_option('crud_app_settings');
