<?php
$username = $username ?? '';
$error_msg = $error_msg ?? '';
$success_msg = $success_msg ?? '';
$title = $title ?? '';
$description = $description ?? '';
$topics = $topics ?? [];
$BASE_PATH = $BASE_PATH ?? '';
?>

<header class="flex">
    <div class="flex" style="flex: 1;">
        <h1 class="sans-font" style="padding-right: 1rem;">UpNDown</h1>
    </div>

    <nav class="flex">
        <a href="<?= $BASE_PATH ?>/user/profile">
            User: <?= $username ?>
        </a>
    </nav>
</header>

<hr>

<main>
    <?php if ($error_msg || $success_msg): ?>
        <div id="message-container">
            <p id="error"><?= $error_msg ?></p>
            <p id="success"><?= $success_msg ?></p>
        </div>
    <?php endif; ?>

    <h1 class="sans-font">Create a new topic</h1>
    <form action="<?= $BASE_PATH ?>/topic/create" method="POST">
        <!--            TODO: GIVE INPUT SOME LABELS-->
        <input type="text" name="title" placeholder="Title" value="<?= $title ?>">
        <br>
        <textarea name="description" rows="5" cols="50" placeholder="Description"><?= $description ?></textarea>
        <br>
        <br>
        <button class="primary-btn" type="submit">Create</button>
    </form>

    <hr>

    <h1 class="sans-font" style="margin-bottom: 0px;">Topics</h1>
    <?= require_once 'topic_component.php' ?>
</main>