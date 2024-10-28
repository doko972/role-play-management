<?php
session_start();
include 'includes/_database.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Update is_online status to 0
    $stmt = $dbCo->prepare('UPDATE users 
    SET is_online = 0 
    WHERE id_user = :user_id');
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}

// Destroy session
session_destroy();
header("Location: login.php");
exit();
?>