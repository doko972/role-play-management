<?php
include 'config.php';

if (!defined('SECURE_PAGE')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

session_start();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dsn = 'mysql:host=' . $DBHost . ';dbname=' . $DBName . ';charset=utf8';
        $pdo = new PDO($dsn, $DBUser, $DBPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
        $pass = htmlspecialchars(trim($_POST['passwd']), ENT_QUOTES, 'UTF-8');

        if (empty($login) || empty($pass)) {
            $error_message = "Veuillez remplir tous les champs.";
        } else {
            $stmt = $pdo->prepare("SELECT name, password FROM users WHERE name = ?");
            $stmt->execute([$login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && md5($pass) === $user['password']) {
                $_SESSION['login'] = $login;
                header('Location: index.php');
                exit;
            } else {
                $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
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
    <div class="head-card">
    </div>
    <div class="title__margin--register">
      <h1>Saint Seiya Online <br>Rôle Play</h1>
    </div>
    <div class="item-register">
      <div class="content">
        <form class="login_cont" action="login.php" method="post">
          <div class="input_signup active">
            <input class="input input_form" id="user_name" type="text" name="login"
              aria-label="Nom d’utilisateur (contient des lettres/chiffres)" placeholder="Nom d’utilisateur/Username" required>
            <div class="hint">Nom d’utilisateur</div>
            <input class="input input_form" id="password" type="password" aria-label="MdP" name="passwd"
              placeholder="Mdp/Password" required>
            <div class="hint">Mot de passe （Minimum 6 caracteres）</div>
            <?php
            if (!empty($error_message)) {
                echo '<div class="error-message">' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</div>';
            }
            ?>
            <div class="content">
              <input type="submit" id="submit" class="button button__register" name="button" value="Connexion">
            </div>
            <div class="content">
              <span><a class="Password-forget" href="forgot_password.php">Mot de passe oublié ?</a></span>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div>
      <p>Vous n'avez pas de compte ? <a class="Password-forget" href="newusers.php">Creer</a></p>
    </div>
  </article>
  <?php include 'footer.php'; ?>
  <script src="js/script.js"></script>
</body>
</html>