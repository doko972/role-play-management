<?php
session_start();
include 'includes/_database.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Mettre à jour le statut is_online à 0
    $stmt = $dbCo->prepare('UPDATE users SET is_online = 0 
    WHERE id_user = :user_id');
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}

// Détruire la session
session_destroy();
header("Location: login.php");
exit();
?>