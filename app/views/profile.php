<?php
$username = $username ?? '';
$created_topics = $created_topics ?? [];
$created_votes = $created_votes ?? [];
?>

<header class="flex">
    <div class="flex" style="flex: 1;">
        <a class="sans-font" style="padding-right: 1rem;" href="<?=BASE_PATH?>/home/index">
            <h1>
                <i class="fa-solid fa-arrow-left"></i>
                Votio
            </h1>
        </a>
        <a href="<?=BASE_PATH?>/setting/switchTheme" id="theme-btn">
            <?=THEME === 'light' ? '<i class="fa-solid fa-moon"></i>' : '<i class="fa-solid fa-sun"></i>' ?>
        </a>
    </div>

    <nav class="flex">
        <span style="padding-right: 2rem;" class="flex">
            <div class="profile-logo"><?= $username[0] ?></div>
            <?=$username?>
        </span>
        <a href="<?=BASE_PATH?>/user/logout" class="">Logout</a>
    </nav>
</header>

<hr>

<main>
    <h2>Created Topics:</h2>
    <?php $topics = $created_topics ?>
    <?php require_once 'topic_component.php' ?>

    <hr>

    <h2>Voting history</h2>
    <ul>
        <?php foreach($created_votes as $vote): ?>
            <li class="vote-history-container">
                <?php if($vote['vote_type'] === 'up'): ?>
                    <i class="fa-solid fa-up-long"></i>
                <?php else: ?>
                    <i class="fa-solid fa-down-long"></i>
                <?php endif; ?>

                <span><?=$vote['topic']['title']?></span>
                <span style="color: var(--text2-color);">By: <?=$vote['topic']['creator']?></span>
                <br>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
