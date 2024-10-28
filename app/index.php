<?php
session_start();

include 'includes/_functions.php';
include 'includes/_database.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$welcome_message = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : 'Bienvenue sur le serveur Rôle Play de Saint Seiya Online!';

// Retrieve categories
$stmt = $dbCo->query('SELECT id, name 
FROM categories');
$categories = $stmt->fetchAll();
?>
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
  <!-- <link rel="stylesheet" href="css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <main>
    <section>
      <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
    </section>
    <section>
      <article>
        <h1><?php echo $welcome_message; ?></h1>
        <div class="texte-position textebackground">
          <h1>Saint Seiya Online <br>Rôle Play</h1>
          <p>Nouveaux Chevaliers, Bienvenue !</p>
          <p>Nous sommes enchantés de vous accueillir dans l'univers captivant de Saint Seiya, où les
            légendaires Chevaliers du Zodiaque prennent vie.</p>
          <p>Préparez-vous à plonger dans une aventure épique où chaque choix façonne votre destin. Sélectionnez le
            rôle
            qui incarne le mieux votre esprit et rejoignez la faction qui résonne avec vos aspirations de jeu de rôle.
          </p>
          <p>Serez-vous un vaillant Chevalier d'Athéna, un redoutable Spectre d'Hadès ou un puissant Général Marinas
            de
            Poséidon ? Le sort de l'univers repose entre vos mains !</p>
          <p>N'hésitez pas à interagir avec vos compagnons de faction, à tisser des alliances solides et à vous
            immerger
            dans ce monde extraordinaire. Ensemble, nous écrirons des pages mémorables de bravoure et de camaraderie.
          </p>
          <p> Nous sommes impatients de partager cette aventure épique avec vous. Que votre périple à travers Saint
            Seiya soit rempli de combats héroïques en rejoignant le serveur Saint seiya Online avec vos frères et soeurs
            d'armes,
            de découvertes passionnantes et de souvenirs impérissables.</p>
          <p>À vous de jouer, jeunes Guerriers.</p>
          <p>Faites brûler votre cosmos !</p>
          <p>Laissez votre histoire dans le monde de Saint Seiya commencer maintenant !</p>
        </div>
      </article>
    </section>
    <section>
      <section>
        <article>
          <div>
            <h2 class="texte-position">Choisissez votre Faction!</h2>
          </div>
          <div>
            <ul class="divinite__align">
              <li>
                <div class="faction athena">
                  <a href="saint.php" class="button__register button__register--min">Choisir : <br> Chevaliers</a>
                </div>
              </li>
              <li>
                <div class="faction poseidon menu__choose--select">
                  <a href="marinas.php" class="button__register button__register--min">Choisir : <br> Marinas</a>
                </div>
              </li>
              <li>
                <div class="faction hades">
                  <a href="spectres.php" class="button__register button__register--min">Choisir : <br> Spectres</a>
                </div>
              </li>
            </ul>
          </div>
        </article>
      </section>
      <section>
        <article>
          <h2 class="texte-position">Événements à venir</h2>
          <ul class="event-list">
            <a href="news.php">
              <li class="event-card">
                <div class="">
                  <p>Tournois Galactique pour la reprise du serveur !</p>
                  <p> Ne le manquez pas !</p>
                </div>
                <h3 class="texte-position">Tournoi RP/PvP</h3>
                <p>Date : Samedi 31 août 2024 de 20h00 à 22h00</p>
                <p>Description : Montrez vos compétences de combat et gagnez des récompenses.</p>
              </li>
            </a>
          </ul>
        </article>
      </section>
  </main>
  <script src="js/animate.js"></script>
  <script src="servertime.js"></script>
  <?php include 'includes/footer.php'; ?>
</body>

</html>