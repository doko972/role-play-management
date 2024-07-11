<?php
ob_start(); // Démarre la mise en tampon de sortie
session_start();
include 'includes/_database.php'; // Assurez-vous que ce fichier contient la connexion à votre base de données

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$user_id = $_SESSION['user_id']; // Assurez-vous que l'utilisateur est connecté

// Récupérer l'ID de la carte choisie par l'utilisateur
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

$stmt = $dbCo->prepare("SELECT story, story_date FROM characters WHERE id_characters = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$character = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer le message d'erreur de session
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']); // Supprimer le message d'erreur après l'affichage
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

        echo '<img src="' . htmlspecialchars($card['image'] ?? '', ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '">';
        echo '<div>';
        echo '<h1>' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '</h1>';
        echo '<p>Class: ' . htmlspecialchars($card['class'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>SSO: ' . htmlspecialchars($card['sso'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<img src="' . htmlspecialchars($card['imagesso2'] ?? '', ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . ' SSO">';
        echo '<p>Title: ' . htmlspecialchars($card['title'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
        if (isset($character['story'])) {
          echo '<p class="animate-text">Histoire: ' . htmlspecialchars($character['story'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
          echo '<p>Date de création de l\'histoire: ' . htmlspecialchars($character['story_date'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
        }
        echo '</div>';

        if ($selected_card_id == $id) {
            echo '<p>Cette carte a été choisie : ' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
        } else {
            // Form to select this card
            echo '<form method="POST" action="select_card.php">';
            echo '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id'] ?? '', ENT_QUOTES, 'UTF-8') . '">';
            echo '<button type="submit" class="btn-add-event--register">Choisir cette carte</button>';
            echo '</form>';
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
ob_end_flush(); // Envoie la sortie tamponnée et désactive la mise en tampon de sortie
?>