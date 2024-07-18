<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/_database.php';

$error_message = '';
$success_message = '';
$card_id = isset($_GET['card_id']) ? intval($_GET['card_id']) : 0;
$faction_id = isset($_GET['faction_id']) ? intval($_GET['faction_id']) : 0;
$image_path = '';
$card_name = '';

if ($card_id > 0) {
    $stmt = $dbCo->prepare("SELECT name, file FROM img WHERE id_img = :card_id");
    $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
    $stmt->execute();
    $card = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($card) {
        $card_name = $card['name'] ? htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') : '';
        $image_path = $card['file'] ? htmlspecialchars($card['file'], ENT_QUOTES, 'UTF-8') : '';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $story = htmlspecialchars($_POST['story'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['user_id'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowed_extensions)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                try {
                    $stmt = $dbCo->prepare("INSERT INTO characters (id_characters, name, story, story_date, main_charc, id_faction, id_user, image) VALUES (:card_id, :name, :story, NOW(), 1, :faction_id, :user_id, :image)");
                    $stmt->bindParam(':card_id', $card_id, PDO::PARAM_INT);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':story', $story);
                    $stmt->bindParam(':faction_id', $faction_id);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':image', $target_file);
                    $stmt->execute();

                    // Rediriger vers la page d'accueil après la création du personnage
                    header("Location: index.php");
                    exit();
                } catch (PDOException $e) {
                    $error_message = 'Erreur : ' . $e->getMessage();
                }
            } else {
                $error_message = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        } else {
            $error_message = "Désolé, seules les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        }
    } else {
        $error_message = "Le fichier n'est pas une image.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer votre personnage</title>
    <link rel="icon" href="img/logo.ico">
  <!-- <link rel="stylesheet" href="css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container">
        <h1>Créez votre fiche de personnage RP/PVP</h1>

        <?php
        if ($error_message) {
            echo '<p class="error-message">' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</p>';
        }
        if ($success_message) {
            echo '<p class="success-message">' . htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8') . '</p>';
        }
        ?>

        <form action="create_character.php?card_id=<?php echo $card_id; ?>&faction_id=<?php echo $faction_id; ?>" method="post" enctype="multipart/form-data">
            <label for="name">Nom RP/PVP:</label>
            <input type="text" id="name" name="name" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>

            <label for="story">Entrez votre histoire:</label>
            <textarea id="story" name="story" rows="10" required></textarea>

            <input type="hidden" name="faction_id" value="<?php echo htmlspecialchars($faction_id, ENT_QUOTES, 'UTF-8'); ?>">

            <button type="submit">Validez</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>