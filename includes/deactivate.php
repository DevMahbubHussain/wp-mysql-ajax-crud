<?php

// Function to remove table on plugin deactivation
function crud_app_remove_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'crud_app';

    // SQL to drop the table
    $sql = "DROP TABLE IF EXISTS $table_name";

    // Execute the SQL query
    $wpdb->query($sql);
}

// Register deactivation hook
register_deactivation_hook(__FILE__, 'crud_app_remove_table');
