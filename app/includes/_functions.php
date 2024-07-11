<?php
// session_start();

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