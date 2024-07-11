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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saint Seiya Online accueil</title>
  <meta name="keywords" content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
  <meta name="description" content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <section>
      <article>
        <div class="title__margin--register"></div>
        <div class="texte-position__center">
          <div class="texte-position__heigth textebackground">
            <h1>Bienvenue sur Saint Seiya Online RôlePlay PVP <?php echo htmlspecialchars($_SESSION['login']); ?> !</h1>
            <p>Vous allez être redirigé vers la page d'accueil...</p>
            <script>
              setTimeout(function() {
                window.location.href = 'index.php';
              }, 3000);
            </script>
          </div>
        </div>
      </article>
    </section>
  </main>
  <?php include 'footer.php'; ?>
  <script src="js/script.js"></script>
</body>
</html>