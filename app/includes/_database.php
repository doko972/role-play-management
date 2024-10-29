<?php

// Displays environment variables
// var_dump($_ENV);

// Loading the autoloader and environment variables
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    // Creating the PDO connection with environment variables
    $dbCo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST']
        . ';dbname=' . $_ENV['DB_NAME']
        . ';charset=utf8',
        $_ENV['DB_USER'],
        $_ENV['DB_PWD']
    );

    // Sets the default recovery mode
    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Sets the error mode for exceptions
    $dbCo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    die('ERREUR CONNEXION MYSQL: ' . $e->getMessage());
}
?>