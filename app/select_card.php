<?php
ob_start(); // Démarre la mise en tampon de sortie
session_start();
include 'includes/_database.php'; // Assurez-vous que ce fichier contient la connexion à votre base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && isset($_POST['card_id'])) {
    $user_id = $_SESSION['user_id'];
    $card_id = intval($_POST['card_id']);

    // Vérifier si la carte est déjà choisie par un autre utilisateur
    $stmt = $dbCo->prepare("SELECT id_user FROM users WHERE selected_card = :card_id AND id_user != :user_id");
    $stmt->bindParam(':card_id', $card_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        // La carte est déjà choisie par un autre utilisateur
        $_SESSION['error_message'] = 'Ce rôle a déjà été choisi par un autre utilisateur.';
        header('Location: card.php?id=' . $card_id);
        exit();
    } else {
        // Mettre à jour la carte choisie par l'utilisateur
        $stmt = $dbCo->prepare("UPDATE users SET selected_card = :card_id WHERE id_user = :user_id");
        $stmt->bindParam(':card_id', $card_id);
        $stmt->bindParam(':user_id', $user_id);
        if ($stmt->execute()) {
            echo "Carte choisie avec succès.";
        } else {
            echo "Erreur lors de la sélection de la carte.";
        }

        header('Location: card.php?id=' . $card_id);
        exit();
    }
} else {
    echo "Données POST non reçues correctement.";
}

ob_end_flush(); // Envoie la sortie tamponnée et désactive la mise en tampon de sortie
?>