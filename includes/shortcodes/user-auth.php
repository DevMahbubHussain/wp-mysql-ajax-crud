<?php


add_shortcode('user-auth', 'render_user_auth');


function render_user_auth()
{
    if (is_user_logged_in()) {
        return profile_page();
    } else {
        return login_page();
    }
}
