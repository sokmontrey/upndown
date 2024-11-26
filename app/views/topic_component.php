<?php
$BASE_PATH = $BASE_PATH ?? '';
$topics = $topics ?? [];
?>

<ul>
    <?php foreach ($topics as $topic): ?>
        <li class="topic-container">
            <p style="color: var(--text-color);">By <?= $topic['username'] ?></p>
            <p><?= $topic['created_at'] ?></p>
            <h2><?= $topic['title'] ?></h2>
            <p><?= $topic['description'] ?></p>

            <?php
            $voted = $topic['voted'];
            $up_color = $voted === 'up' ? 'color: var(--primary-color);' : 'color: var(--text2-color);';
            $down_color = $voted === 'down' ? 'color: var(--primary-color);' : 'color: var(--text2-color);';
            ?>
            <div class="flex">
                <a href="<?= $BASE_PATH ?>/topic/voteUp?id=<?= $topic['id'] ?>"
                   style="margin-right: 3rem; <?= $up_color ?>">
                    <?= $topic['votes']['up'] ?> <i class="fa-solid fa-up-long"></i>
                </a>
                <a href="<?= $BASE_PATH ?>/topic/voteDown?id=<?= $topic['id'] ?>" style="<?= $down_color ?>">
                    <?= $topic['votes']['down'] ?> <i class="fa-solid fa-down-long"></i>
                </a>
            </div>
            <h3>Comments:</h3>
            <ul>
                <?php foreach ($topic['comments'] as $comment): ?>
                    <li>
                        <p><?= $comment['comment'] ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
            <form action="<?= $BASE_PATH ?>/topic/comment" method="POST">
                <input type="hidden" name="topic_id" value="<?= $topic['id'] ?>"/>
                <input type="text" placeholder="Comment" name="comment"/>
                <button class="primary-btn" type="submit">Submit</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
