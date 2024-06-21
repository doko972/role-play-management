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
  <link rel="icon" href="img/url0.ico">
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
  <header class="sticky">
    <nav class="navbar">
      <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
          <span class="line line1"></span>
          <span class="line line2"></span>
          <span class="line line3"></span>
        </div>
        <ul class="menu-items">
          <li><button class="btn-add-event--register--nav "><a href="index.php">Accueil</a></button></li>
          <li><input type="checkbox" id="athena-toggle">
            <button class="btn-add-event--register--nav "><a href="saint.php">Athena</a></button>
          </li>
          <li>
            <input type="checkbox" id="athena-toggle">
            <button class="btn-add-event--register--nav"><a href="marinas.php">Poseidon</a></button>
          </li>
          <li>
            <input type="checkbox" id="athena-toggle">
            <button class="btn-add-event--register--nav"><a href="spectres.php">Hades</a></button>
          </li>
          <li><button class="btn-add-event--register--nav"><a href="#">Calendrier</a></button>
          </li>
          <li><button class="btn-add-event--register--nav"><a href="https://discord.gg/3zkTwdDnhc">Discord</a></button>
          </li>
          <li><button class="btn-add-event--register--nav"><a href="#">Le jeu</a></button></li>
          <li><button class="btn-add-event--register--nav"><a href="login.html">Connexion</a></button></li>
        </ul>
      </div>
    </nav>
  </header>
  <section>
    <div class="navbar-container__back">
      <!-- <video id="bgvideo" class="pc-e navbar-container__back-video" loop autoplay muted
        src="video/videoEntree.mp4"></video> -->
    </div>
  </section>
  <section>
    <article>
      <div class="status-server">
        <?php

        try {
          include "config.php";
          $dsn = 'mysql:host=' . $DBHost . ';dbname=' . $DBName . ';charset=utf8';
          $dbCo = new PDO($dsn, $DBUser, $DBPassword);

          echo "<p class='status-server' style='color: green;'>Serveur en ligne</p>";

          var_dump($dbCo);

        } catch (PDOException $e) {
          echo "<p class='status-server' style='color: red;'>Erreur connexion MySQL: " . $e->getMessage() . "</p>";
          die();
        }
        $dbCo = null;
        ?>
      </div>
      </div>
      <div class="texte-position textebackground">
        <h1>Saint Seiya Online <br>Rôle Play</h1>
        <p>Nouveaux Chevaliers !</p>
        <p>Nous sommes ravis de vous accueillir dans cet univers passionnant où l'aventure et l'épopée des
          Chevaliers du Zodiaque prennent vie.</p>
        <br>
        <p>Vous devrez choisir un rôle qui correspond à votre personnage et vous devrez rejoindre la faction
          qui
          résonne le plus avec vos aspirations Rôle Play/PVP.</p>
        <br>
        <p>Que vous soyez un fier Chevalier d'Athéna, un intrépide Spectre d'Hadès ou un
          Général marinas de Poseidon, votre destin vous attend!</p>
        <br>
        <p>N'hésitez pas à interagir avec vos compagnons de faction et commencer à tisser des liens au sein
          de
          cet univers. Nous sommes impatients de partager cette aventure épique avec vous, et nous
          espérons
          que votre aventure parmi nous sur Saint Seiya Online sera empli de moments mémorables.</p>
        <br>
        <p>Bon jeu à tous jeunes Guerriers, enflammez votre cosmos!!!</p>
        <br>
        <p>Que votre histoire dans le monde de Saint Seiya Online Rôle Play commence
          maintenant!</p>
      </div>
    </article>
  </section>
  <section>
    <article>
      <div>
        <h3 class="p-max">Choisisez votre camps!</h3>
      </div>
      <div>
        <ul class="divinite__align">
          <li>
            <div class="faction athena">
              <button class="button__register button__register--min"><a href="saint.php">Chevaliers</a></button>
            </div>
          </li>
          <li>
            <div class="faction poseidon menu__choose--select">
              <button class="button__register button__register--min"><a href="marinas.php">Marinas</a>
              </button>
            </div>
          </li>
          <li>
            <div class="faction hades">
              <button class="button__register button__register--min"><a href="spectres.php">Spectres</a>
              </button>
            </div>
          </li>
        </ul>
      </div>
    </article>
  </section>
  <script src="js/animate.js"></script>
  <footer>
    <div class="footer-bottom">
      <p class="copyright">&copy; 2024 © Copyright 2024 - Saint Seiya Online RP/PVP
      </p>
    </div>
  </footer>
</body>

</html>