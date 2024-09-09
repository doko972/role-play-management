<?php
session_start();
ob_start();
include 'includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) 
&& isset($_POST['card_id'])) {
    $user_id = $_SESSION['user_id'];
    $card_id = intval($_POST['card_id']);

    try {
        // Vérifier si la card est déjà prise par un autre utilisateur
        $stmt = $dbCo->prepare("SELECT taken_by_user_id 
        FROM img 
        WHERE id_img = :card_id");
        $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
        $stmt->execute();
        $card = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($card && $card['taken_by_user_id'] !== null && $card['taken_by_user_id'] != $user_id) {
            $_SESSION['error_message'] = $errors['error_taken_role'];
            header('Location: card_spectres.php?id=' . $card_id);
            exit();
        } else {
            // Mettre à jour la table `img` pour indiquer que la card est prise par l'utilisateur
            $stmt = $dbCo->prepare("UPDATE img 
            SET taken_by_user_id = :user_id 
            WHERE id_img = :card_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
            $stmt->execute();

            // Mettre à jour la table `users` pour indiquer la carte sélectionnée
            $stmt = $dbCo->prepare("UPDATE users 
            SET selected_card = :card_id 
            WHERE id_user = :user_id");
            $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                header('Location: card.php?id=' . $card_id);
                exit();
            } else {
                $_SESSION['error_message'] = $errors['error_select_role'];
                header('Location: card_spectres.php?id=' . $card_id);
                exit();
            }
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = $errors['error'] . $e->getMessage();
        header('Location: card_spectres.php?id=' . $card_id);
        exit();
    }
} else {
    echo $errors['data_error'];
}

ob_end_flush();
?>