<?php
session_start();

if (isset($_SESSION['user_id'])) {
    redirectTo("../index.php");
}

include '../includes/_database.php';
include '../includes/_functions.php';

generateToken();
preventCSRF('register.php');
generateTokenEmail();

// Récupérer les factions
$factions = [];
try {
    $stmt = $dbCo->prepare("SELECT * FROM faction");
    $stmt->execute();
    $factions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = sanitizeInput($_POST['login']);
    $truename = sanitizeInput($_POST['truename']);
    $email = sanitizeInput($_POST['email']);
    $birthday = sanitizeInput($_POST['birthday']);
    $passwd = sanitizeInput($_POST['passwd']);
    $repasswd = sanitizeInput($_POST['repasswd']);
    $faction = intval($_POST['faction']);
    $token = sanitizeInput($_POST['token']);

    // Formatage de la date de naissance
    $formatted_birthday = date('Y-m-d', strtotime($birthday));

    // Génération du token de validation
    $validation_token = bin2hex(random_bytes(16));

    if (!isset($error_message) && validateToken($token)) {
        if ($passwd === $repasswd) {
            $hashedPassword = password_hash($passwd, PASSWORD_BCRYPT);

            try {
                $stmt = $dbCo->prepare("INSERT INTO users (login, passwd, truename, email, birthday, creatime, is_online, faction_id, validation_token, is_verified) 
                VALUES (:login, :passwd, :truename, :email, :birthday, NOW(), 0, :faction, :validation_token, 0)");
                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':passwd', $hashedPassword);
                $stmt->bindParam(':truename', $truename);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':birthday', $formatted_birthday);
                $stmt->bindParam(':faction', $faction);
                $stmt->bindParam(':validation_token', $validation_token);

                if ($stmt->execute()) {
                    redirectTo('registration_success.php');
                } else {
                    $error_message = $errors['registration_failed'];
                }
            } catch (PDOException $e) {
                $error_message = $errors['registration_failed'] . ': ' . $e->getMessage();
            }
        } else {
            $error_message = $errors['password_mismatch'];
        }
    } else {
        $error_message = $errors['invalid_input'];
    }
}

// Redirection en cas d'erreur
if (isset($error_message)) {
    header('Location: register.php?error=' . urlencode($error_message));
    exit();
}
?>