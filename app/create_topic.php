<?php
include 'includes/_functions.php';

// Récupérer l'ID de la catégorie depuis l'URL
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitizeInput($_POST['title']);
    $stmt = $dbCo->prepare('INSERT INTO topics (title, category_id) VALUES (?, ?)');
    $stmt->execute([$title, $category_id]);
    header('Location: category.php?id=' . $category_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Creer un seujet Saint Seiya Online</title>
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
  <header>
    <h1>Créer un nouveau sujet - Forum Saint Seiya Online</h1>
  </header>
  <div class="forum-container">
    <form action="" method="post">
      <div class="form-group">
        <label class="title-color" for="title">Titre du sujet</label>
        <input type="text" id="title" name="title" required>
      </div>
      <div class="form-group">
        <button type="submit">Créer</button>
      </div>
    </form>
  </div>
</body>

</html>