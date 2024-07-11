<?php
session_start();
include 'includes/_database.php';
include 'includes/_functions.php';

ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $action = $_POST['action'];
    $uploadDirectory = 'uploads/';
    $uploadedFilePath = '';

    echo "ID: $id <br>";
    echo "Action: $action <br>";

    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] != UPLOAD_ERR_NO_FILE) {
        if ($_FILES['new_image']['error'] == UPLOAD_ERR_OK) {
            $uploadedFileName = basename($_FILES['new_image']['name']);
            $uploadedFilePath = $uploadDirectory . $uploadedFileName;
            $fileType = mime_content_type($_FILES['new_image']['tmp_name']);

            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($fileType, $allowedTypes)) {
                die('Type de fichier non autorisé. Seules les images JPEG, PNG et WebP sont autorisées.');
            }

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            if (!move_uploaded_file($_FILES['new_image']['tmp_name'], $uploadedFilePath)) {
                die('Erreur lors du téléchargement du fichier. Vérifiez les permissions du répertoire de destination.');
            }
        } else {
            die('Erreur de téléchargement du fichier : ' . $_FILES['new_image']['error']);
        }
    }

    if ($action == 'create' || $action == 'update') {
        if ($uploadedFilePath) {
            $json = file_get_contents('json/saints.json');
            $cards = json_decode($json, true);

            foreach ($cards as &$card) {
                if ($card['id'] == $id) {
                    $card['image'] = $uploadedFilePath;
                    break;
                }
            }

            file_put_contents('json/saints.json', json_encode($cards, JSON_PRETTY_PRINT));
        }

        if (isset($_POST['mythology'])) {
            $mythology = $_POST['mythology'];
            echo "Mythology: $mythology <br>";

            $stmt = $dbCo->prepare("UPDATE characters SET story = :story, story_date = NOW() WHERE id_characters = :id");
            $stmt->bindParam(':story', $mythology);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                echo "Story updated successfully.";
            } else {
                echo "Error updating story.";
            }
        }
    }

    header('Location: card.php?id=' . $id);
    exit();
}

ob_end_flush();
?>