<?php
session_start();
include '../includes/_functions.php';
include '../includes/_database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Verify CSRF token
if (!isset($_POST['token']) || !isTokenOk($_POST)) {
    addError('csrf');
    header("Location: post.php?id=" . $_POST['topic_id']);
    exit();
}

// Check if user is an administrator
if ($_SESSION['role'] !== 'admin') {
    header("Location: post.php?id=" . $_POST['topic_id']);
    exit();
}

// Retrieve post ID from form
$post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
$topic_id = isset($_POST['topic_id']) ? (int) $_POST['topic_id'] : 0;

// Delete post from database
$stmt = $dbCo->prepare('DELETE FROM posts 
WHERE id = ?');
$stmt->execute([$post_id]);

header("Location: post.php?id=" . $topic_id);
exit();
?>