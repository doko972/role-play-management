<?php
session_start();

include 'includes/_database.php';

define('MIN_ID', 30);
define('MAX_ID', 40);

// Utilisateur est connecté?
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$user_id = $_SESSION['user_id'];

try {
    // ID de la carte choisie par l'utilisateur
    $stmt = $dbCo->prepare("SELECT selected_card FROM users WHERE id_user = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $selected_card_id = $user['selected_card'];

    // Variables pour les constantes
    $min_id = MIN_ID;
    $max_id = MAX_ID;

    // Récupérer les informations de la carte depuis la base de données avec filtre BETWEEN
    $stmt = $dbCo->prepare("SELECT * FROM img WHERE id_img = :id AND id_img BETWEEN :min_id AND :max_id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':min_id', $min_id);
    $stmt->bindParam(':max_id', $max_id);
    $stmt->execute();
    $card = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer toutes les histoires pour la carte spécifique
    $stmt = $dbCo->prepare("SELECT story, story_date, id_user FROM characters WHERE id_characters = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error_message = 'Erreur : ' . $e->getMessage();
    $card = null;
    $stories = [];
}

// Message d'erreur de session
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chevalier d'Athena</title>
  <link rel="icon" href="img/logo.ico">
  <!-- <link rel="stylesheet" href="css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
  <?php include 'header.php'; ?>
  <main class="container">
    <div class="card-detail">
      <?php
      if ($card) {
        echo '<form action="marinas.php" method="get">';
        echo '<button type="submit" class="button__register" aria-label="Retour à l\'index">Retour à l\'index</button>';
        echo '</form>';

        if ($error_message) {
          echo '<p class="error-message">' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</p>';
        }

        echo '<img src="' . htmlspecialchars($card['file'] ?? '', ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['alternatif_txt'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
        . '<div>'
        . '<p>Faction: ' . htmlspecialchars($card['class'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>'
        . '<p>' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';

        if (!empty($stories)) {
          foreach ($stories as $story) {
            echo '<div class="story">'
            . '<p>Date de création de l\'histoire: ' . date('d-m-Y', strtotime($story['story_date'])) . '</p>'
            . '<p>Histoire:</p>'
            . '<p class="animate-text">' . htmlspecialchars($story['story'], ENT_QUOTES, 'UTF-8') . '</p>'
            . '</div>';
          }
        } else {
          echo '<p>Aucune histoire trouvée pour cette carte.</p>';
        }

        echo '</div>';

        if ($selected_card_id == $id) {
          echo '<p>Vous avez choisi : </p>' . 
          '<p>' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';

          echo '<form method="POST" action="story_marinas.php">'
          . '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id_img'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
          . '<textarea name="story" placeholder="Raconter, ou corrigez votre histoire..." required></textarea>'
          . '<button type="submit" class="btn-add-event--register">Valider</button>'
          . '</form>';
        } else {
          echo '<form method="POST" action="select_card_marinas.php">'
          . '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id_img'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
          . '<button type="submit" class="btn-add-event--register">Choisir cette carte</button>'
          . '</form>';
        }
      } else {
        echo '<p>Carte non trouvée.</p>';
      }
      ?>
    </div>
  </main>
  <script src="js/scripts.js"></script>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php
?>