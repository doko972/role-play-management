<?php
include '_database.php';
include '_config.php';

function generateToken() {
    if (!isset($_SESSION['token']) || !isset($_SESSION['tokenExpire']) || $_SESSION['tokenExpire'] < time()) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 60 * 15;
    }
}

function isRefererOk(): bool {
    global $globalUrl;
    return isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], $globalUrl);
}

function isTokenOk(?array $data = null): bool {
    if (!is_array($data)) $data = $_REQUEST;
    return isset($_SESSION['token']) && isset($data['token']) && $_SESSION['token'] === $data['token'];
}

function addError(string $errorMsg): void {
    if (!isset($_SESSION['errorsList'])) {
        $_SESSION['errorsList'] = [];
    }
    $_SESSION['errorsList'][] = $errorMsg;
}

function redirectTo(string $url): void {
    if (headers_sent()) {
        echo "<script>location.href='$url';</script>";
    } else {
        header('Location: ' . $url);
    }
    exit;
}
function preventCSRF(string $redirectUrl = 'index.php'): void {
    if (!isRefererOk()) {
        addError('referer');
        redirectTo($redirectUrl);
    }
    if (!isTokenOk()) {
        addError('csrf');
        redirectTo($redirectUrl);
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



function checkConnection(array $data): array{
    $error = [];
    if(isset($data['passwd'])){
        $error[] = 'Entrez un mot de passe';
    }

    if(isset($data['passwd']) && strlen($data['passwd']) < 5 ){
        $error[] = 'Le mot de passe doit avoir plus de 5 caractères';
    }
    if(isset($data['passwd']) && strlen($data['passwd']) > 25 ){
        $error[] = 'Le mot de passe doit avoir moins de 25 caractères';
    }
    if(!isset($data['email']) || filter_var($data['email'], FILTER_VALIDATE_EMAIL === false)){
    $error[] = 'vous devez entrer un email valide';
    }
    return $error;
}
?>