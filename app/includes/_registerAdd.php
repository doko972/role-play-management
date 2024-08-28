<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../includes/_database.php';
include '../includes/_functions.php';

generateToken();

// Récupérer les factions
$factions = [];
try {
    $stmt = $dbCo->prepare("SELECT * FROM faction");
    $stmt->execute();
    $factions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    addError('error_SQL');
    error_log('Erreur lors de la récupération des factions : ' . $e->getMessage());
}

// Si des erreurs sont présentes dans la session, les afficher et les supprimer
if (isset($_SESSION['error_keys'])) {
    foreach ($_SESSION['error_keys'] as $errorKey) {
        addError($errorKey);
    }
    unset($_SESSION['error_keys']);
}

// Si des messages de succès sont présents dans la session, les afficher et les supprimer
if (isset($_SESSION['message_keys'])) {
    foreach ($_SESSION['message_keys'] as $messageKey) {
        addMessage($messageKey);
    }
    unset($_SESSION['message_keys']);
}
?>