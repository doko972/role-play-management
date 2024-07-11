<?php
ob_start(); // Démarre la mise en tampon de sortie
session_start();

include 'includes/_database.php';

// Utilisateur est connecté?
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$user_id = $_SESSION['user_id'];

// ID de la carte choisie par l'utilisateur
$stmt = $dbCo->prepare("SELECT selected_card FROM users WHERE id_user = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$selected_card_id = $user['selected_card'];

$json = file_get_contents('json/saints.json');
$cards = json_decode($json, true);
$card = null;

foreach ($cards as $c) {
  if ($c['id'] == $id) {
    $card = $c;
    break;
  }
}

// Récupérer toutes les histoires pour la carte spécifique
$stmt = $dbCo->prepare("SELECT story, story_date, id_user FROM characters WHERE id_characters = :id");
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $errorInfo = $stmt->errorInfo();
    var_dump($errorInfo);
}

// Message d'erreur de session
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);

$card_name = $card['name'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chevalier d'Athena</title>
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php include 'header.php'; ?>
  <main class="container">
    <div class="card-detail">
      <?php
      if ($card) {
        echo '<form action="saint.php" method="get">';
        echo '<button type="submit" class="button__register" aria-label="Retour à l\'index">Retour à l\'index</button>';
        echo '</form>';

        if ($error_message) {
          echo '<p class="error-message">' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</p>';
        }

        echo '<img src="' . htmlspecialchars($card['image'] ?? '', ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
        . '<div>'
        . '<h1>' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '</h1>'
        . '<p>Class: ' . htmlspecialchars($card['class'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>'
        . '<p>SSO: ' . htmlspecialchars($card['sso'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>'
        . '<img src="' . htmlspecialchars($card['imagesso2'] ?? '', ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . ' SSO">'
        . '<p>Titre: ' . htmlspecialchars($card['title'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';

        if (!empty($stories)) {
          foreach ($stories as $story) {
            echo '<div class="story">'
            . '<p class="animate-text">Histoire:</p><p>' . htmlspecialchars_decode($story['story']) . '</p>'
            . '<p>Date de création de l\'histoire: ' . htmlspecialchars($story['story_date'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>'
            // echo '<p>Utilisateur: ' . htmlspecialchars($story['id_user'], ENT_QUOTES, 'UTF-8') . '</p>';
            . '</div>';
          }
        } else {
          echo '<p>Aucune histoire trouvée pour cette carte.</p>';
        }

        echo '</div>';

        if ($selected_card_id == $id) {
          echo '<p>Vous avez choisi : </p>' . 
          '<p>' . htmlspecialchars($card['class'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';

          echo '<form method="POST" action="submit_story.php">'
          . '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
          . '<textarea name="story" placeholder="Raconter votre histoire..." required></textarea>'
          . '<button type="submit" class="btn-add-event--register">Soumettre votre histoire</button>'
          . '</form>';
        } else {
          echo '<form method="POST" action="select_card.php">'
          . '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
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
  <script src="js/accordeon.js"></script>
  <?php include 'footer.php'; ?>
</body>

</html>
<?php
ob_end_flush();
?>