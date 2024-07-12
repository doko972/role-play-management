<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

include 'includes/_database.php';
include 'includes/_functions.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chevaliers d'Athéna</title>
  <link rel="icon" href="img/logo.ico">
  <!-- <link rel="stylesheet" href="css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
  <?php include 'header.php'; ?>
  <main>
    <div class="head-card" role="empty" aria-label="Champs vide">
    </div>
    <h1 class="texte-position">Choissisez:</h1>
    <div class="container">
      <?php

      //INSERT INTO `img`(`id_img`, `file`, `name`, `class`, `alternatif_txt`) 
      // VALUES (3,'img/gold/cancer.jpg','Cancer','Chevalier d\'Or du Cancer','Image du chevalier d\or du Cancer'),
      // $json = file_get_contents('json/saints.json');
      // $cards = json_decode($json, true);
      $cards = $dbCo->prepare("SELECT file FROM img WHERE id_img = :id");
      $cards->bindParam(':id', $card['id']);
      $cards->execute();

      if ($cards) {
        foreach ($cards as $card) {
          $stmt = $dbCo->prepare("SELECT story FROM characters WHERE id_characters = :id");
          $stmt->bindParam(':id', $card['id']);
          $stmt->execute();
          $character = $stmt->fetch(PDO::FETCH_ASSOC);

          echo '<div class="card">'
            . '<a href="card.php?id=' . htmlspecialchars($card['id'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
            . '<img src="' . htmlspecialchars($card['file'] ?? '', ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
            . '<p>' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>'
            . '</a>'
            . '</div>';
          error_log('Link generated: card.php?id=' . htmlspecialchars($card['id'] ?? '', ENT_QUOTES, 'UTF-8'));
        }
      } else {
        echo '<p>Aucune carte trouvée.</p>';
      }
      ?>
    </div>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>