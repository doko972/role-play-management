<?php
session_start();
include 'includes/_database.php';
include 'includes/_functions.php';
include 'includes/_config.php';

// Vérifier si l'utilisateur est connecté et est administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    redirectTo("../index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = intval($_POST['id_user']);

    // Vérifier si la demande est pour une mise à jour du rôle ou une suppression
    if (isset($_POST['update_role'])) {
        $role = sanitizeInput($_POST['role']);

        // Vérification de la validité du rôle
        if ($role === 'user' || $role === 'admin') {
            try {
                $stmt = $dbCo->prepare("UPDATE users 
                SET role = :role 
                WHERE id_user = :id_user");
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $_SESSION['success_message'] = $messages['update_role'];
                } else {
                    $_SESSION['error_message'] = $messages['error_message'];
                }
            } catch (PDOException $e) {
                $_SESSION['error_message'] = "Erreur : " . $e->getMessage();
            }
        } else {
            $_SESSION['error_message'] = $messages['invalid_role'];
        }
    } elseif (isset($_POST['delete_user'])) {
        try {
            // Démarrer une transaction
            $dbCo->beginTransaction();

            // Supprimer les enregistrements dans `characters` associés à l'utilisateur
            $stmt = $dbCo->prepare("DELETE FROM characters WHERE id_user = :id_user");
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les enregistrements dans `img` associés à l'utilisateur
            $stmt = $dbCo->prepare("DELETE FROM img WHERE taken_by_user_id = :id_user");
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les enregistrements dans `posts` associés à l'utilisateur
            $stmt = $dbCo->prepare("DELETE FROM posts WHERE user_id = :id_user");
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer l'utilisateur dans `users`
            $stmt = $dbCo->prepare("DELETE FROM users WHERE id_user = :id_user");
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = $messages['delete_user'];
            } else {
                $_SESSION['error_message'] = $messages['error_delete'];
            }

            // Valider la transaction
            $dbCo->commit();
        } catch (PDOException $e) {
            // Annuler la transaction en cas d'erreur
            $dbCo->rollBack();
            $_SESSION['error_message'] = "Erreur : " . $e->getMessage();
        }
    }

    // Redirection après traitement
    redirectTo("dashboard.php");
    exit();
}
?>
