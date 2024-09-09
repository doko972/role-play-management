<?php
ob_start();
session_start();
include '../includes/_database.php';
include '../includes/_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) 
&& isset($_POST['card_id']) && isset($_POST['story'])) {
    $user_id = $_SESSION['user_id'];
    $card_id = intval($_POST['card_id']);
    $story = htmlspecialchars($_POST['story'], ENT_QUOTES, 'UTF-8');
    $story_date = date('Y-m-d');
    $card_name = null;
    $id_faction = 1;

    try {
        $min_id = 1;
        $max_id = 29;

        // nom de la carte
        $stmt = $dbCo->prepare("SELECT name 
        FROM img 
        WHERE id_img = :card_id AND id_img BETWEEN :min_id AND :max_id");
        $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
        $stmt->bindParam(':min_id', $min_id, PDO::PARAM_INT);
        $stmt->bindParam(':max_id', $max_id, PDO::PARAM_INT);
        $stmt->execute();
        $card = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($card) {
            $card_name = $card['name'];
        } else {
            $_SESSION['error_message'] = $errors['card_not_find'];
            header('Location: ../card.php?id=' . $card_id);
            exit();
        }

        // Personnage existe déjà ?
        $stmt = $dbCo->prepare("SELECT COUNT(*) 
        FROM characters 
        WHERE id_characters = :card_id AND id_user = :user_id");
        $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        // téléchargement d'image
        $image_path = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp");

            // image est valide ?
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false && in_array($imageFileType, $allowed_extensions)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $_SESSION['error_message'] = $errors['upload_fail'];
                    header('Location: ../card.php?id=' . $card_id);
                    exit();
                }
            } else {
                $_SESSION['error_message'] = $errors['error_img_format'];
                header('Location: ../card.php?id=' . $card_id);
                exit();
            }
        }

        if ($count > 0) {
            // Maj de l'histoire existante
            if ($image_path) {
                $stmt = $dbCo->prepare("UPDATE characters 
                SET story = :story, story_date = :story_date, image = :image 
                WHERE id_characters = :card_id AND id_user = :user_id");
                $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
            } else {
                $stmt = $dbCo->prepare("UPDATE characters 
                SET story = :story, story_date = :story_date 
                WHERE id_characters = :card_id AND id_user = :user_id");
            }
            $stmt->bindParam(':story', $story, PDO::PARAM_STR);
            $stmt->bindParam(':story_date', $story_date, PDO::PARAM_STR);
            $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            // Nouvelle histoire
            $stmt = $dbCo->prepare("INSERT INTO characters (id_characters, name, story, story_date, main_charc, id_faction, id_user, image) 
                                    VALUES (:card_id, :name, :story, :story_date, 1, :id_faction, :user_id, :image)");
            $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $card_name, PDO::PARAM_STR);
            $stmt->bindParam(':story', $story, PDO::PARAM_STR);
            $stmt->bindParam(':story_date', $story_date, PDO::PARAM_STR);
            $stmt->bindParam(':id_faction', $id_faction, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = $messages['success_message'];
        } else {
            $_SESSION['error_message'] = $messages['error_message'];
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = $messages['error_SQL'] . ': ' . $e->getMessage();
    }

    header('Location: ../card.php?id=' . $card_id);
    exit();
} else {
    $_SESSION['error_message'] = $messages['error_POST'];
    header('Location: ../card.php?id=' . intval($_POST['card_id']));
    exit();
}