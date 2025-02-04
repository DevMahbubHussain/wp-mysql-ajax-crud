    <div class="form-container">
        <h2>Login</h2>
        <form method="post" id="login-form">
            <label for="user_login">Username</label>
            <input type="text" id="user_login" name="user_login" id="user_login" placeholder="Enter username" required>
            <label for="user_pass">Password</label>
            <input type="password" id="user_pass" name="user_pass" id="user_pass" placeholder="Enter password" required>
            <?php wp_nonce_field('auth_app_nonce'); ?>
            <button type="submit">Login</button>
        </form>
    </div>