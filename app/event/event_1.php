<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Saint Seiya Online - Détail de l'événement</title>
    <meta name="keywords"
        content="Page d'accueil avec presentation du site web Saint Seiya Online rôle play ou pvp et choix de factions" />
    <meta name="description"
        content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
    <link rel="icon" href="../img/logo.ico">
  <!-- <link rel="stylesheet" href="../css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
<?php include '../includes/header.php'; ?>
    <main>
        <section>
            <div class="navbar-container__event" role="img" aria-label="Image de fond de la barre de navigation"></div>
        </section>
        <section class="event-article-section">
            <article class="event-article">
                <h1 class="event-title">Championnat Galactique</h1>
                <p class="event-date">Date : 31 août 2024, de 20h00 à 22h30</p>
                <img src="../img/pictures/picture-3-l.png" alt="Image de l'événement" class="event-image">
                <div class="event-content">
                    <p>Description : Participez au prestigieux Championnat Galactique et prouvez votre valeur en tant
                        que Chevalier. Cet événement réunit les meilleurs combattants de tous les coins du monde, prêts
                        à en découdre pour le titre ultime.</p>
                    <p>Les participants auront l'occasion de montrer leurs compétences dans divers défis et combats,
                        mettant à l'épreuve leur force, leur stratégie et leur esprit de chevalerie.</p>
                    <p>Ne manquez pas cette occasion unique de briller sous les étoiles et de gagner des récompenses
                        exclusives. Préparez-vous, affûtez vos armures, et que le meilleur chevalier l'emporte !</p>
                </div>
                <div class="rewards-section">
                    <h2>Récompenses</h2>
                    <div class="rewards-container">
                        <div class="reward-item" tabindex="0" role="button" aria-label="Monture Gorille du Taureau">
                            <img src="../img/reward/2024-06-18 21-26-20.webp" alt="Monture Gorille du Taureau" class="reward-image">
                            <div class="reward-text">Monture Gorille du Taureau</div>
                        </div>
                        <div class="reward-item" tabindex="0" role="button" aria-label="Monture de l'Hydre">
                            <img src="../img/reward/2024-07-04 12-33-40.webp" alt="Monture de l'Hydre" class="reward-image">
                            <div class="reward-text">Monture de l'Hydre</div>
                        </div>
                        <div class="reward-item" tabindex="0" role="button" aria-label="Monture du Tyranosaure">
                            <img src="../img/reward/2024-07-04 12-33-58.webp" alt="Monture du Tyranosaure" class="reward-image">
                            <div class="reward-text">Monture du Tyranosaure</div>
                        </div>
                        <div class="reward-item" tabindex="0" role="button" aria-label="L'armure d'Arès">
                            <img src="../img/reward/2024-07-04 12-41-52.webp" alt="L'armure d'Arès" class="reward-image">
                            <div class="reward-text">Armure du Dieu de la Guerre Arès</div>
                        </div>
                        <div class="reward-item" tabindex="0" role="button" aria-label="Armure divine de Pégase Max">
                            <img src="../img/reward/2024-07-04 12-43-34.webp" alt="Armure divine de Pégase Max" class="reward-image">
                            <div class="reward-text">Armure divine de Pégase Max</div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

</html>