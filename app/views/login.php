<?php
$error_msg = $error_msg ?? '';
$successful = $successful ?? false;
$username = $username ?? '';
?>

<header class="flex">
    <div class="flex" style="flex: 1;">
        <h1 class="sans-font" style="padding-right: 1rem;">Votio</h1>
    </div>
</header>

<main>
    <p style="color: green;"><?= $successful ? "Successfully created your account. Please Login." : "" ?></p>
    <p style="color: red;"><?= $error_msg ?></p>

    <form action="<?= BASE_PATH ?>/user/login" method="POST" id="login-form">
        <div style="margin-top: -1.1rem; margin-bottom: 2rem; color: var(--primary-color);">
            <h1 class="sans-font">Login to your account</h1>
        </div>
        <label for="username-inp">Username </label>
        <input type="text" id="username-inp" class="flex-1" name="username" required placeholder="Enter your username" value="<?= $username ?>">
        <label for="password-inp">Password</label>
        <input type="password" id="password-inp" class="flex-1" name="password" required placeholder="Enter your password">
        <div style="margin-top: 2rem;">
            <p style="display: inline;">
                New here?
                <a style="display: inline;" href="<?= BASE_PATH ?>/user/register">Register instead.</a>
            </p>
            <button type="submit" class="primary-btn">Login</button>
        </div>
    </form>
</main>