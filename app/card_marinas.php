<?php
session_start();

include 'includes/_database.php';
include 'includes/_config.php';

// connecté ?
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 30;
$user_id = $_SESSION['user_id'];
$selected_card_id = null;
$story = null;

$min_id = 30;
$max_id = 40;

try {
  // carte sélectionnée par l'utilisateur
$stmt = $dbCo->prepare("SELECT * 
FROM img 
WHERE id_img = :id AND id_img BETWEEN :min_id AND :max_id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':min_id', $min_id, PDO::PARAM_INT);
$stmt->bindParam(':max_id', $max_id, PDO::PARAM_INT);
$stmt->execute();
$card = $stmt->fetch(PDO::FETCH_ASSOC);

// histoires pour la carte
$stmt = $dbCo->prepare("SELECT story, story_date, id_user, name, image 
FROM characters 
WHERE id_characters = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$stories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// carte sélectionnée par l'user
$stmt = $dbCo->prepare("SELECT selected_card 
FROM users 
WHERE id_user = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user) {
  $selected_card_id = $user['selected_card'];
}

// nom de la carte sélectionnée
$selected_card_name = '';
if ($selected_card_id !== null) {
  $stmt = $dbCo->prepare("SELECT name 
  FROM img 
  WHERE id_img = :selected_card_id");
  $stmt->bindParam(':selected_card_id', $selected_card_id, PDO::PARAM_INT);
  $stmt->execute();
  $selected_card = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($selected_card) {
    $selected_card_name = $selected_card['name'];
  }
}

// si histoire existe pour cette carte et l'user ?
foreach ($stories as $s) {
  if ($s['id_user'] == $user_id) {
    $story = $s;
    break;
  }
}

// Vérifier si la card est déjà prise
if ($card && $card['taken_by_user_id'] !== null && $card['taken_by_user_id'] != $user_id) {
  $error_message = $errors['card_no_free'];
}

} catch (PDOException $e) {
$error_message = $errors['update_ko'];
$card = null;
$stories = [];
}

// erreur de session
if (isset($_SESSION['error_message'])) {
$error_message = $_SESSION['error_message'];
unset($_SESSION['error_message']);
} else {
$error_message = '';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chevalier d'Hadès</title>
<link rel="icon" href="img/logo.ico">
<!-- <link rel="stylesheet" href="css/styles.css"> -->
<script type="module" src="http://localhost:5173/@vite/client"></script>
<script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
<?php include 'includes/header.php'; ?>
<main class="container">
  <div class="card-detail">
    <?php
    if ($card) {
      echo '<form action="marinas.php" method="get">';
      echo '<button type="submit" class="button__register" aria-label="Retour à l\'index">Retour à l\'index</button>';
      echo '</form>';

      if ($error_message) {
        echo '<p class="error-message">' . $error_message . '</p>';
      }

      echo '<img src="' . $card['file'] . '" alt="'
        . $card['alternatif_txt'] . '">'
        . '<div>'
        . '<p>' . $card['class'] . '</p>'
        . '<p>' . $card['name'] . '</p>';

      if (!empty($stories)) {
        foreach ($stories as $s) {
          echo '<div class="story" id="displayArea">'
            . '<p>Date de création de l\'histoire: ' . date('d-m-Y', strtotime($s['story_date'])) . '</p>'
            . '<p>Histoire:</p>'
            . '<p class="animate-text">' . $s['story'] . '</p>';
          if (!empty($s['image'])) {
            echo '<img src="' . $s['image'] . '" alt="Image de personnage">';
          }
          echo '</div>';
        }
      } else {
        echo '<p>' . $errors['story_empty'] . '</p>';
      }

      echo '</div>';

      if ($selected_card_id == $id) {
        echo '<p>Vous avez choisi : </p>' .
          '<p>' . htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') . '</p>';

        echo '<button id="editButton" onclick="toggleEdit()">Modifier</button>';

        echo '<form id="editForm" method="POST" action="story/story_marinas.php" enctype="multipart/form-data" style="display:none;">'
          . '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id_img'], ENT_QUOTES, 'UTF-8') . '">'
          . '<textarea name="story" placeholder="Raconter, ou corrigez votre histoire..." required>'
          . htmlspecialchars(isset($story['story']) ? $story['story'] : '', ENT_QUOTES, 'UTF-8') . '</textarea>'
          . '<br>'
          . '<label for="image">Téléchargez une image:</label>'
          . '<input type="file" id="image" name="image">'
          . '<br>'
          . '<button type="submit" class="btn-add-event--register">Valider</button>'
          . '</form>';
      } elseif ($selected_card_id !== null) { // nom de la carte déjà sélectionnée par l'user
        echo '<p>Vous avez déjà choisi le rôle de : ' . htmlspecialchars($selected_card_name, ENT_QUOTES, 'UTF-8') . '</p>';
      } elseif ($card['taken_by_user_id'] !== null) { // carte déjà prise par un autre utilisateur
        echo '<p>Cette carte est déjà prise par un autre utilisateur.</p>';
      } else {
        echo '<form method="POST" action="select_card_marinas.php">'
          . '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id_img'], ENT_QUOTES, 'UTF-8') . '">'
          . '<button type="submit" class="btn-add-event--register">Choisir cette carte</button>'
          . '</form>';
      }
    } else {
      echo '<p>' . $errors['card_not_find'] . '</p>';
    }
    ?>
  </div>
</main>
<script src="js/scripts.js"></script>
<script src="js/toggleEdit.js"></script>
<?php include 'includes/footer.php'; ?>
</body>

</html>