<?php
include '../includes/_database.php';
include '../includes/_config.php';


if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $dbCo->prepare("SELECT * FROM users 
    WHERE validation_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $stmt = $dbCo->prepare("UPDATE users SET is_verified = 1, validation_token = NULL 
        WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $user['id_user']);
        $stmt->execute();

        header("Location: ../register/registration_success.php");
        exit();
    } else {
        echo $errors['invalid'];
        // Redirection vers la page d'accueil après affichage du message d'erreur
        header("Refresh: 5; url=../index.php");
        exit();
    }
} else {
    echo $errors['not_token'];
    // Redirection vers la page d'accueil après affichage du message d'erreur
    header("Refresh: 5; url=../index.php");
    exit();
}