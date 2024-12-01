<?php
$error_msg = $error_msg ?? '';
$successful = $successful ?? false;
$username = $username ?? '';
?>

<header >
    <div id="app-logo">
        <h1 class="sans-font" >Votio</h1>
    </div>
</header>

<main>

    <?php if ($error_msg || $successful): ?>
    <div id="message-container">
        <p><?= $successful ? "Successfully created your account. Please Login." : "" ?></p>
        <p><?= $error_msg ?></p>
    </div>
    <?php endif; ?>

    <form action="<?= BASE_PATH ?>/user/login" method="POST">
        <h1 class="sans-font">Login</h1>
        <label for="username-inp">Username </label>
        <input type="text" id="username-inp" class="flex-1" name="username" required placeholder="Enter your username" value="<?= $username ?>">
        <label for="password-inp">Password</label>
        <input type="password" id="password-inp" class="flex-1" name="password" required placeholder="Enter your password">
        <div>
            <button type="submit" class="primary-btn">Login</button>
        </div>
        <p style="display: inline;">
            New here?
            <a style="display: inline;" href="<?= BASE_PATH ?>/user/register">Register instead.</a>
        </p>
    </form>
</main>