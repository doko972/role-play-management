<?php
$DB_HOST = 'db'; // your address ip - here is db = docker container
$DB_NAME = 'roleplay'; // the database name
$DB_USER = 'user'; // user name
$DB_PWD = 'password'; // password

try {
    $dbCo = new PDO(
        'mysql:host=' . $DB_HOST 
        . ';dbname=' . $DB_NAME 
        . ';charset=utf8',
        $DB_USER,
        $DB_PWD
    );
    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('ERREUR CONNEXION MYSQL: ' . $e->getMessage());
}
// var_dump($_ENV);
// require __DIR__ . '/../vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
// $dotenv->load();

// try {
//     $dbCo = new PDO(
//         'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8',
//         $_ENV['DB_USER'],
//         $_ENV['DB_PWD']
//     );

?>