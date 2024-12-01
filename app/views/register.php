<?php
$error_msg = $error_msg ?? '';
$username = $username ?? '';
$email = $email ?? '';
?>

<header>
    <div id="app-logo">
        <h1 class="sans-font" >Votio</h1>
    </div>
</header>

<main>
    <?php if ($error_msg): ?>
    <div id="message-container">
        <p style="color: red;"><?= $error_msg ?></p>
    </div>
    <?php endif; ?>

    <form action="<?= BASE_PATH ?>/user/register" method="POST">
        <h1 class="sans-font">Create a new account</h1>
        <label for="username-inp">Username</label>
        <input type="text" id="username-inp" class="flex-1" name="username" required placeholder="Enter your username" value="<?= $username ?>">
        <label for="email-inp">Email</label>
        <input type="email" id="email-inp" class="flex-1" name="email" required placeholder="abc@mail.com" value="<?= $email ?>">
        <label for="password-inp">Password</label>
        <input type="password" id="password-inp" class="flex-1" name="password" required placeholder="(9 digits long)">
        <label for="conf-pass-inp">Confirm Password</label>
        <input type="password" id="conf-pass-inp" class="flex-1" name="confirm-password" required placeholder="Re-enter your password">
        <div style="margin-top: 2rem;">
            <button type="submit" class="primary-btn">Register</button>
        </div>
        <p style="display: inline;">
            Already have an account?
            <a style="display: inline;" href="<?= BASE_PATH ?>/user/login">Login instead.</a>
        </p>
    </form>

</main>
