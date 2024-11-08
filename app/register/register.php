<?php
include '../includes/_registerAdd.php';
?>
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
  <?php include '../includes/header.php'; ?>
  <main>
    <section>
      <div class="navbar-container__back" role="img" aria-label="Image de fond de la barre de navigation"></div>
    </section>
    <section>
      <article class="article-form">
        <h1>Inscription</h1>
        <?php displayStoredMessages(); ?>
        <form class="login_cont" action="registerScript.php" method="post" onsubmit="return validateForm()">
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
          <div class="input_signup active">
            <label for="user_name">Nom d'utilisateur</label>
            <input class="input input_form" id="user_name" type="text" placeholder="Nom de connexion" name="login"
              required>

            <label for="user_truename">Nom Jeu de rôle</label>
            <input class="input input_form" id="user_truename" type="text" placeholder="Nom en jeu" name="truename"
              required>

            <label for="faction">Choix de Faction</label>
            <select class="input input_form" id="faction" name="faction" required>
              <option value="">Sélectionnez une faction</option>
              <?php foreach ($factions as $faction): ?>
                <option value="<?= htmlspecialchars($faction['id_faction']); ?>">
                  <?= htmlspecialchars($faction['faction_name']); ?>
                </option>
              <?php endforeach; ?>
            </select>

            <label for="user_email">Adresse e-mail</label>
            <input class="input input_form" id="user_email" type="email" placeholder="Adresse mail" name="email"
              required>

            <label for="user_birthday">Date de Naissance</label>
            <input class="input input_form" id="user_birthday" type="date" placeholder="Date de naissance"
              name="birthday" required>

            <label for="password">Mot de passe</label>
            <input class="input input_form" id="password" type="password" placeholder="Mot de passe" name="passwd"
              required>

            <label for="repassword">Confirmer le mot de passe</label>
            <input class="input input_form" id="repassword" type="password" placeholder="confirmez mot de passe"
              name="repasswd" required>

            <div class="content">
              <input type="submit" id="submit" class="button button__register" name="button" value="S'inscrire">
            </div>
          </div>
        </form>
      </article>
    </section>
  </main>
  <?php include '../includes/footer.php'; ?>
</body>

</html>