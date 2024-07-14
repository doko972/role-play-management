<?php
session_start();
include 'includes/_database.php';
include 'includes/_functions.php';
// eviter l'envoi prématuré des headers
ob_start();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Processing form...<br>";
    $login = sanitizeInput($_POST['login']);
    $truename = sanitizeInput($_POST['truename']);
    $email = sanitizeInput($_POST['email']);
    $birthday = sanitizeInput($_POST['birthday']);
    $passwd = sanitizeInput($_POST['passwd']);
    $repasswd = sanitizeInput($_POST['repasswd']);
    $token = sanitizeInput($_POST['token']);

    if (validateToken($token)) {
        echo "Token validated...<br>";
        if ($passwd === $repasswd) {
            echo "Passwords match...<br>";
            $hashedPassword = password_hash($passwd, PASSWORD_BCRYPT);

            $stmt = $dbCo->prepare("INSERT INTO users (login, passwd, truename, email, birthday, creatime, is_online) 
            VALUES (:login, :passwd, :truename, :email, :birthday, NOW(), 0)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':passwd', $hashedPassword);
            $stmt->bindParam(':truename', $truename);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':birthday', $birthday);

            if ($stmt->execute()) {
                echo "User created successfully...<br>";
                ob_flush();
                header("Location: registration_success.php");
                exit();
            } else {
                echo "Erreur lors de l'enregistrement!<br>";
            }
        } else {
            echo "Les mots de passe ne correspondent pas!<br>";
        }
    } else {
        echo "Token CSRF invalide!<br>";
    }
} else {
    echo "Méthode de requête non autorisée!<br>";
}
ob_end_flush();
?>