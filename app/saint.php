<?php
session_start();
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
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <div class="head-card" role="img" aria-label="Image de tête de carte"></div>
    <div class="container">
      <?php
      $json = file_get_contents('json/saints.json');
      $cards = json_decode($json, true);

      if ($cards) {
        foreach ($cards as $card) {
          $stmt = $dbCo->prepare("SELECT story FROM characters WHERE id_characters = :id");
          $stmt->bindParam(':id', $card['id']);
          $stmt->execute();
          $character = $stmt->fetch(PDO::FETCH_ASSOC);

          echo '<div class="card">'
          . '<a href="card.php?id=' . htmlspecialchars($card['id'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
          . '<img src="' . htmlspecialchars($card['image'] ?? '', ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'] ?? '', ENT_QUOTES, 'UTF-8') . '">'
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