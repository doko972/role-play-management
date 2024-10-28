<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../includes/_database.php';
include '../includes/_functions.php';

generateToken();

// Recover Factions
$factions = [];
try {
    $stmt = $dbCo->prepare("SELECT id_faction, faction_name
    FROM faction");
    $stmt->execute();
    $factions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    addError('error_SQL');
}

// If there are errors in the session, display and delete them
if (isset($_SESSION['error_keys'])) {
    foreach ($_SESSION['error_keys'] as $errorKey) {
        addError($errorKey);
    }
    unset($_SESSION['error_keys']);
}

// If there are any success messages in the session, display and delete them
if (isset($_SESSION['message_keys'])) {
    foreach ($_SESSION['message_keys'] as $messageKey) {
        addMessage($messageKey);
    }
    unset($_SESSION['message_keys']);
}
?>