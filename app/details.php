<?php
try {
    $fileContent = file_get_contents("datas/imgbanq.json");
    $series = json_decode($fileContent, true);
} catch (Exception $e) {
    echo "Something went wrong with the JSON file...";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chevalier d'Or</title>
</head>
<body>
    
<?php

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Rechercher la série correspondant à l'ID
$serieDetails = null;
foreach ($series as $serie) {
    if ($serie['id'] === $id) {
        $serieDetails = $serie;
        break;
    }
}

// Afficher les détails de la série
if ($serieDetails) {
    echo '<div class="card">';
    echo '<h1>' . $serieDetails['name'] . '</h1>';
    echo '<img src="' . $serieDetails['image'] . '" alt="' . $serieDetails['name'] . '">';
    echo '<h1>' . $serieDetails['class'] . '</h1>';
    echo '<h2>' . $serieDetails['Titre'] . '</h2>';
    echo  '<p>' . $serieDetails['mythologie'] . '</p>';
    echo '<img src="' . $serieDetails['imagesso2'] . '" alt="' . $serieDetails['namesso2'] . '">';
    echo '<p>' . $serieDetails['namesso2'] . ' - ' . $serieDetails['constellation'] . '</p>';
    echo '<img src="' . $serieDetails['imagesso3'] . '" alt="' . $serieDetails['namesso3'] . '">';
    echo '<p>' . $serieDetails['namesso3'] . ' - ' . $serieDetails['constellation'] . '</p>';
    echo '</div>';
} else {
    echo '<p>Série non trouvée.</p>';
}
?>
</body>
</html>