<?php
include '_database.php';

function generateToken() {
    if (!isset($_SESSION['token']) || !isset($_SESSION['tokenExpire']) || $_SESSION['tokenExpire'] < time()) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 60 * 15;
    }
}

function validateToken($token) {
    return $token === $_SESSION['token'];
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function getOnlineUsers($dbCo) {
    $stmt = $dbCo->prepare('SELECT login FROM users WHERE last_activity > DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND is_online = 1');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Met à jour l'activité de l'utilisateur
 * @param mixed $userId id de l'utilisateur dans la base de données
 * @param mixed $dbCo connexion à la base de données
 * @return void
 */
function updateUserActivity($userId, $dbCo) {
    $stmt = $dbCo->prepare('UPDATE users SET last_activity = NOW(), is_online = 1 WHERE id_user = :user_id');
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}
?>