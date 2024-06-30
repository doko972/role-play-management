<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saint Seiya Online création de compte</title>
  <meta name="keywords"
    content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
  <meta name="description"
    content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<?php include 'header.php'; ?>
  <article>
<br>
    <div class="title__margin--register">
      <h1>Saint Seiya Online <br>Rôle Play</h1>
    </div>
    <div class="item-register">
      <p>Minimum 8 lettres en minuscule et/ou chiffres, <br>sans caractères spéciaux</p>
      <div class="content">
        <form class="login_cont" action=register.php method=post>
          <div class="input_signup active">
            <input class="input input_form" id="user_name" type="text" name="login"
              aria-label="Nom d’utilisateur (contient des lettres/chiffres)" placeholder="Nom d’utilisateur/Username">
            <div class="hint">Nom d’utilisateur</div>
            <input class="input input_form" id="user_email" type="text" name=email aria-label="EMail"
              placeholder="Email">
            <div class="hint">Adresse e-mail</div>
            <input class="input input_form" id="password" type="password" aria-label="MdP" name=passwd
              placeholder="Mdp/Password">
            <div class="hint">Mot de passe （Minimum 6 caracteres）</div>
            <input class="input input_form" id="repassword" type="password" name=repasswd aria-label="Mdp"
              placeholder="Mdp/Password">
            <div class="hint">Saisir à nouveau votre mot de passe</div>
            <div class="content">
              <input type="submit" id="submit" class="button button__register" name="button"
                value="Cliquez sur S’inscrire">
            </div>
            <div class="content">
              <!-- <span><a class="Password-forget" href="forgot_password.php">Mot de passe oublié ?</a></span> -->
            </div>
          </div>
        </form>
      </div>
    </div>
  </article>
  <?php include 'footer.php'; ?>
  <script src="js/script.js"></script>
</body>


</html>