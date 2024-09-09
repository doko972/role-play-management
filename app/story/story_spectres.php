<?php
ob_start();
session_start();
include '../includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && isset($_POST['card_id']) && isset($_POST['story'])) {
    $user_id = $_SESSION['user_id'];
    $card_id = intval($_POST['card_id']);
    $story = htmlspecialchars($_POST['story'], ENT_QUOTES, 'UTF-8');
    $story_date = date('Y-m-d');
    $card_name = null;
    $id_faction = 3;

    try {
        $min_id = 50;
        $max_id = 70;

        // Nom de la carte
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
            $_SESSION['error_message'] = 'Nom de la carte introuvable.';
            header('Location: ../card_spectres.php?id=' . $card_id);
            exit();
        }

        // Vérification de l'existence du personnage
        $stmt = $dbCo->prepare("SELECT COUNT(*) 
        FROM characters 
        WHERE id_characters = :card_id AND id_user = :user_id");
        $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        // Téléchargement de l'image
        $image_path = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "../uploads/";
            if (!file_exists($target_dir)) {
                // Création du répertoire s'il n'existe pas
                mkdir($target_dir, 0775, true); 
                echo "Répertoire 'uploads' créé.\n";
            }
            // Utilisation d'un nom de fichier unique
            $file_name = uniqid() . '_' . basename($_FILES["image"]["name"]); 
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp");

            // Vérification de l'image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false && in_array($imageFileType, $allowed_extensions)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $_SESSION['error_message'] = "Erreur lors du déplacement du fichier. Chemin cible: " . $target_file;
                    error_log("Erreur move_uploaded_file : " . $_FILES["image"]["error"]);
                    header('Location: ../card_spectres.php?id=' . $card_id);
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Fichier non valide. Seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
                header('Location: ../card_spectres.php?id=' . $card_id);
                exit();
            }
        } elseif (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
            // Gestion des autres erreurs de téléchargement
            $_SESSION['error_message'] = "Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES['image']['error'];
            header('Location: ../card_spectres.php?id=' . $card_id);
            exit();
        }

        // Mise à jour ou insertion des données
        if ($count > 0) {
            // Mise à jour de l'histoire existante
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
            // Insertion d'une nouvelle histoire
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
            $_SESSION['success_message'] = 'Votre histoire a été soumise avec succès.';
        } else {
            $_SESSION['error_message'] = 'Erreur lors de la soumission de votre histoire.';
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erreur SQL: ' . $e->getMessage();
    }

    header('Location: ../card_spectres.php?id=' . $card_id);
    exit();
} else {
    $_SESSION['error_message'] = 'Données POST non reçues correctement.';
    header('Location: ../card_spectres.php?id=' . intval($_POST['card_id']));
    exit();
}
?>