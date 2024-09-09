<?php
session_start();
include '../includes/_functions.php';
include '../includes/_database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Vérifier le token CSRF
if (!isset($_POST['token']) || !isTokenOk($_POST)) {
    addError('csrf');
    header("Location: post.php?id=" . $_POST['topic_id']);
    exit();
}

// Vérifier si l'utilisateur est un administrateur
if ($_SESSION['role'] !== 'admin') {
    header("Location: post.php?id=" . $_POST['topic_id']);
    exit();
}

// Récupérer l'ID du post depuis le formulaire
$post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
$topic_id = isset($_POST['topic_id']) ? (int) $_POST['topic_id'] : 0;

// Supprimer le post de la base de données
$stmt = $dbCo->prepare('DELETE FROM posts 
WHERE id = ?');
$stmt->execute([$post_id]);

header("Location: post.php?id=" . $topic_id);
exit();
?>