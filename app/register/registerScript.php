<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}
include '../includes/_database.php';
include '../includes/_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = sanitizeInput($_POST['login']);
  $truename = sanitizeInput($_POST['truename']);
  $email = sanitizeInput($_POST['email']);
  $birthday = sanitizeInput($_POST['birthday']);
  $passwd = sanitizeInput($_POST['passwd']);
  $repasswd = sanitizeInput($_POST['repasswd']);
  $faction = intval($_POST['faction']);
  $token = sanitizeInput($_POST['token']);

  $isValid = true;

  // Validation de la date
  if (!empty($birthday)) {
    $birthDate = DateTime::createFromFormat('Y-m-d', $birthday);
    if ($birthDate && $birthDate->format('Y-m-d') === $birthday) {
      // La date est valide, vérifiez l'âge
      $today = new DateTime();
      $age = $today->diff($birthDate)->y;
      if ($age < 13) {
        addError('invalid_age');
        $isValid = false;
      }
    } else {
      addError('invalid_date_format');
      $isValid = false;
    }
  } else {
    addError('invalid_date_format');
    $isValid = false;
  }

  // Vérification du mot de passe
  if ($passwd !== $repasswd) {
    addError('password_mismatch');
    $isValid = false;
  }

  // Vérification du token CSRF
  if (!validateToken($token)) {
    addError('csrf');
    $isValid = false;
  }

  if ($isValid) {
    $hashedPassword = password_hash($passwd, PASSWORD_BCRYPT);
    try {
      $stmt = $dbCo->prepare("INSERT INTO users (login, passwd, truename, email, birthday, creatime, is_online, faction_id, validation_token, is_verified)
      VALUES (:login, :passwd, :truename, :email, :birthday, NOW(), 0, :faction, :validation_token, 0)");
      $stmt->bindParam(':login', $login);
      $stmt->bindParam(':passwd', $hashedPassword);
      $stmt->bindParam(':truename', $truename);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':birthday', $birthday);
      $stmt->bindParam(':faction', $faction);
      $stmt->bindParam(':validation_token', $validation_token);
      if ($stmt->execute()) {
        addMessage('create_success');
        header("Location: ../login.php");
        exit();
      } else {
        addError('registration_failed');
      }
    } catch (PDOException $e) {
      addError('registration_failed');
      error_log('Registration failed: ' . $e->getMessage());
    }
  }
}

// Redirection vers la page d'inscription avec les messages d'erreur
header("Location: register.php");
exit();
?>