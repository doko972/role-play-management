<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Creation de compte</title>
    <link rel="icon" href="img/logo.ico">
    <?php
    include "config.php";

    $Data = '<form action="register.php" method="post">
    Login:  
    <br><input type="text" name="login"><br><br>
    Password:
    <br><input type="password" name="passwd"><br><br>
    Enter password again:
    <br><input type="password" name="repasswd"><br><br>
    Email:
    <br><input type="text" name="email"><br><br>
    <input type="submit" name="submit" value="Confirm registration">
    </form>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $dsn = 'mysql:host=' . $DBHost . ';dbname=' . $DBName . ';charset=utf8';
            $pdo = new PDO($dsn, $DBUser, $DBPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $login = htmlspecialchars(strtolower(trim($_POST['login'])), ENT_QUOTES, 'UTF-8');
            $pass = htmlspecialchars(trim($_POST['passwd']), ENT_QUOTES, 'UTF-8');
            $repass = htmlspecialchars(trim($_POST['repasswd']), ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');

            if (empty($login) || empty($pass) || empty($repass) || empty($email)) {
                echo "Tous les champs sont obligatoires.";
            } elseif (preg_match("/[^0-9a-zA-Z_-]/", $login)) {
                echo "Le nom d'utilisateur est incorrect.";
            } elseif ($pass !== $repass) {
                echo "Les mots de passe ne correspondent pas.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Email incorrect.";
            } else {
                $stmt = $pdo->prepare("SELECT name FROM users WHERE name = ?");
                $stmt->execute([$login]);

                if ($stmt->rowCount() > 0) {
                    echo "Utilisateur <b>" . htmlspecialchars($login, ENT_QUOTES, 'UTF-8') . "</b> déjà existant.";
                } elseif (strlen($login) < 4 || strlen($login) > 15) {
                    echo "Le nom de connexion doit comporter entre 4 et 15 caractères.";
                } elseif (strlen($pass) < 4 || strlen($pass) > 15) {
                    echo "Le mot de passe doit comporter entre 4 et 15 caractères.";
                } elseif (strlen($email) < 4 || strlen($email) > 25) {
                    echo "L'email doit comporter entre 4 et 25 caractères.";
                } else {
                    $salt = md5($login . $pass);
                    $date = date("Y-m-d H:i:s");

                    $stmt = $pdo->prepare("CALL adduser(?, ?, '0', '0', '0', '0', ?, '0', '0', '0', '0', '0', '0', '0', ?, '', ?)");
                    $stmt->execute([$login, $salt, $email, $date, $salt]);

                    if ($stmt) {
                        $stmt = $pdo->prepare("SELECT ID FROM users WHERE name = ?");
                        $stmt->execute([$login]);
                        $id = $stmt->fetchColumn();

                        $pointValue = 999999;

                        $stmt = $pdo->prepare("INSERT INTO usecashnow (userid, zoneid, sn, aid, point, cash, status, creatime) VALUES (?, '1', '1', '1', ?, '999999000', '3', ?)");
                        $stmt->execute([$id, $pointValue, $date]);

                        echo "<script type='text/javascript'>window.location.href = 'welcome.php';</script>";
                    } else {
                        echo "Erreur lors de l'exécution de la requête.";
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        }
    } else {
        echo $Data;
    }
    ?>
</head>

<body>
</body>

</html>