<?php
$messages = [
    'insertTodoMessage' => 'success',
    'deleteMessage' => 'success',
    'errorEmptyMessage' => 'error',
    'todoUpdateMessage' => 'success',
    'statusUpdateMessage' => 'success'
];

foreach ($messages as $key => $type):
    if (!empty($_SESSION[$key])): ?>
        <div class="message <?= $type ?>-message">
            <?= htmlspecialchars($_SESSION[$key]) ?>
        </div>
        <?php unset($_SESSION[$key]); ?>
    <?php endif;
endforeach;
?>
