<h1>Messages</h1>
<ul>
<?php foreach ($messages as $msg): ?>
    <li>
        <a href="/messages/<?= $msg->id ?>">
            De <?= $msg->sender_id ?> à <?= $msg->receiver_id ?> :
            <?= htmlspecialchars($msg->content) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
