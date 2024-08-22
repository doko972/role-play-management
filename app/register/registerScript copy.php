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
        $error_message = $errors['date_format_invalid'];
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
                    // $validation_link = "https://www.saintseiyajeuderole.online/register/valider_email.php?token=" . $validation_token;
                    // $subject = "Validez votre email";
                    // $message = "Cliquez sur ce lien pour valider votre email : " . $validation_link;
                    // $headers = "From: no-reply@saintseiyajeuderole.online";
                    $validation_link = "https://www.saintseiyajeuderole.online/register/valider_email.php?token=" . $validation_token;
                    $subject = "Validez votre email";
                    
                    // Création du message en HTML avec des styles en ligne pour correspondre au style de ton site
                    $message = "
                    <html>
                    <head>
                      <title>Validez votre email</title>
                      <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #0d1b2a;
                            color: #ffffff;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            width: 100%;
                            padding: 20px;
                            background-color: #253661;
                            text-align: center;
                        }
                        h1 {
                            color: #ffffff;
                            font-size: 2.5em;
                            margin-bottom: 20px;
                        }
                        p {
                            font-size: 1.2em;
                            margin-bottom: 20px;
                            color: #ffffff;
                        }
                        .button {
                            display: inline-block;
                            padding: 10px 20px;
                            font-size: 1.2em;
                            background-color: #ffffff;
                            text-decoration: none;
                            border-radius: 5px;
                            border:3px solid #9C1CF7 
                        }
                        .button:hover {
                            background-color: #1a5276;
                        }
                      </style>
                    </head>
                    <body>
                      <div class='container'>
                        <h1>Bienvenue sur Saint Seiya Jeu de Rôle !</h1>
                        <p>Merci de vous être inscrit sur notre site. Pour activer votre compte, veuillez cliquer sur le bouton ci-dessous :</p>
                        <p><a href='$validation_link' class='button'>Valider mon email</a></p>
                        <p>Ou copiez/collez ce lien dans votre navigateur :</p>
                        <p>$validation_link</p>
                        <br>
                        <p>Nous vous remercions pour votre inscription et vous souhaitons une excellente expérience parmi nous.</p>
                        <p>À bientôt sur Saint Seiya Jeu de Rôle !</p>
                        <br>
                        <img src='https://www.saintseiyajeuderole.online/img/logo.webp' alt='Logo Saint Seiya' width='200' style='margin: 20px auto; display: block;'>
                      </div>
                    </body>
                    </html>
                    ";
                    
                    // Définir les en-têtes pour un email en HTML
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: no-reply@saintseiyajeuderole.online" . "\r\n";
                    
                    // Envoi de l'email
                    mail($email, $subject, $message, $headers);

                    if (mail($email, $subject, $message, $headers)) {
                        // Redirection vers une page informant l'utilisateur de vérifier son email
                        header("Location: check_email.php");
                        exit();
                    } else {
                        $error_message = "L'envoi de l'email de validation a échoué.";
                    }
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

    if (isset($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
}
?>