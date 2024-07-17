<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}

include '../includes/_database.php';
include '../includes/_functions.php';

generateToken();

// Récupérer les factions
$factions = [];
try {
  $stmt = $dbCo->prepare("SELECT * FROM faction");
  $stmt->execute();
  $factions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = sanitizeInput($_POST['login']); //
  $truename = sanitizeInput($_POST['truename']);
  $email = sanitizeInput($_POST['email']);
  $birthday = sanitizeInput($_POST['birthday']);
  $passwd = sanitizeInput($_POST['passwd']);
  $repasswd = sanitizeInput($_POST['repasswd']);
  $faction = intval($_POST['faction']);
  $token = sanitizeInput($_POST['token']);

  // birthday format
  $date_parts = explode('/', $birthday);
  if (count($date_parts) == 3 && checkdate($date_parts[1], $date_parts[0], $date_parts[2])) {
    $formatted_birthday = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
  } else {
    $error_message = "Format de date invalide. Utilisez Jour/Mois/Année (JJ/MM/AAAA).";
  }

  if (!isset($error_message) && validateToken($token)) {
    if ($passwd === $repasswd) {
      $hashedPassword = password_hash($passwd, PASSWORD_BCRYPT);

      try {
        $stmt = $dbCo->prepare("INSERT INTO users (login, passwd, truename, email, birthday, creatime, is_online, faction_id) 
        VALUES (:login, :passwd, :truename, :email, :birthday, NOW(), 0, :faction)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':passwd', $hashedPassword);
        $stmt->bindParam(':truename', $truename);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':birthday', $formatted_birthday);
        $stmt->bindParam(':faction', $faction);

        if ($stmt->execute()) {
          header("Location: ../login.php");
          exit();
        } else {
          $error_message = "Erreur lors de l'enregistrement!";
        }
      } catch (PDOException $e) {
        $error_message = 'Erreur : ' . $e->getMessage();
      }
    } else {
      $error_message = "Les mots de passe ne correspondent pas!";
    }
  } else {
    $error_message = "Mauvaise saisie";
  }
}
?>