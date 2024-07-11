<?php
session_start();
include 'includes/_database.php';
include 'includes/_functions.php';
// eviter l'envoi prématuré des headers
ob_start();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = sanitizeInput($_POST['login']);
    $passwd = sanitizeInput($_POST['passwd']);
    $token = sanitizeInput($_POST['token']);

    if (validateToken($token)) {
        $stmt = $dbCo->prepare("SELECT * FROM users WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($passwd, $user['passwd'])) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['is_online'] = 1;

            $updateStmt = $dbCo->prepare("UPDATE users SET is_online = 1 WHERE id_user = :id_user");
            $updateStmt->bindParam(':id_user', $user['id_user']);
            $updateStmt->execute();

            header("Location: welcome.php");
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect !";
        }
    } else {
        echo "Token CSRF invalide !";
    }
} else {
    echo "Méthode de requête non autorisée !";
}
// sortie tamponnée au navigateur
ob_end_flush();  
?>