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
  <section>
    <div class="navbar-container__back">
    </div>
  </section>
  <section>
    <article>
      <div>
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
  <script src="servertime.js"></script>
  <?php include 'footer.php'; ?>
</body>

</html>