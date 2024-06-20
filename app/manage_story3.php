<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('json/spectres.json');
    $cards = json_decode($json, true);

    $id = intval($_POST['id']);
    $action = $_POST['action'];
    $uploadDirectory = 'uploads/';
    $uploadedFilePath = '';

    // Gérer le téléchargement du fichier
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] != UPLOAD_ERR_NO_FILE) {
        if ($_FILES['new_image']['error'] == UPLOAD_ERR_OK) {
            $uploadedFileName = basename($_FILES['new_image']['name']);
            $uploadedFilePath = $uploadDirectory . $uploadedFileName;
            $fileType = mime_content_type($_FILES['new_image']['tmp_name']);

            // Vérifier si le type de fichier est accepté
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($fileType, $allowedTypes)) {
                die('Type de fichier non autorisé. Seules les images JPEG, PNG et WebP sont autorisées.');
            }

            // Vérifier que le répertoire de destination existe
            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            // Déplacer le fichier téléchargé dans le répertoire de destination
            if (!move_uploaded_file($_FILES['new_image']['tmp_name'], $uploadedFilePath)) {
                die('Erreur lors du téléchargement du fichier. Vérifiez les permissions du répertoire de destination.');
            }
        } else {
            die('Erreur de téléchargement du fichier : ' . $_FILES['new_image']['error']);
        }
    }

    foreach ($cards as &$card) {
        if ($card['id'] == $id) {
            if ($action == 'create') {
                if (!isset($card['mythology']) && !empty($_POST['mythology'])) {
                    $card['mythology'] = $_POST['mythology'];
                }

                if (!isset($card['mythology1']) && !empty($_POST['mythology1'])) {
                    $card['mythology1'] = $_POST['mythology1'];
                }

                if (!isset($card['mythology2']) && !empty($_POST['mythology2'])) {
                    $card['mythology2'] = $_POST['mythology2'];
                }

                if ($uploadedFilePath) {
                    $card['image'] = $uploadedFilePath;
                }
            } elseif ($action == 'update') {
                if (isset($_POST['mythology'])) {
                    $card['mythology'] = $_POST['mythology'];
                }

                if (isset($_POST['mythology1'])) {
                    $card['mythology1'] = $_POST['mythology1'];
                }

                if (isset($_POST['mythology2'])) {
                    $card['mythology2'] = $_POST['mythology2'];
                }

                if ($uploadedFilePath) {
                    $card['image'] = $uploadedFilePath;
                }
            }
            break;
        }
    }

    file_put_contents('json/spectres.json', json_encode($cards, JSON_PRETTY_PRINT));
    header('Location: card3.php?id=' . $id);
    exit();
}
?>