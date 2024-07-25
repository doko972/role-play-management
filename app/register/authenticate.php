<?php
session_start();
include '../includes/_database.php';
include '../includes/_functions.php';

ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = sanitizeInput($_POST['login']);
    $passwd = sanitizeInput($_POST['passwd']);
    $token = sanitizeInput($_POST['token']);

    if (validateToken($token)) {
        $stmt = $dbCo->prepare("SELECT * FROM users 
        WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($passwd, $user['passwd'])) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['is_online'] = 1;

            $updateStmt = $dbCo->prepare("UPDATE users SET is_online = 1 
            WHERE id_user = :id_user");
            $updateStmt->bindParam(':id_user', $user['id_user']);
            $updateStmt->execute();

            $selected_card_id = $user['selected_card'];
            $cardStmt = $dbCo->prepare("SELECT name FROM img 
            WHERE id_img = :selected_card_id");
            $cardStmt->bindParam(':selected_card_id', $selected_card_id);
            $cardStmt->execute();
            $card = $cardStmt->fetch();

            $selected_card_name = $card ? $card['name'] : 'inconnu';

            $_SESSION['welcome_message'] = 'Bienvenue ' . htmlspecialchars_decode($selected_card_name, ENT_QUOTES);

            header("Location: ../welcome.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect !";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Token CSRF invalide !";
        header("Location: ../login.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Méthode de requête non autorisée !";
    header("Location: ../login.php");
    exit();
}
?>