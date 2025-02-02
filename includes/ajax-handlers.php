<?php

function crud_app_enqueue_scripts()
{
    wp_enqueue_script('crud-app-ajax', plugin_dir_url(__FILE__) . '/assets/js/crud.js', array('jquery'), null, true);
    wp_localize_script('crud-app-ajax', 'CAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('crud_app_nonce'),
    ));
}
add_action('admin_enqueue_scripts', 'crud_app_enqueue_scripts');


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



// delete single data 

function crud_app_ajax_delete_record()
{
    check_ajax_referer('crud_app_nonce', 'nonce');
    crud_app_delete_record();
}
add_action('wp_ajax_crud_app_delete_record', 'crud_app_ajax_delete_record');
