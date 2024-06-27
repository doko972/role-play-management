<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Inscription</title>
	<?php
	include "config.php";

	$Data = '<form action=register.php method=post>
	 Nom de connexion:  
	<br><input type=text name=login><br><br>
	Mot de passe:
	<br><input type=password name=passwd><br><br>
	 Confirmer le mot de passe:
	<br><input type=password name=repasswd><br><br>
	Email:
	<br><input type=text name=email><br><br>
	<input type=submit name=submit value="Confirmer l\'inscription">
	</form>';

	if (isset($_POST['login'])) {
		$Link = MySQL_Connect($DBHost, $DBUser, $DBPassword) or die("Erreur de connexion, veuillez contacter l'administrateur.");
		MySQL_Select_Db($DBName, $Link) or die("La base de données " . $DBName . " n'existe pas.");

		$Login = $_POST['login'];
		$Pass = $_POST['passwd'];
		$Repass = $_POST['repasswd'];
		$Email = $_POST['email'];

		$Login = StrToLower(Trim($Login));
		$Pass = Trim($Pass);
		$Repass = Trim($Repass);
		$Email = Trim($Email);

		if (empty($Login) || empty($Pass) || empty($Repass) || empty($Email)) {
			echo "Tous les champs sont vides.";
		} elseif (preg_match("/[^0-9a-zA-Z_-]/", $Login, $Txt)) {
			echo "Nom d'utilisateur incorrect.";
		} elseif (StrPos('\'', $Email)) {
			echo "Adresse email incorrecte.";
		} else {
			$Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or ("Impossible d'exécuter la requête.");

			if (MySQL_Num_Rows($Result)) {
				echo "Le nom d'utilisateur <b>" . $Login . "</b> existe déjà.";
			} elseif ((StrLen($Login) < 4) or (StrLen($Login) > 10)) {
				echo "Le nom d'utilisateur doit être compris entre 4 et 10 caractères.";
			} elseif ((StrLen($Pass) < 4) or (StrLen($Pass) > 10)) {
				echo "Le mot de passe doit être compris entre 4 et 10 caractères.";
			} elseif ((StrLen($Repass) < 4) or (StrLen($Repass) > 10)) {
				echo "Le mot de passe de confirmation doit être compris entre 4 et 10 caractères.";
			} elseif ((StrLen($Email) < 4) or (StrLen($Email) > 25)) {
				echo "L'adresse email doit être comprise entre 4 et 25 caractères.";
			} elseif ($Pass != $Repass) {
				echo "Les mots de passe ne correspondent pas.";
			} else {
				$Salt = $Login . $Pass;
				$Salt = md5($Salt);
				$Salt = "0x" . $Salt;
				$date = date("Y-m-d H:i:s");

				MySQL_Query("call adduser('$Login', '$Salt', '0', '0', '0', '0', '$Email', '0', '0', '0', '0', '0', '0', '0', '$date', '', '$Salt')") or die("Can't execute query.");
				$sql = "select ID from users where `name`='$Login'";
				$res = mysql_query($sql);
				$row = mysql_fetch_row($res);
				mysql_free_result($res);
				$id = implode($row);
				$date = date("Y-m-d H:i:s");
				$sql = "insert into usecashnow(userid, zoneid, sn, aid, point, cash, status, creatime) values ('$id', '1', '1', '1', '99999900000', '999999000', '3', '$date')";
				mysql_query($sql);
				mysql_close();

				echo ("<script type='text/javascript'> alert('Bienvenue sur Saint Seiya Online". " " . $Login . " ！');location.href='welcome.php';</script>");
			}
		}
	}
	?>