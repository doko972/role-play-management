<?php

function createForm($taskId, $token, $action, $buttonText, $buttonClass = "button__remove", $additionalAttributes = '') {
    return '<form method="POST" action="actions.php" style="display: inline;">'
        . '<input type="hidden" name="task_id" value="' . htmlspecialchars($taskId) . '">'
        . '<input type="hidden" name="token" value="' . htmlspecialchars($token) . '">'
        . '<input type="hidden" name="action" value="' . htmlspecialchars($action) . '">'
        . '<button type="submit" class="' . htmlspecialchars($buttonClass) . '" ' . $additionalAttributes . '>' . htmlspecialchars($buttonText) . '</button>'
        . '</form>';
}

$taskId = htmlspecialchars($product['id_task']);
$token = htmlspecialchars($_SESSION['token']);
$description = htmlspecialchars($product['description']);
$rememberDate = htmlspecialchars($formattedRememberDate);

echo '<ul class="container-action--arrow">'
    . '<li>'
    . createForm($taskId, $token, 'increase_priority', '↑')
    . createForm($taskId, $token, 'decrease_priority', '↓')
    . '</li>'
    . '</ul>';

echo '<ul class="action-btn">'
    . '<li>'
    . createForm($taskId, $token, 'delete', 'Supprimer', 'button__remove', 'id="deleteId"')
    . '</li>'
    . '<li>'
    . createForm($taskId, $token, 'done', 'Fait')
    . '<button onclick="showEditForm(' . $taskId . ')" class="button__remove">Modifier</button>'
    . '</li>'
    . '</ul>';

echo '<div id="editForm-' . $taskId . '" class="hidden">'
    . '<form method="POST" action="actions.php">'
    . '<input type="hidden" name="task_id" value="' . $taskId . '">'
    . '<input type="hidden" name="token" value="' . $token . '">'
    . '<input type="hidden" name="action" value="edit">'
    . '<input type="text" name="new_description" value="' . $description . '" required>'
    . '<input type="date" name="new_remember_date" value="' . $rememberDate . '">'
    . '<button type="submit" class="button__submit-edit">Valider la modification</button>'
    . '</form>'
    . '</div>';

?>