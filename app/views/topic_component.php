<?php
$topics = $topics ?? [];
?>

<ul>
    <?php foreach ($topics as $topic): ?>
        <li class="topic-container">
            <h2><?= $topic['title'] ?></h2>
            <p><?= $topic['description'] ?></p>

            <div class="create-info">
                <p>By <?= $topic['username'] ?></p>
                <p> . <?= $topic['created_at'] ?></p>
            </div>

            <?php
            $voted = $topic['voted'];
            $up_color = $voted === 'up' ? 'color: var(--suc-color);' : 'color: var(--txt-sec-color);';
            $down_color = $voted === 'down' ? 'color: var(--err-color);' : 'color: var(--txt-sec-color);';
            ?>
            <div class="vote-container">
                <a href="<?= BASE_PATH ?>/topic/voteUp?id=<?= $topic['id'] ?>"
                   style="margin-right: 0.5rem; <?= $up_color ?>">
                    <?= $topic['votes']['up'] ?> <i class="fa-solid fa-up-long"></i>
                </a>
                <a href="<?= BASE_PATH ?>/topic/voteDown?id=<?= $topic['id'] ?>" style="<?= $down_color ?>">
                    <?= $topic['votes']['down'] ?> <i class="fa-solid fa-down-long"></i>
                </a>
            </div>

            <h2>Comments</h2>
            <ul>
                <?php foreach ($topic['comments'] as $comment): ?>
                <li>
                    <p><?= $comment['comment'] ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
            <form action="<?= BASE_PATH ?>/topic/comment" method="POST">
                <input type="hidden" name="topic_id" value="<?= $topic['id'] ?>"/>
                <input type="text" placeholder="Comment" name="comment"/>
                <button class="primary-btn" type="submit">Submit</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
