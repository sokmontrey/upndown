<?php
$username = $username ?? '';
$created_topics = $created_topics ?? [];
$created_votes = $created_votes ?? [];
?>

<header class="flex">
    <a id="back-button" href="<?=BASE_PATH?>/home/index">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <div id="profile-container">
        <div class="profile-logo">
            <i class="fa-solid fa-gear"></i>
        </div>
        <div id="setting-container">
            <p><?=$username?></p>
            <a href="<?=BASE_PATH?>/setting/switchTheme" id="theme-btn">
                <?=THEME === 'light' ? 'Dark <i class="fa-solid fa-moon"></i>' : 'Light <i class="fa-solid fa-sun"></i>' ?>
            </a>
            <a href="<?=BASE_PATH?>/user/logout" class="">Logout</a>
        </div>
    </div>
</header>

<main>
    <div id="main-container">
        <div>
            <h2>Created Topics:</h2>
            <?php $topics = $created_topics ?>
            <?php require_once 'topic_component.php' ?>
        </div>

        <div id="voting-container">
            <h2>Voting history</h2>
            <ul>
                <?php foreach($created_votes as $vote): ?>
                    <li class="vote-history-container"
                        style="color: var(<?=($vote['vote_type'] === 'up' ? '--suc' : '--err')?>-color);">
                        <span><?=$vote['topic']['title']?></span>
                        <?php if($vote['vote_type'] === 'up'): ?>
                            <i class="fa-solid fa-up-long"></i>
                        <?php else: ?>
                            <i class="fa-solid fa-down-long"></i>
                        <?php endif; ?>
                        <span><?=$vote['topic']['creator']?></span>
                        <br>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</main>
