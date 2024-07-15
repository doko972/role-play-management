<?php
include 'includes/_functions.php';

// Récupérer l'ID du sujet depuis l'URL
$topic_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Récupérer les informations du sujet
$stmt = $dbCo->prepare('SELECT * FROM topics WHERE id = ?');
$stmt->execute([$topic_id]);
$topic = $stmt->fetch();

// Récupérer les posts du sujet
$stmt = $dbCo->prepare('SELECT * FROM posts WHERE topic_id = ? ORDER BY created_at ASC');
$stmt->execute([$topic_id]);
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($topic['title']); ?> - Forum Saint Seiya Online</title>
    <meta name="keywords"
        content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
    <meta name="description"
        content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
    <link rel="icon" href="img/logo.ico">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
    <?php include 'headerForum.php'; ?>
    <main>

        <section>
            <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
        </section>
        <section>
            <h1>Forum Saint Seiya Online</h1>
            <h2 class="title-post"><?php echo htmlspecialchars($topic['title']); ?></h2>
        </section>

        <div class="forum-container">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <p class="post-time"><?php echo $post['created_at']; ?></p>
                </div>
            <?php endforeach; ?>
            <div class="new-post">
                <form action="create_post.php" method="post">
                    <textarea name="content" rows="4" required></textarea>
                    <input type="hidden" name="topic_id" value="<?php echo $topic['id']; ?>">
                    <button type="submit">Ajouter un post</button>
                </form>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>