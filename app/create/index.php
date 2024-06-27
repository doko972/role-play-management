<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="user-scalable=no,width=device-width,initial-scale=1,maximum-scale=1">
	<title>Les Chevaliers du Zodiaque OL</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>
	<?php include 'header.php'; ?>
	<div class="login_cont">
		<div class="login_nav">

		</div>
		<div class="title__margin--register">
				<h1>Saint Seiya Online <br>Rôle Play</h1>
			</div>
		<form action=register.php method=post>
			<div class="input_signup active">
				<input class="input" id="user_name" type="text" name="login"
					aria-label="Nom d'utilisateur (comprenant des lettres/chiffres/underscore)"
					placeholder="Nom d'utilisateur">
				<div class="hint">Veuillez entrer un nom d'utilisateur conforme au format</div>
				<input class="input" id="user_email" type="text" name=email aria-label="Email" placeholder="Email">
				<div class="hint">Veuillez entrer votre email</div>
				<input class="input" id="password" type="password" aria-label="Mot de passe" name=passwd
					placeholder="Mot de passe (au moins 6 caractères)">
				<div class="hint">Veuillez entrer un mot de passe conforme au format</div>
				<input class="input" id="repassword" type="password" name=repasswd aria-label="Mot de passe"
					placeholder="Confirmer le mot de passe">
				<div class="hint">Veuillez confirmer le mot de passe</div>
				<input type="submit" id="submit" class="button" name="button" value="S'inscrire">
			</div>
		</form>
		<br><br>

	</div>
	<?php include 'footer.php'; ?>
</body>

</html>