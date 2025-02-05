<?php

function crud_app_enqueue_scripts()
{
    wp_enqueue_script('crud-app-ajax', plugin_dir_url(__FILE__) . 'assets/js/crud.js', array('jquery'), null, true);

    wp_localize_script('crud-app-ajax', 'CAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('crud_app_nonce'),
    ));
    // Enqueue SweetAlert2 CSS
    wp_enqueue_style(
        'sweetalert2-css',
        'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css',
        array(), // No dependencies
        '11.0.0' // Version number
    );

    // Enqueue SweetAlert2 JS
    wp_enqueue_script(
        'sweetalert2-js',
        'https://cdn.jsdelivr.net/npm/sweetalert2@11',
        array(), // No dependencies
        '11.0.0', // Version number
        true // Load in footer
    );
    wp_enqueue_style('crud-app-style', plugin_dir_url(__FILE__) . 'assets/css/main.css', array(), '1.0.0');
}
add_action('admin_enqueue_scripts', 'crud_app_enqueue_scripts');


function auth_enqueue_scripts()
{
    wp_enqueue_style('auth-style', plugin_dir_url(__FILE__) . 'assets/css/auth.css', array(), '1.0.0');
}

add_action('wp_enqueue_scripts', 'auth_enqueue_scripts');


function crud_app_ajax_add_record()
{
    // check nonce
    check_ajax_referer('crud_app_nonce', 'nonce');
    // than add data into database
    crud_app_add_record();
}


add_action('wp_ajax_crud_app_add_record', 'crud_app_ajax_add_record');


// load data 
function crud_app_ajax_get_records()
{
    // check nonce
    check_ajax_referer('crud_app_nonce', 'nonce');
    // than add load data from database
    crud_app_get_records();
}


add_action('wp_ajax_crud_app_get_records', 'crud_app_ajax_get_records');


// update single data 

function crud_app_ajax_update_record()
{
    check_ajax_referer('crud_app_nonce', 'nonce');
    crud_app_update_record();
}
add_action('wp_ajax_crud_app_update_record', 'crud_app_ajax_update_record');



// delete single data 
function crud_app_ajax_delete_record()
{
    check_ajax_referer('crud_app_nonce', 'nonce');
    crud_app_delete_record();
}
add_action('wp_ajax_crud_app_delete_record', 'crud_app_ajax_delete_record');




// front end ajax handler 

add_action('wp_enqueue_scripts', 'auth_enqueue_scripts_ajax');

function auth_enqueue_scripts_ajax()
{
    wp_enqueue_script('auth-app-ajax', plugin_dir_url(__FILE__) . 'assets/js/auth.js', array('jquery'), null, true);

    wp_localize_script('auth-app-ajax', 'FAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('auth_app_nonce'),
    ));
}



function auth_app_ajax_update_profile()
{
    check_ajax_referer('auth_app_nonce', 'nonce');
    user_profile_update();
}
add_action('wp_ajax_user_profile_update', 'auth_app_ajax_update_profile');
add_action('wp_ajax_nopriv_user_profile_update', 'auth_app_ajax_update_profile');



function auth_app_ajax_login()
{
    check_ajax_referer('auth_app_nonce', 'nonce');
    auth_user_login();
}
add_action('wp_ajax_user_login', 'auth_app_ajax_login');
add_action('wp_ajax_nopriv_user_login', 'auth_app_ajax_login');



function auth_registration()
{
    check_ajax_referer('auth_app_nonce', 'nonce');
    auth_user_registration();
}
add_action('wp_ajax_user_registration', 'auth_registration');
add_action('wp_ajax_nopriv_user_registration', 'auth_registration');
