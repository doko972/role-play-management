<?php
session_start();
include '../includes/_functions.php';
include '../includes/_database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// CSRF Token Verification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      die('Invalid CSRF token');
    }

// Retrieve form data
$post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
$topic_id = isset($_POST['topic_id']) ? (int) $_POST['topic_id'] : 0;
$content = isset($_POST['content']) ? trim($_POST['content']) : '';

// Check if the user is allowed to edit this post
$stmt = $dbCo->prepare('SELECT user_id 
FROM posts 
WHERE id = ?');
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post || ($post['user_id'] != $_SESSION['user_id'] && $_SESSION['role'] !== 'admin')) {
    die('Vous n\'êtes pas autorisé à modifier ce post.');
}

// Update post content
$stmt = $dbCo->prepare('UPDATE posts 
SET content = ? 
WHERE id = ?');
$stmt->execute([$content, $post_id]);

header("Location: post.php?id=$topic_id");
exit();
}