<?php
$error_msg = $error_msg ?? '';
$successful = $successful ?? false;
$username = $username ?? '';
$BASE_PATH = $BASE_PATH ?? '';
?>

<header class="flex">
    <div class="flex" style="flex: 1;">
        <h1 class="sans-font" style="padding-right: 1rem;">UpNDown</h1>
    </div>
</header>

<main>
    <h1 style="font-size: 1.5rem;" class="sans-font">Login to your account</h1>

    <form action="<?= $BASE_PATH ?>/user/login" method="POST">
        <p style="color: green;"><?= $successful ? "Successfully created your account. Please Login." : "" ?></p>
        <p style="color: red;"><?= $error_msg ?></p>
        <input type="text" name="username" required placeholder="Username" value="<?= $username ?>">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit" class="primary-btn">Login</button>
    </form>

    <p>
        Doesn't have an account?
        <a style="display: inline;" href="<?= $BASE_PATH ?>/user/register">Create a new account.</a>
    </p>
</main>