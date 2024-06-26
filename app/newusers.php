<?php
// Inclure le fichier de configuration
include 'config.php';

// Empêcher l'accès direct au fichier
if (!defined('SECURE_PAGE')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialiser les messages d'erreur
$error_message = "";

// Traiter le formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dsn = 'mysql:host=' . $DBHost . ';dbname=' . $DBName . ';charset=utf8';
        $pdo = new PDO($dsn, $DBUser, $DBPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $pass = htmlspecialchars(trim($_POST['passwd']), ENT_QUOTES, 'UTF-8');
        $repass = htmlspecialchars(trim($_POST['repasswd']), ENT_QUOTES, 'UTF-8');

        if (empty($login) || empty($email) || empty($pass) || empty($repass)) {
            $error_message = "Tous les champs sont obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Adresse e-mail invalide.";
        } elseif (!preg_match("/^[a-z0-9]{8,}$/", $login)) {
            $error_message = "Le nom d'utilisateur doit contenir au moins 8 caractères en minuscule et/ou chiffres.";
        } elseif ($pass !== $repass) {
            $error_message = "Les mots de passe ne correspondent pas.";
        } elseif (strlen($pass) < 6) {
            $error_message = "Le mot de passe doit comporter au moins 6 caractères.";
        } else {
            $stmt = $pdo->prepare("SELECT name FROM users WHERE name = ?");
            $stmt->execute([$login]);

            if ($stmt->rowCount() > 0) {
                $error_message = "Nom d'utilisateur déjà existant.";
            } else {
                $salt = md5($login . $pass); // Conserver le hachage MD5
                $date = date("Y-m-d H:i:s");

                // Assurez-vous que les colonnes correspondent à celles de votre table
                $stmt = $pdo->prepare("INSERT INTO users (name, password, email, created_at) VALUES (?, ?, ?, ?)");
                $stmt->execute([$login, $salt, $email, $date]);

                if ($stmt) {
                    $_SESSION['login'] = $login;
                    header('Location: welcome.php');
                    exit;
                } else {
                    $error_message = "Erreur lors de l'inscription.";
                }
            }
        }
    } catch (PDOException $e) {
        $error_message = "Erreur de connexion : " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saint Seiya Online Inscription</title>
  <meta name="keywords" content="Page d'inscription pour le site web et le jeu en ligne" />
  <meta name="description"
    content="Saint Seiya Online est le tout premier (et pour l'instant unique) MMO basé sur l'univers Saint Seiya." />
  <link rel="icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
<?php include 'header.php'; ?>
  <article>
    <div class="head-card"></div>
    <div class="title__margin--register">
      <h1>Saint Seiya Online <br>Rôle Play</h1>
    </div>
    <div class="item-register"></div>
    <p>Minimum 8 lettres en minuscule et/ou chiffres, <br>sans caractères spéciaux</p>
    <div class="content">
      <form class="login_cont" action="register.php" method="post">
        <div class="input_signup active">
          <input class="input input_form" id="user_name" type="text" name="login"
            aria-label="Nom d’utilisateur (contient des lettres/chiffres)" placeholder="Nom d’utilisateur/Username" required>
          <div class="hint">Nom d’utilisateur</div>
          <input class="input input_form" id="user_email" type="text" name="email" aria-label="EMail" placeholder="Email" required>
          <div class="hint">Adresse e-mail</div>
          <input class="input input_form" id="password" type="password" aria-label="MdP" name="passwd"
            placeholder="Mdp/Password" required>
          <div class="hint">Mot de passe （Minimum 6 caracteres）</div>
          <input class="input input_form" id="repassword" type="password" name="repasswd" aria-label="Mdp"
            placeholder="Mdp/Password" required>
          <div class="hint">Saisir à nouveau votre mot de passe</div>
          <?php
          if (!empty($error_message)) {
              echo '<div class="error-message">' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</div>';
          }
          ?>
          <div class="content">
            <input type="submit" id="submit" class="button button__register" name="button"
              value="Cliquez sur S’inscrire">
          </div>
          <div class="content">
            <span><a class="Password-forget" href="forgot_password.php">Mot de passe oublié ?</a></span>
          </div>
        </div>
      </form>
    </div>
  </article>
  <?php include 'footer.php'; ?>
</body>
</html>