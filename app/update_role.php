<?php
session_start();
include 'includes/_database.php';
include 'includes/_functions.php';

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = intval($_POST['id_user']);
    $role = sanitizeInput($_POST['role']);

    // Vérifier si le rôle est valide
    if ($role === 'user' || $role === 'admin') {
        try {
            $stmt = $dbCo->prepare("UPDATE users SET role = :role WHERE id_user = :id_user");
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id_user', $id_user);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Rôle mis à jour avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la mise à jour du rôle.";
            }
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Erreur : ' . $e->getMessage();
        }
    } else {
        $_SESSION['error_message'] = "Rôle invalide.";
    }

    header("Location: dashboard.php");
    exit();
} else {
    header("Location: dashboard.php");
    exit();
}
?>