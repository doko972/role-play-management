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
                    // Envoi de l'email de validation
                    $validation_link = "http://localhost:8080/valider_email.php?token=" . $validation_token;
                    $subject = "Validez votre email";
                    $message = "Cliquez sur ce lien pour valider votre email : " . $validation_link;
                    $headers = 'From: no-reply@saintseiyajeuderole.online' . "\r\n" .
                               'Reply-To: support@saintseiyajeuderole.online' . "\r\n" .
                               'X-Mailer: PHP/' . phpversion();

                    mail($email, $subject, $message, $headers);

                    // Redirection vers une page informant l'utilisateur de vérifier son email
                    header("Location: check_email.php");
                    exit();
                } else {
                    $error_message = "L'inscription a échoué, veuillez réessayer.";
                }
            } catch (PDOException $e) {
                $error_message = "L'inscription a échoué : " . $e->getMessage();
            }
        } else {
            $error_message = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $error_message = "Une erreur s'est produite. Veuillez vérifier les informations saisies.";
    }

    if (isset($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
}
?>