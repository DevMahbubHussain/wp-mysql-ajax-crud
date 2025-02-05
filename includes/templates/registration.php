<div class="form-container">
    <h2>Register</h2>
    <form id="registration-form" method="POST">
        <label for="reg-username">Username</label>
        <input type="text" id="reg-username" name="username" placeholder="Enter username" required>

        <label for="reg-email">Email</label>
        <input type="email" id="reg-email" name="email" placeholder="Enter email" required>

        <label for="reg-password">Password</label>
        <input type="password" id="reg-password" name="password" placeholder="Enter password" required>
        <?php wp_nonce_field('auth_app_nonce'); ?>
        <button type="submit">Register</button>
    </form>
</div>