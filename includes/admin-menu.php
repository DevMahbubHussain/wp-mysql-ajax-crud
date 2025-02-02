<?php

function crud_app_admin_menu()
{

    add_menu_page(
        'CRUD App',
        'CRUD App',
        'manage_options',
        'crud-app',
        'crud_app_admin_page',
        'dashicons-list-view',
        6
    );
}
add_action('admin_menu', 'crud_app_admin_menu');


function crud_app_admin_page()
{
    require_once plugin_dir_path(__FILE__) . '../includes/templates/add-form.php';
}
