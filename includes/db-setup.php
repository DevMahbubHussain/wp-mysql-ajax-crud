<?php

global $wpdb;

$table_name = $wpdb->prefix . 'crud_app';
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) $charset_collate;";

require_once ABSPATH . 'wp-admin/includes/upgrade.php';
dbDelta($sql);

// Check for errors
if ($wpdb->last_error) {
    error_log("DB Error: " . $wpdb->last_error);
}

// // Return a success status
// return true;
