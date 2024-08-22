<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../includes/_database.php';
include '../includes/_functions.php';

generateToken();
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
    $date_parts = explode('/', $birthday);
    if (count($date_parts) == 3 && checkdate($date_parts[1], $date_parts[0], $date_parts[2])) {
        $formatted_birthday = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
    } else {
        $error_message = "Format de date invalide.";
    }

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
                    header("Location: registration_success.php");
                    exit();
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
if (isset($error_message)) {
    echo '<div class="error-message">' . $error_message . '</div>';
}
?>