<?php


function  profile_page()
{
    ob_start();
    require_once plugin_dir_path(__FILE__) . '../../includes/templates/profile-form.php';
    return ob_get_clean();
};


function login_page()
{
    ob_start();
    require_once plugin_dir_path(__FILE__) . '../../includes/templates/login-form.php';
    return ob_get_clean();
}
