<?php
session_start();
include 'includes/_functions.php';
include 'includes/_database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Generate CSRF token
generateToken();


// Récupérer les catégories
$stmt = $dbCo->query('SELECT * FROM categories');
$categories = $stmt->fetchAll();

// catégories en sections
$supportCategories = array_slice($categories, 0, 3); // Support et discussions générales
$factionCategories = array_slice($categories, 3, 3); // Salon par faction
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forum Saint Seiya Online</title>
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
  <?php include 'forum/headerForum.php'; ?>
  <main>
    <section>
      <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
    </section>
    <div class="forum-container">
      <div class="forum-section-title">Support et discussions générales</div>
      <div class="forum-category">
        <?php foreach ($supportCategories as $category): ?>
          <a href="forum/category.php?id=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a>
        <?php endforeach; ?>
      </div>

      <div class="forum-section-title">Salon par faction</div>
      <div class="forum-category">
        <?php foreach ($factionCategories as $category): ?>
          <a href="forum/category.php?id=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a>
        <?php endforeach; ?>
      </div>

      <div class="forum-section-title">Qui est en ligne?</div>
      <div class="online-users">
        <p>Johny, Billy, Antoinette</p>
      </div>
    </div>
  </main>
  <?php include 'footer.php'; ?>
  <script src="js/script.js"></script>
</body>

</html>