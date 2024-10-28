<?php
session_start();
include '../includes/_functions.php';
include '../includes/_database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// CSRF Token Verification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        die('Invalid CSRF token');
    }

    // XSS Protection
    $content = sanitizeInput($_POST['content']);
    $topic_id = (int) $_POST['topic_id'];
    $user_id = $_SESSION['user_id'];

    // Image management
    $imagePath = null;
    $image_id = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = '../uploads/';
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            // Insert image into img table
            $stmt = $dbCo->prepare('INSERT INTO img (file, name, class, alternatif_txt, id_faction) 
            VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$imagePath, $imageName, '', '', 1]); // 1 is the default id_faction
            $image_id = $dbCo->lastInsertId();
        }
    }

    // Insert post into database
    $stmt = $dbCo->prepare('INSERT INTO posts (content, topic_id, user_id, image_id) 
    VALUES (?, ?, ?, ?)');
    $stmt->execute([$content, $topic_id, $user_id, $image_id]);

    header('Location: post.php?id=' . $topic_id);
    exit();
}
?>