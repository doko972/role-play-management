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
  <title>Spectres d'Hadès</title>
  <link rel="icon" href="img/logo.ico">
  <!-- <link rel="stylesheet" href="css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <main>
    <div class="head-card" role="img" aria-label="Image de tête de carte"></div>
    <h1 class="texte-position">Choissisez:</h1>
    <div class="container">
      <?php
      try {
        $stmt = $dbCo->prepare("SELECT * FROM img WHERE id_img BETWEEN 50 AND 63");
        $stmt->execute();
        $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($cards) {
          foreach ($cards as $card) {
            $stmt2 = $dbCo->prepare("SELECT story FROM characters 
            WHERE id_characters = :id");
            $stmt2->bindParam(':id', $card['id_img']);
            $stmt2->execute();
            $character = $stmt2->fetch(PDO::FETCH_ASSOC);



            echo '<div class="card">'
              . '<a href="card_spectres.php?id=' . $card['id_img'] . '">'
              . '<img src="' . $card['file'] . '" alt="' . $card['alternatif_txt'] . '">';

              if ($card['taken_by_user_id'] !== null) {
                echo '<div class="taken-container">'
                . ' <p class="taken"></p>'
                . ' <p>Pris</p>'
                .  '</div>'
                . ' <p>' . $card['name'] . '</p>';


            } else {
                echo '<div class="taken-container">'
                . ' <p class="taken_free"></p>'
                . ' <p>Libre</p>'
                .  '</div>'
                . ' <p>' . $card['name'] . '</p>';
            }

            echo '</div>';
          }
        } else {
          echo '<p>' . $messages['not_find_card'] .'</p>';
        }
      } catch (PDOException $e) {
        echo '<p>' . $errors['update_ko'] . '</p>';
      }
      ?>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>

</html>