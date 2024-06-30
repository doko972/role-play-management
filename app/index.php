<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saint Seiya Online accueil</title>
  <meta name="keywords"
    content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
  <meta name="description"
    content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
  <?php include 'header.php'; ?>
  <main>
    <section>
      <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
    </section>
    <section>
      <article>
        <div class="texte-position textebackground">
          <h1>Saint Seiya Online <br>Rôle Play</h1>
          <p>Nouveaux Chevaliers !</p>
          <p>Nous sommes ravis de vous accueillir dans cet univers passionnant où l'aventure et l'épopée des Chevaliers
            du Zodiaque prennent vie.</p>
          <p>Vous devrez choisir un rôle qui correspond à votre personnage et vous devrez rejoindre la faction qui
            résonne le plus avec vos aspirations Rôle Play/PVP.</p>
          <p>Que vous soyez un fier Chevalier d'Athéna, un intrépide Spectre d'Hadès ou un Général marinas de Poseidon,
            votre destin vous attend!</p>
          <p>N'hésitez pas à interagir avec vos compagnons de faction et commencer à tisser des liens au sein de cet
            univers. Nous sommes impatients de partager cette aventure épique avec vous, et nous espérons que votre
            aventure parmi nous sur Saint Seiya Online sera empli de moments mémorables.</p>
          <p>Bon jeu à tous jeunes Guerriers, enflammez votre cosmos!!!</p>
          <p>Que votre histoire dans le monde de Saint Seiya Online Rôle Play commence maintenant!</p>
        </div>
      </article>
    </section>
    <section>
      <article>
        <div>
          <h2 class="texte-position">Choisissez votre camp!</h2>
        </div>
        <div>
          <ul class="divinite__align">
            <li>
              <div class="faction athena">
                <a href="saint.php" class="button__register button__register--min">Chevaliers</a>
              </div>
            </li>
            <li>
              <div class="faction poseidon menu__choose--select">
                <a href="marinas.php" class="button__register button__register--min">Marinas</a>
              </div>
            </li>
            <li>
              <div class="faction hades">
                <a href="spectres.php" class="button__register button__register--min">Spectres</a>
              </div>
            </li>
          </ul>
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
  <script src="js/animate.js"></script>
  <script src="servertime.js"></script>
  <?php include 'footer.php'; ?>
</body>

</html>