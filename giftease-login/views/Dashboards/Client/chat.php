<?php
// $groupedMessages is expected to be set before including this file
if (!isset($groupedMessages)) $groupedMessages = [];
?>

<?php foreach ($groupedMessages as $msg): ?>
<div class="message <?= $msg['sent'] ? 'other' : 'user' ?>" data-vendor-id="<?= $msg['vendor_id'] ?>">
    <div class="text"><?= htmlspecialchars($msg['messege']) ?></div>

    <?php if (!empty($msg['attachments'])): ?>
        <div class="attachments">
            <?php foreach ($msg['attachments'] as $file): ?>
                <img src="resources/uploads/client/attatchments/<?= htmlspecialchars($file) ?>" class="imageBox">
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="timestamp"><?= $msg['created_at'] ?></div>
</div>
<?php endforeach; ?>

