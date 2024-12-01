<?php
$username = $username ?? '';
$error_msg = $error_msg ?? '';
$success_msg = $success_msg ?? '';
$title = $title ?? '';
$description = $description ?? '';
$topics = $topics ?? [];
?>

<header>
    <div id="app-logo">
        <h1 class="sans-font" >Votio</h1>
    </div>

    <nav class="flex">
        <a href="<?= BASE_PATH ?>/user/profile">
            <div class="profile-logo"><?= $username[0].($username[1]??'') ?></div>
        </a>
    </nav>
</header>

<main>
    <?php if ($error_msg || $success_msg): ?>
    <div id="message-container">
        <p><?= $error_msg ?></p>
        <p><?= $success_msg ?></p>
    </div>
    <?php endif; ?>

    <div id="main-container">
        <form action="<?= BASE_PATH ?>/topic/create" method="POST" id="topic-form">
            <h1 class="sans-font">Create a new topic</h1>
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Topic title..." value="<?= $title ?>">
            <label for="description">Description</label>
            <textarea name="description" rows="5" cols="50" placeholder="Your opinion..."><?= $description ?></textarea>
            <button class="primary-btn" type="submit">Create</button>
        </form>

        <div id="topics">
            <h1 class="sans-font" style="margin-bottom: 0px;">Topics</h1>
            <?php require_once 'topic_component.php' ?>
        </div>
    </div>
</main>