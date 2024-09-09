<?php
session_start();
include 'includes/_functions.php';
include 'includes/_database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

// Mettre à jour l'activité de l'utilisateur
updateUserActivity($_SESSION['user_id'], $dbCo);

// Générer un token CSRF
generateToken();

// Récupérer les catégories
$stmt = $dbCo->query('SELECT id, name
FROM categories');
$categories = $stmt->fetchAll();

// Catégories en sections
$supportCategories = array_slice($categories, 0, 3); // Support et discussions générales
$factionCategories = array_slice($categories, 3, 3); // Salon par faction

// Récupérer les utilisateurs connectés avec la fonction getOnlineUsers();
$onlineUsers = getOnlineUsers($dbCo);


// Récupérer les sujets récents
$recentTopicsStmt = $dbCo->prepare('SELECT id, category_id, title, created_at 
FROM topics 
WHERE created_at >= NOW() - INTERVAL 1 DAY');
$recentTopicsStmt->execute();
$recentTopics = $recentTopicsStmt->fetchAll(PDO::FETCH_ASSOC);

// Créer un tableau pour les catégories récentes
$recentTopicsByCategory = [];
foreach ($recentTopics as $topic) {
  $recentTopicsByCategory[$topic['category_id']][] = $topic;
}
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
<?php include 'includes/header.php'; ?>
  <main>
    <section>
      <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
    </section>
    <div class="forum-container">
      <div class="forum-section-title">Support et discussions générales</div>
      <div class="forum-category">
        <?php foreach ($supportCategories as $category): ?>
          <a href="forum/category.php?id=<?php echo $category['id']; ?>">
            <?php echo htmlspecialchars($category['name']); ?>
            <?php if (isset($recentTopicsByCategory[$category['id']])): ?>
              <span class="new-badge">Nouveau</span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>

      <div class="forum-section-title">Salon par faction</div>
      <div class="forum-category">
        <?php foreach ($factionCategories as $category): ?>
          <a href="forum/category.php?id=<?php echo $category['id']; ?>">
            <?php echo $category['name']; ?>
            <?php if (isset($recentTopicsByCategory[$category['id']])): ?>
              <span class="new-badge">Nouveau</span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>

      <div class="forum-section-title">Qui est en ligne?</div>
      <div class="online-users">
          <?php
          if (!empty($onlineUsers)) {
            //extrait toutes les valeurs de la colonne 'login' dans le tableau $onlineUsers.
              $usernames = array_column($onlineUsers, 'login');
              //implode(', ', ...) transforme le tableau $usernames en une chaîne de caractères, 
              //où chaque nom d'utilisateur est séparé par une virgule et un espace
              echo implode(', ', array_map('htmlspecialchars', $usernames));
          } else {
              echo $message['not_user_in_line'];
          }
          ?>
      </div>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
  <script src="js/script.js"></script>
</body>

</html>