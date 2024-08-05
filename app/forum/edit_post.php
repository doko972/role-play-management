<?php
session_start();
include '../includes/_functions.php';
include '../includes/_database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Vérification du token CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        die('Invalid CSRF token');
    }

    // Protection XSS
    $content = sanitizeInput($_POST['content']);
    $post_id = (int)$_POST['post_id'];
    $topic_id = (int)$_POST['topic_id'];
    $user_id = $_SESSION['user_id'];
    
    // Vérifier que l'utilisateur est l'auteur du post ou un administrateur
    $stmt = $dbCo->prepare('SELECT user_id FROM posts WHERE id = ?');
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();
    
    if (!$post || ($post['user_id'] != $user_id && $_SESSION['role'] !== 'admin')) {
        die('Permission denied');
    }

    // Gestion de l'image
    $imagePath = null;
    $image_id = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = '../uploads/';
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            // Insérer l'image dans la table img
            $stmt = $dbCo->prepare('INSERT INTO img (file, name, class, alternatif_txt, id_faction) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$imagePath, $imageName, '', '', 1]); // 1 est l'id_faction par défaut
            $image_id = $dbCo->lastInsertId();
        }
    }

    // Mettre à jour le post dans la base de données
    if ($image_id) {
        $stmt = $dbCo->prepare('UPDATE posts SET content = ?, image_id = ? WHERE id = ?');
        $stmt->execute([$content, $image_id, $post_id]);
    } else {
        $stmt = $dbCo->prepare('UPDATE posts SET content = ? WHERE id = ?');
        $stmt->execute([$content, $post_id]);
    }
    
    header('Location: post.php?id=' . $topic_id);
    exit();
}
?>