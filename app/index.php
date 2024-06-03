<?php
// Inclure les fonctions si nécessaire
// include "./include/_functions.php";

// Lire le fichier JSON
try {
    $fileContent = file_get_contents("datas/imgbanq.json");
    $series = json_decode($fileContent, true);
} catch (Exception $e) {
    echo "Something went wrong with the JSON file...";
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>card chevalier</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Galerie des Chevaliers d'Or</h1>
    <div class="gallery">
        <?php
        foreach ($series as $serie) {
            // echo '<div class="card">';
            echo '<a href="details.php?id=' . $serie['id'] . '" target="_blank">';
            echo '<img src="' . $serie['image'] . '" alt="' . $serie['name'] . '">';
            echo '</a>';
            echo '<p>' . $serie['name'] . ' - ' . $serie['constellation'] . '</p>';
            // echo '</div>';
        }
        ?>

    </div>

</body>

</html>