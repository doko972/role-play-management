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
        $stmt = $dbCo->prepare("SELECT id_user, login, passwd, truename, email, birthday, creatime, is_online, faction_id, selected_card, last_activity, role
        FROM users 
        WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($passwd, $user['passwd'])) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['is_online'] = 1;

            $updateStmt = $dbCo->prepare("UPDATE users 
            SET is_online = 1 
            WHERE id_user = :id_user");
            $updateStmt->bindParam(':id_user', $user['id_user']);
            $updateStmt->execute();

            $selected_card_id = $user['selected_card'];
            $cardStmt = $dbCo->prepare("SELECT name 
            FROM img 
            WHERE id_img = :selected_card_id");
            $cardStmt->bindParam(':selected_card_id', $selected_card_id);
            $cardStmt->execute();
            $card = $cardStmt->fetch();

            $selected_card_name = $card ? $card['name'] : 'inconnu';

            $_SESSION['welcome_message'] = 'Bienvenue ' . $selected_card_name;

            header("Location: ../welcome.php");
            exit();
        } else {
            $_SESSION['error_message'] = $errors['incorrect_password'];
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = $errors['invalid_token'];
        header("Location: ../login.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = $errors['not_allowed'];
    header("Location: ../login.php");
    exit();
}
?>