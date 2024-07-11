<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/_database.php';
include 'includes/_functions.php';

$user_id = $_SESSION['user_id'];
$stmt = $dbCo->prepare("SELECT * FROM users WHERE id_user = :id_user");
$stmt->bindParam(':id_user', $user_id);
$stmt->execute();
$user = $stmt->fetch();

if (!$user) {
    echo "Utilisateur non trouvé!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord</title>
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <section>
      <article class="article-form">
        <br>
        <div class="title__margin--register">
          <h1>Bienvenue, <?php echo htmlspecialchars($user['truename']); ?>!</h1>
        </div>
        <div class="item-register">
          <div class="content">
            <p>Nom d'utilisateur: <?php echo htmlspecialchars($user['login']); ?></p>
            <p>Adresse e-mail: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>Date de naissance: <?php echo htmlspecialchars($user['birthday']); ?></p>
            <p>Compte créé le: <?php echo htmlspecialchars($user['creatime']); ?></p>
            <p>Status: <?php echo $user['is_online'] ? 'En ligne' : 'Hors ligne'; ?></p>
          </div>
        </div>
      </article>
    </section>
  </main>
  <?php include 'footer.php'; ?>
  <script src="js/script.js"></script>
</body>
</html>