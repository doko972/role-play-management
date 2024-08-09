<?php
session_start();
include '../includes/_functions.php';
include '../includes/_database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Generate CSRF token
generateToken();

// Récupérer l'ID du sujet depuis l'URL
$topic_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Récupérer les informations du sujet
$stmt = $dbCo->prepare('SELECT * FROM topics WHERE id = ?');
$stmt->execute([$topic_id]);
$topic = $stmt->fetch();

// Récupérer les posts du sujet avec les informations de l'utilisateur et de l'image
$stmt = $dbCo->prepare('
    SELECT posts.*, users.login, img.file 
    FROM posts 
    JOIN users ON posts.user_id = users.id_user 
    LEFT JOIN img ON posts.image_id = img.id_img 
    WHERE topic_id = ? 
    ORDER BY created_at ASC
');
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
    <link rel="icon" href="../img/logo.ico">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/scripts.js"></script>
    <script src="../js/toggleEditForm.js"></script>
    <style>
        .editForm {
            display: none;
        }
    </style>
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
        <section class="forum-container">
            <?php foreach ($posts as $post): ?>
                <div class="new-post">
                    <p><?php echo nl2br(htmlspecialchars_decode($post['content'])); ?></p>
                    <!--nl2br — Insère un retour à la ligne HTML à chaque nouvelle ligne-->
                    <?php if ($post['file']): ?>
                        <p><img class="forum-img" src="<?php echo htmlspecialchars($post['file']); ?>" alt="Image posté"></p>
                    <?php endif; ?>
                    <p class="post-time"><?php echo htmlspecialchars($post['created_at']); ?></p>
                    <p class="post-user">Posté par : <?php echo htmlspecialchars($post['login']); ?></p>

                    <!-- EDIT POST (only for the author or admin) -->
                    <?php if ($_SESSION['user_id'] === $post['user_id'] || $_SESSION['role'] === 'admin'): ?>
                        <form id="editForm-<?php echo $post['id']; ?>" class="editForm" action="edit_post.php" method="post">
                            <textarea name="content" rows="4"><?php echo htmlspecialchars($post['content']); ?></textarea>
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                            <input type="hidden" name="token"
                                value="<?php echo htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit">Sauvegarder</button>
                        </form>
                        <div class="editForm_alg">
                            <button class="editForm_alg-mg" onclick="toggleEditForm('<?php echo $post['id']; ?>')">Modifier</button>
                        </div>
                    <?php endif; ?>

                    <!-- DELETE POST -->
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <form action="delete_post.php" method="post"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                            <input type="hidden" name="token"
                                value="<?php echo htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit">Supprimer le Post</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="new-post">
                <!-- CREATE POST -->
                <form action="create_post.php" method="post" enctype="multipart/form-data">
                    <textarea name="content" rows="4" required></textarea>
                    <input type="hidden" name="topic_id"
                        value="<?php echo htmlspecialchars($topic['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="token"
                        value="<?php echo htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
                    <label for="image">Télécharger une image :</label>
                    <input type="file" name="image" id="image" accept="image/*" multiple>
                    <button type="submit">Ajouter un post</button>
                </form>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>