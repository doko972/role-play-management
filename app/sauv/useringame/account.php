<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saint Seiya Online création de compte</title>
  <meta name="keywords" content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
  <meta name="description" content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <?php include '../header.php'; ?>
  <main>
    <section>
    <article class="article-form">
      <br>
      <div class="title__margin--register">
        <h1>Créer compte <br>pour<br>le Jeu en ligne</h1>
      </div>
      <div class="item-register">
        <p>Minimum 8 lettres en minuscule et/ou chiffres, <br>sans caractères spéciaux</p>
        <div class="content">
          <form class="login_cont" action="register.php" method="post">
            <div class="input_signup active">
              <label for="user_name" class="sr-only">Nom d’utilisateur</label>
              <input class="input input_form" id="user_name" type="text" name="login" aria-label="Nom d’utilisateur (contient des lettres/chiffres)" placeholder="Nom d’utilisateur/Username">
              <div class="hint">Nom d’utilisateur</div>

              <label for="user_email" class="sr-only">Adresse e-mail</label>
              <input class="input input_form" id="user_email" type="email" name="email" aria-label="Adresse e-mail" placeholder="Email">
              <div class="hint">Adresse e-mail</div>

              <label for="password" class="sr-only">Mot de passe</label>
              <input class="input input_form" id="password" type="password" name="passwd" aria-label="Mot de passe" placeholder="Mdp/Password">
              <div class="hint">Mot de passe (Minimum 6 caractères)</div>

              <label for="repassword" class="sr-only">Confirmer le mot de passe</label>
              <input class="input input_form" id="repassword" type="password" name="repasswd" aria-label="Confirmer le mot de passe" placeholder="Mdp/Password">
              <div class="hint">Saisir à nouveau votre mot de passe</div>

              <div class="content">
                <input type="submit" id="submit" class="button button__register" name="button" value="Cliquez sur S’inscrire">
              </div>
              <div class="content">
              </div>
            </div>
          </form>
        </div>
      </div>
    </article>
  </section>
  <section>
      <article class="table-containers">
        <div class="textebackground__wce">
          <h3 class="table-ttl">Configuration minimum</h3>
          <ul class="table-operating">
            <li>
              <table class="table-array">
                <tr>
                  <td class="table-array__border">Système d'exploitation</td>
                  <td class="table-array__border">Windows 7, 8 ou 10.</td>
                </tr>
                <tr>
                  <td class="table-array__border">CPU</td>
                  <td class="table-array__border">Core 2 Duo ou AMD PHENOM II X2 / Intel I5 ou AMD PHENOM II X6
                    (recommandé) </td>
                </tr>
                <tr>
                  <td class="table-array__border">Mémoire RAM</td>
                  <td class="table-array__border">4GB RAM / 6GB RAM (recommandé) </td>
                </tr>
                <tr>
                  <td class="table-array__border">Disque dur</td>
                  <td class="table-array__border">15GB Espace libre sur le disque dur </td>
                </tr>
                <tr>
                  <td class="table-array__border">GPU</td>
                  <td class="table-array__border">GeForce 8800 GT / ATI Radeon 4770 / GeForce 9800 GT / ATI Radeon HD
                    6670 (recommandé) </td>
                </tr>
              </table>
            </li>
            <li class="discord-container">
              <h3 class="table-ttl">Membres</h3>
              <iframe class="discord-container-widget"
                src="https://discord.com/widget?id=1147228974590730324&theme=dark" width="350" height="500"
                allowtransparency="true" frameborder="0"
                sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
            </li>
          </ul>
        </div>
      </article>
    </section>
  </main>
  <?php include '../footer.php'; ?>
  <script src="../js/script.js"></script>
</body>

</html>