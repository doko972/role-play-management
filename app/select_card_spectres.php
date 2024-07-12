<?php
session_start();
ob_start();
include 'includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && isset($_POST['card_id'])) {
    $user_id = $_SESSION['user_id'];
    $card_id = intval($_POST['card_id']);


    $stmt = $dbCo->prepare("SELECT id_user FROM users WHERE selected_card = :card_id AND id_user != :user_id");
    $stmt->bindParam(':card_id', $card_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {

        $_SESSION['error_message'] = 'Ce rôle a déjà été choisi par un autre utilisateur.';
        header('Location: card_spectres.php?id=' . $card_id);
        exit();
    } else {

        $stmt = $dbCo->prepare("UPDATE users SET selected_card = :card_id WHERE id_user = :user_id");
        $stmt->bindParam(':card_id', $card_id);
        $stmt->bindParam(':user_id', $user_id);
        if ($stmt->execute()) {
            echo "Carte choisie avec succès.";
        } else {
            echo "Erreur lors de la sélection de la carte.";
        }

        header('Location: card_spectres.php?id=' . $card_id);
        exit();
    }
} else {
    echo "Données POST non reçues correctement.";
}
ob_end_flush();
?>