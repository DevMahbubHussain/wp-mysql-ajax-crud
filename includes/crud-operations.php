<?php

function crud_app_add_record()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'crud_app';

    // sanitize data 
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_text_field($_POST['email']);

    // insert sanitize data 
    $insert_data = $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
        ),
    );

    wp_send_json_success($insert_data, 200);
}

// get all records 
function crud_app_get_records()
{

    global $wpdb;
    $table_name = $wpdb->prefix . 'crud_app';

    $results = $wpdb->get_results("SELECT * FROM $table_name");
    wp_send_json_success($results);
}

// delete single data

function crud_app_delete_record()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'crud_app';

    $id = intval($_POST['id']);

    $wpdb->delete(
        $table_name,
        array('id' => $id)
    );

    wp_send_json_success('Record deleted successfully!');
}
