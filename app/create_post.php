<?php
include 'includes/_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = sanitizeInput($_POST['content']);
    $topic_id = (int)$_POST['topic_id'];
    $stmt = $dbCo->prepare('INSERT INTO posts (content, topic_id) VALUES (?, ?)');
    $stmt->execute([$content, $topic_id]);
    header('Location: post.php?id=' . $topic_id);
    exit();
}
?>