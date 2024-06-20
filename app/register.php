<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Connexion de compte</title>
	<?php
	include "config.php";

	$Data = '<form action="register.php" method="post">
    Login:  
    <br><input type="text" name="login"><br><br>
    password:
    <br><input type="password" name="passwd"><br><br>
    Enter password again:
    <br><input type="password" name="repasswd"><br><br>
    Email:
    <br><input type="text" name="email"><br><br>
    <input type="submit" name="submit" value="Confirm registration">
    </form>';

	if (isset($_POST['login'])) {
		$link = new mysqli($DBHost, $DBUser, $DBPassword, $DBName);

		if ($link->connect_error) {
			die("Erreur de connexion: " . $link->connect_error);
		}

		$login = strtolower(trim($_POST['login']));
		$pass = strtolower(trim($_POST['passwd']));
		$repass = strtolower(trim($_POST['repasswd']));
		$email = trim($_POST['email']);

		if (empty($login) || empty($pass) || empty($repass) || empty($email)) {
			echo "Tous les champs sont vides.";
		} elseif (preg_match("/[^0-9a-zA-Z_-]/", $login)) {
			echo "Le nom d'utilisateur est incorrect.";
		} elseif (preg_match("/[^0-9a-zA-Z_-]/", $pass)) {
			echo "Veuillez saisir le mot de passe correctement.";
		} elseif (preg_match("/[^0-9a-zA-Z_-]/", $repass)) {
			echo "Veuillez confirmer le mot de passe.";
		} elseif (strpos($email, '\'') !== false) {
			echo "Email mal saisi";
		} else {
			$stmt = $link->prepare("SELECT name FROM users WHERE name = ?");
			$stmt->bind_param("s", $login);
			$stmt->execute();
			$stmt->store_result();

			if ($stmt->num_rows > 0) {
				echo "Utilisateur <b>" . $login . "</b> déjà existant";
			} elseif (strlen($login) < 4 || strlen($login) > 15) {
				echo "Le nom de connexion doit comporter plus de 4 caractères et moins de 15 caractères, veuillez le saisir à nouveau.";
			} elseif (strlen($pass) < 4 || strlen($pass) > 15) {
				echo "Le mot de passe doit comporter plus de 4 caractères et moins de 15 caractères, veuillez le saisir à nouveau.";
			} elseif (strlen($repass) < 4 || strlen($repass) > 15) {
				echo "Confirmez que le mot de passe doit contenir plus de 4 caractères et moins de 15 caractères, veuillez le saisir à nouveau.";
			} elseif (strlen($email) < 4 || strlen($email) > 25) {
				echo "L'email doit comporter plus de 4 caractères et moins de 25 caractères, veuillez le saisir à nouveau.";
			} elseif ($pass != $repass) {
				echo "Les mots de passe ne correspondent pas.";
			} else {
				$salt = md5($login . $pass);
				$date = date("Y-m-d H:i:s");

				$stmt = $link->prepare("CALL adduser(?, ?, '0', '0', '0', '0', ?, '0', '0', '0', '0', '0', '0', '0', ?, '', ?)");
				$stmt->bind_param("sssss", $login, $salt, $email, $date, $salt);

				if (!$stmt->execute()) {
					die("Can't execute query.");
				}

				$stmt = $link->prepare("SELECT ID FROM users WHERE name = ?");
				$stmt->bind_param("s", $login);
				$stmt->execute();
				$stmt->bind_result($id);
				$stmt->fetch();
				$stmt->close();

				$stmt = $link->prepare("INSERT INTO usecashnow (userid, zoneid, sn, aid, point, cash, status, creatime) VALUES (?, '1', '1', '1', '99999900000', '999999000', '3', ?)");
				$stmt->bind_param("is", $id, $date);
				$stmt->execute();
				$stmt->close();

				$link->close();

				// echo ("<script type='text/javascript'> alert('Bienvenue sur Saint Seiya Online " . $login . "！');location.href='index.html';</script>");
				echo "<script type='text/javascript'>window.location.href = 'welcome.php';</script>";
			}
		}
	} else {
		echo $Data;
	}
	?>
</head>

<body>
</body>

</html>