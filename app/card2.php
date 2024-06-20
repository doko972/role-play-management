<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chevalier d'Or</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <div class="card-detail">
            <?php
            $json = file_get_contents('json/marinas.json');
            $cards = json_decode($json, true);
            $card = null;

            $id = isset($_GET['id']) ? intval($_GET['id']) : 1;
            foreach ($cards as $c) {
                if ($c['id'] == $id) {
                    $card = $c;
                    break;
                }
            }

            if ($card) {
                // Bouton de retour à l'index
                echo '<form action="marinas.php" method="get">';
                echo '<button type="submit" class="button__register">Retour à l\'index</button>';
                echo '</form>';

                echo '<img src="' . $card['image'] . '" alt="' . $card['name'] . '">';
                echo '<div>';
                echo '<h1>' . $card['name'] . '</h1>';
                echo '<p>Class: ' . $card['class'] . '</p>';
                echo '<p>SSO: ' . $card['sso'] . '</p>';
                echo '<img src="' . $card['imagesso2'] . '" alt="' . $card['name'] . ' SSO">';
                echo '<p>Title: ' . $card['title'] . '</p>';
                if (isset($card['mythology']))
                    echo '<p class="animate-text">Histoire: ' . $card['mythology'] . '</p>';
                if (isset($card['mythology1']))
                    echo '<p class="animate-text">Histoire 1: ' . $card['mythology1'] . '</p>';
                if (isset($card['mythology2']))
                    echo '<p class="animate-text">Histoire 2: ' . $card['mythology2'] . '</p>';
                echo '</div>';

                // Formulaire pour créer ou modifier les champs
                echo '<form method="POST" action="manage_story.php" enctype="multipart/form-data">';
                echo '<input type="hidden" name="id" value="' . $card['id'] . '">';

                // Accordéon pour les champs histoire
                echo '<button type="button" class="accordion">Histoire</button>';
                echo '<div class="panel">';
                echo '<label for="mythology">Histoire:</label>';
                echo '<textarea name="mythology" id="mythology">' . (isset($card['mythology']) ? $card['mythology'] : '') . '</textarea>';
                echo '</div>';

                echo '<button type="button" class="accordion">Histoire 1</button>';
                echo '<div class="panel">';
                echo '<label for="mythology1">Histoire 1:</label>';
                echo '<textarea name="mythology1" id="mythology1">' . (isset($card['mythology1']) ? $card['mythology1'] : '') . '</textarea>';
                echo '</div>';

                echo '<button type="button" class="accordion">Histoire 2</button>';
                echo '<div class="panel">';
                echo '<label for="mythology2">Histoire 2:</label>';
                echo '<textarea name="mythology2" id="mythology2">' . (isset($card['mythology2']) ? $card['mythology2'] : '') . '</textarea>';
                echo '</div>';

                // Champ de fichier pour télécharger une nouvelle image
                echo '<label for="new_image">Nouvelle image:</label>';
                echo '<input type="file" name="new_image" id="new_image">';

                // Deux boutons: un pour créer/modifier
                echo '<button type="submit" name="action" value="create" class="btn-add-event--register">Créer l\'histoire</button>';
                echo '<button type="submit" name="action" value="update" class="btn-add-event--register">Mettre à jour l\'histoire</button>';

                echo '</form>';
            } else {
                echo '<p>Card not found.</p>';
            }
            ?>
        </div>
    </div>
    <script src="js/scripts.js"></script>
    <script src="js/accordeon.js"></script>
</body>

</html>