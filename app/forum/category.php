<?php
session_start();
include '../includes/_functions.php';
include '../includes/_database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Récupérer l'ID de la catégorie depuis l'URL
$category_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Récupérer les informations de la catégorie
$stmt = $dbCo->prepare('SELECT * FROM categories WHERE id = ?');
$stmt->execute([$category_id]);
$category = $stmt->fetch();

// Récupérer les sujets de la catégorie
$stmt = $dbCo->prepare('SELECT * FROM topics WHERE category_id = ?');
$stmt->execute([$category_id]);
$topics = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum Saint Seiya Online</title>
    <meta name="keywords"
        content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
    <meta name="description"
        content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
    <link rel="icon" href="../img/logo.ico">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
    <?php include 'headerForum.php'; ?>
    <header>
        <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
        <h1><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum Saint Seiya Online</h1>
    </header>
    <div class="forum-container">
        <div class="forum-category">
            <?php foreach ($topics as $topic): ?>
                <a
                    href="post.php?id=<?php echo htmlspecialchars($topic['id'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($topic['title'], ENT_QUOTES, 'UTF-8'); ?></a>
            <?php endforeach; ?>
            <a
                href="create_topic.php?category_id=<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">Créer
                un nouveau sujet</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>