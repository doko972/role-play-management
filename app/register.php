<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'includes/_database.php';
include 'includes/_functions.php';

generateToken();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = sanitizeInput($_POST['login']);
    $truename = sanitizeInput($_POST['truename']);
    $email = sanitizeInput($_POST['email']);
    $birthday = sanitizeInput($_POST['birthday']);
    $passwd = sanitizeInput($_POST['passwd']);
    $repasswd = sanitizeInput($_POST['repasswd']);
    $token = sanitizeInput($_POST['token']);

    if (validateToken($token)) {
        if ($passwd === $repasswd) {
            $hashedPassword = password_hash($passwd, PASSWORD_BCRYPT);

            $stmt = $dbCo->prepare("INSERT INTO users (login, passwd, truename, email, birthday, creatime, is_online) VALUES (:login, :passwd, :truename, :email, :birthday, NOW(), 0)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':passwd', $hashedPassword);
            $stmt->bindParam(':truename', $truename);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':birthday', $birthday);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                echo "Erreur lors de l'enregistrement!";
            }
        } else {
            echo "Les mots de passe ne correspondent pas!";
        }
    } else {
        echo "Token CSRF invalide!";
    }
} else {
    echo "Méthode de requête non autorisée!";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <section>
      <article class="article-form">
        <h1>Inscription</h1>
        <form class="login_cont" action="register.php" method="post">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
          <div class="input_signup active">
            <label for="user_name" class="sr-only">Nom d’utilisateur</label>
            <input class="input input_form" id="user_name" type="text" name="login" aria-label="Nom d’utilisateur" placeholder="Nom d’utilisateur/Username">
            <div class="hint">Nom d’utilisateur</div>

            <label for="user_truename" class="sr-only">Nom Réel</label>
            <input class="input input_form" id="user_truename" type="text" name="truename" aria-label="Nom Réel" placeholder="Nom Réel">
            <div class="hint">Nom Réel</div>

            <label for="user_email" class="sr-only">Adresse e-mail</label>
            <input class="input input_form" id="user_email" type="email" name="email" aria-label="Adresse e-mail" placeholder="Email">
            <div class="hint">Adresse e-mail</div>

            <label for="user_birthday" class="sr-only">Date de Naissance</label>
            <input class="input input_form" id="user_birthday" type="date" name="birthday" aria-label="Date de Naissance">
            <div class="hint">Date de Naissance</div>

            <label for="password" class="sr-only">Mot de passe</label>
            <input class="input input_form" id="password" type="password" name="passwd" aria-label="Mot de passe" placeholder="Mdp/Password">
            <div class="hint">Mot de passe</div>

            <label for="repassword" class="sr-only">Confirmer le mot de passe</label>
            <input class="input input_form" id="repassword" type="password" name="repasswd" aria-label="Confirmer le mot de passe" placeholder="Mdp/Password">
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
  <script src="js/script.js"></script>
</body>
</html>