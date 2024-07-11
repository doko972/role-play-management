<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choix de classe Spectres</title>
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php include 'header.php'; ?>
  <main>
    <div class="head-card" role="img" aria-label="Image du Guerrier"> </div>
    <div class="container">
      <?php
      $json = file_get_contents('json/spectres.json');
      $cards = json_decode($json, true);

      if ($cards) {
        foreach ($cards as $card) {
          echo '<div class="card">';
          echo '<a href="card3.php?id=' . htmlspecialchars($card['id'], ENT_QUOTES, 'UTF-8') . '">';
          echo '<img src="' . htmlspecialchars($card['image'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') . '">';
          echo '<p>' . htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') . '</p>';
          echo '</a>';
          echo '</div>';
          error_log('Link generated: card3.php?id=' . htmlspecialchars($card['id'], ENT_QUOTES, 'UTF-8'));
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