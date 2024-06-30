<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saint Seiya Online Bienvenue</title>
  <meta name="keywords" content="Page avec message de bienvenue suite à l'inscription" />
  <meta name="description"
    content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css" />
  <script>
    function openDownload() {
      window.open('https://drive.google.com/file/d/1Q0oGWF24WcgOGbs9YEOrlT_fMuWY4znX/view?usp=sharing', '_blank');
    }
  </script>
</head>

<body>
  <?php
  include 'header.php';
  ?>
  <main>
    <section>
      <article class="container-wce">
        <div class="download-img"></div>
        <div class="">
            <h3 class="texte-position__center">
              <?php
              if (isset($Login) && !empty($Login)) {
                echo htmlspecialchars($Login, ENT_QUOTES, 'UTF-8');
              } else {
                echo 'Téléchargement : ';

              }
              ?>
            </h3>
            <!-- <script>
              setTimeout(function () {
                window.location.href = 'https://drive.google.com/file/d/1Q0oGWF24WcgOGbs9YEOrlT_fMuWY4znX/view?usp=sharing';
              }, 3000);
            </script> -->
            <div class="content">
              <button onclick="openDownload()" class="button button__register"><a href="saint.php">Télécharger</a></button>
            </div>
        </div>
      </article>
    </section>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>