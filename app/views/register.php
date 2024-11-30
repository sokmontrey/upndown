<?php
$error_msg = $error_msg ?? '';
$username = $username ?? '';
$email = $email ?? '';
?>

<header class="flex">
    <div class="flex" style="flex: 1;">
        <h1 class="sans-font" style="padding-right: 1rem;">Votio</h1>
    </div>
</header>

<main>

    <p style="color: red;"><?= $error_msg ?></p>
    <form action="<?= BASE_PATH ?>/user/register" method="POST" id="registration-form">
        <div style="margin-top: -1.1rem; margin-bottom: 2rem; color: var(--primary-color);">
            <h1 class="sans-font">Create a new account</h1>
        </div>
        <label for="username-inp">Username</label>
        <input type="text" id="username-inp" class="flex-1" name="username" required placeholder="Enter your username" value="<?= $username ?>">
        <label for="email-inp">Email</label>
        <input type="email" id="email-inp" class="flex-1" name="email" required placeholder="Email" value="<?= $email ?>">
        <label for="password-inp">Password</label>
        <input type="password" id="password-inp" class="flex-1" name="password" required placeholder="(9 digits long)">
        <label for="conf-pass-inp">Confirm Password</label>
        <input type="password" id="conf-pass-inp" class="flex-1" name="confirm-password" required placeholder="Re-enter your password">
        <div style="margin-top: 2rem;">
            <p style="display: inline;">
                Already have an account?
                <a style="display: inline;" href="<?= BASE_PATH ?>/user/login">Login instead.</a>
            </p>
            <button type="submit" class="primary-btn">Register</button>
        </div>
    </form>

</main>
