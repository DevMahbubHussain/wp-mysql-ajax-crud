    <?php $user = wp_get_current_user(); ?>
    <div class="profile-container">
        <h2>Update Profile</h2>
        <form method="post" id="profile-form">
            <label for="display_name">Username</label>
            <input type="text" id="display_name" name="display_name" value="<?php echo esc_attr($user->display_name); ?>" placeholder="Enter username" required>

            <label for="email">Email</label>
            <input type="email" id="user_email" name="user_email" value="<?php echo esc_attr($user->user_email); ?>" placeholder="Enter email" required>
            <?php wp_nonce_field('auth_app_nonce'); ?>
            <button type="submit">Save Changes</button>
        </form>
    </div>