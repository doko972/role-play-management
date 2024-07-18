<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enregistrement</title>
<? 
	include "config.php";
		
	$Data = '<form action=register.php method=post>
	Login:  
	<br><input type=text name=login><br><br>
	password:
	<br><input type=password name=passwd><br><br>
	Enter password again:
	<br><input type=password name=repasswd><br><br>
	Email:
	<br><input type=text name=email><br><br>
	<input type=submit name=submit value="Confirm registration">
	</form>';
	
	if (isset($_POST['login']))
		{
			$Link = MySQL_Connect($DBHost, $DBUser, $DBPassword) or die ("Erreur de connexion");
			MySQL_Select_Db($DBName, $Link) or die ("Database ".$DBName." do not exists.");
			
			$Login = $_POST['login'];
			$Pass = $_POST['passwd'];
			$Repass = $_POST['repasswd'];
			$Email = $_POST['email'];
			
			$Login = StrToLower(Trim($Login));
			$Pass = StrToLower(Trim($Pass));
			$Repass = StrToLower(Trim($Repass));
			$Email = Trim($Email);
	
		if (empty($Login) || empty($Pass) || empty($Repass) || empty($Email))
			{
			    echo "Tous les champs sont vides.";
			}
		
		
		elseif (preg_match("/[^0-9a-zA-Z_-]/", $Login, $Txt))
			{
				echo "Le nom d utilisateur est incorrect.";
			}
			
		elseif (preg_match("/[^0-9a-zA-Z_-]/", $Pass, $Txt))
			{
				echo "Veuillez saisir le mot de passe correctement";	
			}
		
		elseif (preg_match("/[^0-9a-zA-Z_-]/", $Repass, $Txt))
			{
				echo "Veuillez confirmer le mot de passe.";	
			}
		elseif (StrPos('\'', $Email))
			{
				echo "Email mal saisi";	
			}	
		else
			{
				$Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or ("Can't execute query.");
				
		if (MySQL_Num_Rows($Result))
			{
				echo "Utilisateur <b>".$Login."</b> deja existant";
			}
		
		elseif ((StrLen($Login) < 4) or (StrLen($Login) > 15)) 
		
			{
				echo "Le nom de connexion doit comporter plus de 4 caracteres et moins de 15 caracteres, veuillez le saisir a nouveau.";
			}
			
		elseif ((StrLen($Pass) < 4) or (StrLen($Pass) > 15)) 
		
			{
				echo "Le mot de passe doit comporter plus de 4 caracteres et moins de 15 caracteres, veuillez le saisir a nouveau.";
			}
			
		elseif ((StrLen($Repass) < 4) or (StrLen($Repass) > 15)) 
			{
				echo "Confirmez que le mot de passe doit contenir plus de 4 caracteres et moins de 15 caracteres, veuillez le saisir à nouveau.";
			}
			
		elseif ((StrLen($Email) < 4) or (StrLen($Email) > 25)) 
			{
				echo "e-mail doit comporter plus de 4 chiffres et moins de 25 chiffres veuillez la saisir a nouveau";
			}
		
		elseif ($Pass != $Repass)
			{
				echo "Les mots de passe ne correspondent pas.";
			}		
		else
			{
				$Salt = $Login.$Pass;
				$Salt = md5($Salt);
				$Salt = "0x".$Salt;
				$date=date("Y-m-d H:i:s"); 
				
			MySQL_Query("call adduser('$Login', '$Salt', '0', '0', '0', '0', '$Email', '0', '0', '0', '0', '0', '0', '0', '$date', '', '$Salt')") or die ("Can't execute query.");
                              $sql="select ID from users where `name`='$Login'";
			  $res=mysql_query($sql);
			  $row=mysql_fetch_row($res);
			  mysql_free_result($res);
			  $id = implode($row);
			  $date=date("Y-m-d H:i:s"); 
			  $sql = "insert into usecashnow(userid, zoneid, sn, aid, point, cash, status, creatime) values ('$id', '1', '1', '1', '99999900000', '999999000', '3', '$date')";
			  mysql_query($sql);	
			mysql_close();
			
			echo ("<script type='text/javascript'> alert('Bienvenue sur Saint Seiya Online" . " " .$Login." ！');location.href='welcome.php';</script>");
			}		
		}	
	}
	
	
?>