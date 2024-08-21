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
    <title>Saint Seiya Online - Événements</title>
    <meta name="keywords" content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
    <meta name="description" content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
    <link rel="icon" href="img/logo.ico">
  <!-- <link rel="stylesheet" href="css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <section>
            <div class="navbar-container__news" role="img" aria-label="Image de fond de la barre de navigation"></div>
        </section>
        <div class="news-center">
            <section class="events-section">
                <h2 class="texte-position">Événements à venir</h2>
                <div class="events-container">
                <a href="#"><div class="event-card">
                        <h3>Tournoi des Chevaliers</h3>
                        <p>Date : 15 Juin 2024</p>
                        <p>Description : Rejoignez le Tournoi des Chevaliers et montrez votre bravoure.</p>
                    </div></a>
                    <a href="#"><div class="event-card">
                        <h3>Quête spéciale : Sauvetage d'Athéna</h3>
                        <p>Date : 22 Juin 2024</p>
                        <p>Description : Rejoignez-nous pour sauver Athéna des griffes des Spectres !</p>
                    </div></a>
                    <a href="event/event_1.php"><div class="event-card">
                        <h3>Tournois Galactique</h3>
                        <p>Date : Samedi 31 août 2024</p>
                        <p>Description : Participez au prestigieux Championnat Galactique et prouvez votre valeur en tant que Chevalier.</p>
                        <p>Certaines récompenses vous permettront de booster votre perso PVP</p>
                    </div></a>
                </div>
            </section>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>