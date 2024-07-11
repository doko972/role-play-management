<?php
ob_start(); // Démarrer la mise en tampon de sortie
session_start();
include 'includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && isset($_POST['card_id']) && isset($_POST['story'])) {
    $user_id = $_SESSION['user_id'];
    $card_id = intval($_POST['card_id']);
    $story = htmlspecialchars($_POST['story'], ENT_QUOTES, 'UTF-8');
    $story_date = date('Y-m-d');

    $json = file_get_contents('json/saints.json');
    $cards = json_decode($json, true);
    $card_name = null;

    foreach ($cards as $card) {
        if ($card['id'] == $card_id) {
            $card_name = $card['name'];
            break;
        }
    }

    if ($card_name === null) {
        $_SESSION['error_message'] = 'Nom de la carte introuvable.';
        header('Location: card.php?id=' . $card_id);
        exit();
    }

    $id_faction = 1;

    // Personnage existe déjà ?
    $stmt = $dbCo->prepare("SELECT COUNT(*) FROM characters WHERE id_characters = :card_id AND id_user = :user_id");
    $stmt->bindParam(':card_id', $card_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    try {
        if ($count > 0) {
            // Mise à jour de l'histoire existante
            $stmt = $dbCo->prepare("UPDATE characters SET story = :story, story_date = :story_date WHERE id_characters = :card_id AND id_user = :user_id");
            $stmt->bindParam(':story', $story);
            $stmt->bindParam(':story_date', $story_date);
            $stmt->bindParam(':card_id', $card_id);
            $stmt->bindParam(':user_id', $user_id);
        } else {
            // Nouvelle histoire
            $stmt = $dbCo->prepare("INSERT INTO characters (id_characters, name, story, story_date, main_charc, id_faction, id_user) 
            VALUES (:card_id, :name, :story, :story_date, 1, :id_faction, :user_id)");
            $stmt->bindParam(':card_id', $card_id);
            $stmt->bindParam(':name', $card_name);
            $stmt->bindParam(':story', $story);
            $stmt->bindParam(':story_date', $story_date);
            $stmt->bindParam(':id_faction', $id_faction);
            $stmt->bindParam(':user_id', $user_id);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Votre histoire a été soumise avec succès.';
        } else {
            $_SESSION['error_message'] = 'Erreur lors de la soumission de votre histoire.';
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erreur SQL: ' . $e->getMessage();
    }

    header('Location: card.php?id=' . $card_id);
    exit();
} else {
    $_SESSION['error_message'] = 'Données POST non reçues correctement.';
    header('Location: card.php?id=' . intval($_POST['card_id']));
    exit();
}
?>