<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vérifiez votre email</title>
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
  <?php include '../includes/header.php'; ?>
  <main>
    <div class="head-card" role="empty" aria-label="Champs vide">
    </div>
    <section>
      <article>
        <div class="title__margin--register">
        </div>
        <div class="texte-position__center">
          <div class="texte-position__heigth textebackground">
            <h1>Vérifiez votre email</h1>
            <p>Un email de validation vous a été envoyé. Veuillez vérifier votre boîte de réception et cliquer sur le
              lien pour activer votre compte.</p>
            <p id="countdown">Redirection dans <span id="timer">4</span> secondes...</p>

            <!-- <script>
              setTimeout(function () {
                window.location.href = 'login.php';
              }, 4000);
            </script> -->
            <script>
              let countdown = 4;
              function updateCountdown() {
                document.getElementById("timer").textContent = countdown;
                countdown--;

                if (countdown <= 0) {
                  window.location.href = '../login.php';
                }
              }
              setInterval(updateCountdown, 1000);
            </script>
          </div>
        </div>
      </article>
    </section>
  </main>
  <?php include '../includes/footer.php'; ?>
  <script src="../js/script.js"></script>
</body>

</html>