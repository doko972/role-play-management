<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saint Seiya Online Inscription</title>
  <meta name="keywords" content="Page d'inscription pour le site web et le jeu en ligne" />
  <meta name="description"
    content="Saint Seiya Online est le tout premier (et pour l'instant unique) MMO basé sur l'univers Saint Seiya." />
    <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
<?php include 'header.php'; ?>
  <article>
    <div class="head-card">

    </div>
    <div class="title__margin--register">
      <h1>Saint Seiya Online <br>Rôle Play</h1>
    </div>
    <div class="item-register">
      <div class="content">
        <form class="login_cont" action=register.php method=post>
          <div class="input_signup active">
            <input class="input input_form" id="user_name" type="text" name="login"
              aria-label="Nom d’utilisateur (contient des lettres/chiffres)" placeholder="Nom d’utilisateur/Username">
            <div class="hint">Nom d’utilisateur</div>
            <input class="input input_form" id="password" type="password" aria-label="MdP" name=passwd
              placeholder="Mdp/Password">
            <div class="hint">Mot de passe （Minimum 6 caracteres）</div>
            <div class="content">
              <input type="submit" id="submit" class="button button__register" name="button" value="Connexion">
            </div>
            <div class="content">
              <span><a class="Password-forget" href="forgot_password.php">Mot de passe oublié ?</a></span>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div>
      <p>Vous n'avez pas de compte ? <a class="Password-forget" href="newusers.php">Creer</a></p>
    </div>
  </article>
  <script src="js/script.js"></script>
  <?php include 'footer.php'; ?>
</body>
</html>