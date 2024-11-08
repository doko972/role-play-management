<?php
include '_database.php';
include '_config.php';

/**
 * Generates a token for CSRF sessions
 * @return void
 */
function generateToken() {
    if (!isset($_SESSION['token']) || !isset($_SESSION['tokenExpire']) || $_SESSION['tokenExpire'] < time()) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 60 * 15;
    }
}

/**
 * Generates a random Token to email validation
 * @return string
 */
function generateTokenEmail() {
    return bin2hex(random_bytes(16));
}

/**
 * Checks if the referrer is correct () / needle in haystack
 * checks if the page that made the current request (the "referrer") matches a specific domain or URL, 
 * defined in a global variable $globalUrl.
 * @return bool
 */
function isRefererOk(): bool {
    global $globalUrl;
    return isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], $globalUrl);
}

/**
 * Checks if the CSRF token is valid
 * @param ?array $data request data (optional)
 * @return bool
 */
function isTokenOk(?array $data = null): bool {
    if (!is_array($data)) $data = $_REQUEST;
    return isset($_SESSION['token']) && isset($data['token']) && $_SESSION['token'] === $data['token'];
}

/**
 * Adds an error message to the session
 * @param string $errorKey error message key from $errors array
 * @return void
 */
function addError(string $errorKey): void {
    if (!isset($_SESSION['error_keys'])) {
        $_SESSION['error_keys'] = [];
    }
    $_SESSION['error_keys'][] = $errorKey;
}

/**
 * Adds a success message to the session
 * @param string $messageKey success message key from $messages array
 * @return void
 */
function addMessage(string $messageKey): void {
    if (!isset($_SESSION['message_keys'])) {
        $_SESSION['message_keys'] = [];
    }
    $_SESSION['message_keys'][] = $messageKey;
}

/**
 * Redirects to a specified URL
 * @param string $url redirect URL
 * @return void
 */
function redirectTo(string $url): void {
    if (headers_sent()) {
        echo "<script>location.href='$url';</script>";
    } else {
        header('Location: ' . $url);
    }
    exit;
}

/**
 * Prevents CSRF attacks by checking the referrer and token
 * @param string $redirectUrl redirect URL in case of failure
 * @return void
 */
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

/**
 * Validates a token against the session token
 * @param mixed $token the token to validate
 * @return bool
 */
function validateToken($token) {
    return $token === $_SESSION['token'];
}

/**
 * Sanitizes user input
 * @param mixed $data data to sanitize
 * @return mixed
 */
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

/**
 * Retrieves the list of online users
 * @param mixed $dbCo database connection
 * @return array
 */
function getOnlineUsers($dbCo) {
    $stmt = $dbCo->prepare('SELECT login 
    FROM users
    WHERE last_activity > DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND is_online = 1');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Updates the user's activity
 * @param mixed $userId user ID in the database
 * @param mixed $dbCo database connection
 * @return void
 */
function updateUserActivity($userId, $dbCo) {
    $stmt = $dbCo->prepare('UPDATE users 
    SET last_activity = NOW(), is_online = 1 
    WHERE id_user = :user_id');
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}

/**
 * Checks the user's login data
 * @param array $data user data (email, password)
 * @return array validation error list
 */
function checkConnection(array $data): array {
    $error = [];
    if (!isset($data['passwd'])) {
        $error[] = 'Enter a password';
    }
    if (isset($data['passwd']) && strlen($data['passwd']) < 5) {
        $error[] = 'Password must be more than 5 characters long';
    }
    if (isset($data['passwd']) && strlen($data['passwd']) > 25) {
        $error[] = 'Password must be less than 25 characters long';
    }
    if (!isset($data['email']) || filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
        $error[] = 'You must enter a valid email';
    }
    return $error;
}

/**
 * Displays a message from the configuration
 * @param string $key Message key
 * @param string $type Message type ('errors', 'messages', or 'text')
 * @return void
 */
function displayMessage($key, $type = 'errors') {
    global $errors, $messages, $text;
    
    $allMessages = [
        'errors' => $errors,
        'messages' => $messages,
        'text' => $text
    ];
    
    if (isset($allMessages[$type][$key])) {
        $cssClass = $type === 'errors' ? 'error-message' : 'success-message';
        echo "<div class='{$cssClass}'>{$allMessages[$type][$key]}</div>";
    }
}

/**
 * Displays all stored messages and clears them from the session
 * @return void
 */
function displayStoredMessages(): void {
    if (isset($_SESSION['error_keys'])) {
        foreach ($_SESSION['error_keys'] as $key) {
            displayMessage($key, 'errors');
        }
        unset($_SESSION['error_keys']);
    }
    
    if (isset($_SESSION['message_keys'])) {
        foreach ($_SESSION['message_keys'] as $key) {
            displayMessage($key, 'messages');
        }
        unset($_SESSION['message_keys']);
    }
}

?>