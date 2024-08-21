<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription Réussie</title>
  <link rel="icon" href="../img/logo.ico">
  <!-- <link rel="stylesheet" href="../css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>
<body>
  <?php include '../includes/header.php'; ?>
  <main>
    <section>
      <article>
        <div class="title__margin--register"></div>
        <div class="texte-position__center">
          <div class="texte-position__heigth textebackground">
            <h1>Bienvenue sur Saint Seiya Online</h1>
            <p>Votre compte a été créé avec succès.</p>
            <p>Vous allez être redirigé vers la page de connexion...</p>
            <script>
              setTimeout(function() {
                window.location.href = '../login.php';
              }, 3000);
            </script>
          </div>
        </div>
      </article>
    </section>
  </main>
  <?php include '../includes/footer.php'; ?>
</body>
</html>