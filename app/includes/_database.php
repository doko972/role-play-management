<?php
// var_dump($_ENV);

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    $dbCo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8',
        $_ENV['DB_USER'],
        $_ENV['DB_PWD']
    );

    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('ERREUR CONNEXION MYSQL' . $e->getMessage());
}

// var_dump($_ENV);

// try {
//     $dbConnect = new PDO(
//         'mysql:host=db;
//             dbname=roleplay;
//             charset=utf8',
//         'tama',
//         'tekmate'
//     );
//     $dbConnect->setAttribute(
//         PDO::ATTR_DEFAULT_FETCH_MODE,
//         PDO::FETCH_ASSOC
//     );

// } catch (Exception $e) {
//     die('Erreur connexion mysql' . $e->getMessage());
// }