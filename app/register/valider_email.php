<?php
include '../includes/_database.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $dbCo->prepare("SELECT * FROM users WHERE validation_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $stmt = $dbCo->prepare("UPDATE users SET is_verified = 1, validation_token = NULL WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $user['id_user']);
        $stmt->execute();

        echo "Votre email a été validé avec succès ! Vous pouvez maintenant vous connecter.";
    } else {
        echo "Lien de validation invalide ou expiré.";
    }
} else {
    echo "Token non fourni.";
}
?>