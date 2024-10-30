<?php
session_start();
include 'includes/_database.php';
include 'includes/_config.php';

// connecté ?
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 50;
$user_id = $_SESSION['user_id'];
$selected_card_id = null;
$story = null;

$min_id = 50;
$max_id = 70;

try {
  // user selected card
  $stmt = $dbCo->prepare("SELECT id_img, file, name, class, id_faction, alternatif_txt, taken_by_user_id 
  FROM img 
  WHERE id_img = :id AND id_img BETWEEN :min_id AND :max_id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':min_id', $min_id, PDO::PARAM_INT);
  $stmt->bindParam(':max_id', $max_id, PDO::PARAM_INT);
  $stmt->execute();
  $card = $stmt->fetch(PDO::FETCH_ASSOC);

  // stories for the card
  $stmt = $dbCo->prepare("SELECT story, story_date, id_user, name, image 
  FROM characters 
  WHERE id_characters = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // user selected card
  $stmt = $dbCo->prepare("SELECT selected_card 
  FROM users 
  WHERE id_user = :user_id");
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    $selected_card_id = $user['selected_card'];
  }

  // name of the selected card
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

  // if there is a story for this card and its user?
  foreach ($stories as $s) {
    if ($s['id_user'] == $user_id) {
      $story = $s;
      break;
    }
  }

  // Check if the card is already taken
  if ($card && $card['taken_by_user_id'] !== null && $card['taken_by_user_id'] != $user_id) {
    $error_message = $errors['card_no_free'];
  }

} catch (PDOException $e) {
  $error_message = $errors['update_ko'];
  $card = null;
  $stories = [];
}

// session error
if (isset($_SESSION['error_message'])) {
  $error_message = $_SESSION['error_message'];
  unset($_SESSION['error_message']);
} else {
  $error_message = '';
}

function vite($entry)
{
  $manifestPath = __DIR__ . '/dist/manifest.json';
  if (file_exists($manifestPath)) {
    $manifest = json_decode(file_get_contents($manifestPath), true);
    return "/dist/" . $manifest[$entry]['file'];
  }
  return "http://localhost:5173/" . $entry;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chevalier d'Hadès</title>
  <link rel="icon" href="img/logo.ico">
  <script type="module" src="<?php echo vite('@vite/client'); ?>"></script>
  <script type="module" src="<?php echo vite('js/scripts.js'); ?>"></script>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <main class="container">
    <div class="card-detail">
      <?php
      if ($card) {
        echo '<form action="spectres.php" method="get">';
        echo '<button type="submit" class="button__register" aria-label="Retour à l\'index">Retour à l\'index</button>';
        echo '</form>';

        if ($error_message) {
          echo '<p class="error-message">' . $error_message . '</p>';
        }

        echo '<img src="' . $card['file'] . '" alt="' . $card['alternatif_txt'] . '">';
        echo '<div><p>' . $card['name'] . '</p><p>' . $card['class'] . '</p>';

        if (!empty($stories)) {
          foreach ($stories as $s) {
            echo '<div class="story" id="displayArea">';
            echo '<p>Date de création de l\'histoire: ' . date('d-m-Y', strtotime($s['story_date'])) . '</p>';
            if (!empty($s['image'])) {
              echo '<img src="' . $s['image'] . '" alt="Image de personnage">';
            }
            echo '<p>Histoire:</p>';
            echo '<p class="animate-text">' . html_entity_decode($s['story']) . '</p>';
            echo '</div>';
          }
        } else {
          echo '<p>' . $errors['story_empty'] . '</p>';
        }

        echo '</div>';

        if ($selected_card_id == $id) {
          echo '<button class="button__register" id="editButton" onclick="toggleEdit()">Modifier</button>';

          echo '<form id="editForm" method="POST" action="story/story_spectres.php" enctype="multipart/form-data" style="display:none;">';
          echo '<input type="hidden" name="card_id" value="' . htmlspecialchars($card['id_img'], ENT_QUOTES, 'UTF-8') . '">';
          echo '<textarea name="story" placeholder="Raconter, ou corrigez votre histoire..." required>';
          echo htmlspecialchars(isset($story['story']) ? $story['story'] : '', ENT_QUOTES, 'UTF-8') . '</textarea>';
          echo '<br><label for="image">Téléchargez une image:</label><input type="file" id="image" name="image"><br>';
          echo '<button type="submit" class="btn-add-event--register">Valider</button>';
          echo '</form>';
        } elseif ($selected_card_id !== null) {
          echo '<p>Vous êtes : ' . $selected_card_name . '</p>';
        } elseif ($card['taken_by_user_id'] !== null) {
          echo '<p>Cette carte est déjà prise par un autre utilisateur.</p>';
        } else {
          echo '<form method="POST" action="select_card_spectres.php">';
          echo '<input type="hidden" name="card_id" value="' . $card['id_img'] . '">';
          echo '<button type="submit" class="btn-add-event--register">Choisir cette carte</button>';
          echo '</form>';
        }
      } else {
        echo '<p>' . $errors['card_not_find'] . '</p>';
      }
      ?>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
