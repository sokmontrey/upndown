<?php
$error_msg = $error_msg ?? '';
$username = $username ?? '';
$email = $email ?? '';
$BASE_PATH = $BASE_PATH ?? '';
?>

<header class="flex">
    <div class="flex" style="flex: 1;">
        <h1 class="sans-font" style="padding-right: 1rem;">UpNDown</h1>
    </div>
</header>

<main>
    <h1 style="font-size: 1.5rem;" class="sans-font">Create a new account</h1>

    <form action="<?= $BASE_PATH ?>/user/register" method="POST">
        <p style="color: red;"><?= $error_msg ?></p>
        <input type="text" name="username" required placeholder="Username" value="<?= $username ?>">
        <input type="email" name="email" required placeholder="Email" value="<?= $email ?>">
        <input type="password" name="password" required placeholder="Password">
        <input type="password" name="confirm-password" required placeholder="Re-enter Password">
        <button type="submit" class="primary-btn">Register</button>
    </form>

    <p>
        Already have an account?
        <a style="display: inline;" href="<?= $BASE_PATH ?>/user/login">Login instead.</a>
    </p>
</main>
