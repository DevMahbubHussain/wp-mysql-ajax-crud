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

// Update single data 
function crud_app_update_record()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "crud_app";

    $id = intval($_POST['id']);
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);

    $wpdb->update(
        $table_name,
        array(
            'name' => $name,
            'email' => $email
        ),
        array('id' => $id)
    );
    wp_send_json_success('Record updated successfully!');
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


function user_profile_update()
{
    if (!isset($_POST['display_name']) || !isset($_POST['user_email'])) {
        wp_send_json_error(['message' => 'Missing required fields']);
        return;
    }

    $name = sanitize_text_field($_POST['display_name']);
    $email = sanitize_email($_POST['user_email']);

    $userData = [
        "ID" => get_current_user_id(),
        "display_name" => $name,
        "user_email" => $email,
    ];

    $user_id = wp_update_user($userData);
    error_log(print_r($_POST, true));
    error_log($user_id);

    error_log($user_id);
    if (is_wp_error($user_id)) {
        return wp_send_json_error([
            'message' => $user_id->get_error_message(),
        ]);
    }

    wp_send_json_success([
        'message' => 'Profile Update SuccessFully'
    ]);
}



function auth_user_login()
{
    if (!isset($_POST['user_login']) || !isset($_POST['user_pass'])) {
        wp_send_json_error(['message' => 'Missing required fields']);
        return;
    }


    $credentials = [
        'user_login'    => sanitize_text_field($_POST['user_login']),
        'user_password' => sanitize_text_field($_POST['user_pass']),
        'remember'      => true
    ];


    $user = wp_signon($credentials, false);

    if (is_wp_error($user)) {
        return wp_send_json_error([
            'message' => $user->get_error_message(),
        ]);
    }

    wp_send_json_success([
        'message' => 'Login successful',
        'redirect_url' => home_url('/') // Change this to the intended redirect page
    ]);
}
