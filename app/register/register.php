<?php include '../includes/_registerAdd.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="icon" href="../img/logo.ico">
  <!-- <link rel="stylesheet" href="../css/styles.css"> -->
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
  <?php include 'header.php'; ?>
  <main>
    <section>
      <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
    </section>
    <section>
      <article class="article-form">
        <h1>Inscription</h1>
        <?php if (isset($error_message)): ?>
          <p class="error-message"><?= $error_message; ?></p>
        <?php endif; ?>
        <form class="login_cont" action="registerScript.php" method="post">
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
          <div class="input_signup active">
            <label for="user_name" class="sr-only">Nom d’utilisateur</label>
            <input class="input input_form" id="user_name" type="text" name="login" aria-label="Nom d’utilisateur" placeholder="Nom d’utilisateur/Username" required>
            <div class="hint">Nom d’utilisateur</div>

            <label for="user_truename" class="sr-only">Nom Jeu de rôle</label>
            <input class="input input_form" id="user_truename" type="text" name="truename" aria-label="Nom de personnage Jeu de rôle" placeholder="Nom de personnage Jeu de rôle" required>
            <div class="hint">Nom Réel</div>

            <label for="faction" class="sr-only">Choix de Faction</label>
            <select class="input input_form" id="faction" name="faction" aria-label="Faction" required>
              <?php foreach ($factions as $faction): ?>
                <option value="<?php echo $faction['id_faction']; ?>">
                  <?php echo $faction['faction_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <div class="hint">Sélectionner une faction</div>

            <label for="user_email" class="sr-only">Adresse e-mail</label>
            <input class="input input_form" id="user_email" type="email" name="email" aria-label="Adresse e-mail" placeholder="Email" required>
            <div class="hint">Adresse e-mail</div>

            <label for="user_birthday" class="sr-only">Date de Naissance (JJ/MM/AAAA)</label>
            <input class="input input_form" id="user_birthday" type="text" name="birthday" aria-label="Date de Naissance" placeholder="JJ/MM/AAAA" required>
            <div class="hint">Date de Naissance (JJ/MM/AAAA)</div>

            <label for="password" class="sr-only">Mot de passe</label>
            <input class="input input_form" id="password" type="password" name="passwd" aria-label="Mot de passe" placeholder="Mdp/Password" required>
            <div class="hint">Mot de passe</div>

            <label for="repassword" class="sr-only">Confirmer le mot de passe</label>
            <input class="input input_form" id="repassword" type="password" name="repasswd" aria-label="Confirmer le mot de passe" placeholder="Mdp/Password" required>
            <div class="hint">Saisir à nouveau votre mot de passe</div>

            <div class="content">
              <input type="submit" id="submit" class="button button__register" name="button" value="S’inscrire">
            </div>
          </div>
        </form>
      </article>
    </section>
  </main>
  <?php include 'footer.php'; ?>
  <!-- <script src="js/script.js"></script> -->
</body>

</html>