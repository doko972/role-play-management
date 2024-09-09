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
$stmt = $dbCo->prepare('SELECT id, name
FROM categories 
WHERE id = ?');
$stmt->execute([$category_id]);
$category = $stmt->fetch();

// Récupérer les sujets de la catégorie
$stmt = $dbCo->prepare('SELECT id, title, category_id, created_at
FROM topics 
WHERE category_id = ?');
$stmt->execute([$category_id]);
$topics = $stmt->fetchAll();

// Récupérer les sujets récents
$recentTopicsStmt = $dbCo->prepare('SELECT id, title, created_at 
FROM topics 
WHERE category_id = ? AND created_at >= NOW() - INTERVAL 1 DAY');
$recentTopicsStmt->execute([$category_id]);
$recentTopics = $recentTopicsStmt->fetchAll(PDO::FETCH_ASSOC);

// Créer un tableau pour les sujets récents
$recentTopicIds = array_column($recentTopics, 'id');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $category['name']; ?> - Forum Saint Seiya Online</title>
    <meta name="keywords"
        content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
    <meta name="description"
        content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
    <link rel="icon" href="../img/logo.ico">
    <!-- <link rel="stylesheet" href="../css/styles.css"> -->
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
<?php include '../includes/header.php'; ?>
    <header>
        <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
        <h1><?php echo $category['name']; ?> - Forum Saint Seiya Online</h1>
    </header>
    <div class="forum-container">
        <div class="forum-category">
            <?php foreach ($topics as $topic): ?>
                <div>
                    <a href="post.php?id=<?php echo $topic['id']; ?>">
                        <?php echo $topic['title']; ?>

                        <?php if (in_array($topic['id'], $recentTopicIds)): ?>
                            <span class="new-badge">Nouveau</span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>
            <a
                href="create_topic.php?category_id=<?php echo $category['id']; ?>">
                Créer un nouveau sujet</a>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>