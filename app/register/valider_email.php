<?php
include '../includes/_database.php';
include '../includes/_functions.php';

if (isset($_GET['token'])) {
    $token = sanitizeInput($_GET['token']);

    try {
        $stmt = $dbCo->prepare("UPDATE users SET is_verified = 1, validation_token = NULL WHERE validation_token = :token");
        $stmt->bindParam(':token', $token);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            addMessage('email_verified');
            header("Location: ../login.php");
            exit();
        } else {
            addError('invalid_token');
        }
    } catch (PDOException $e) {
        addError('verification_failed');
        error_log('Email verification failed: ' . $e->getMessage());
    }
} else {
    addError('missing_token');
}

header("Location: ../login.php");
exit();
?>