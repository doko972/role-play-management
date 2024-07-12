<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

include 'includes/_database.php';
include 'includes/_functions.php';

generateToken();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
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
    <section>
      <article class="article-form">
        <h1>Connexion</h1>
        <form class="login_cont" action="authenticate.php" method="post">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
          <div class="input_signup active">
            <label for="user_name" class="sr-only">Nom d’utilisateur</label>
            <input class="input input_form" id="user_name" type="text" name="login" aria-label="Nom d’utilisateur"
              placeholder="Nom d’utilisateur/Username">
            <div class="hint">Nom d’utilisateur</div>

            <label for="password" class="sr-only">Mot de passe</label>
            <input class="input input_form" id="password" type="password" name="passwd" aria-label="Mot de passe"
              placeholder="Mdp/Password">
            <div class="hint">Mot de passe</div>

            <div class="content">
              <input type="submit" id="submit" class="button button__register" name="button" value="Se Connecter">
            </div>
            <div class="content">
              <a href="register.php">Pas encore de compte ? Créez-en un ici</a>
            </div>
          </div>
        </form>
      </article>
    </section>
  </main>
  <?php include 'footer.php'; ?>
  <script src="js/script.js"></script>
</body>

</html>