<h1>Conversation #<?= $message->id ?></h1>
<p><strong>De :</strong> <?= htmlspecialchars($message->sender_id) ?></p>
<p><strong>À :</strong> <?= htmlspecialchars($message->receiver_id) ?></p>
<p><strong>Message :</strong> <?= htmlspecialchars($message->content) ?></p>
