<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marinas</title>
    <meta name="keywords" content="Page de choix de personnage parmi les marinas de Poseidon" />
    <meta name="description" content="Jeu de rôle/PVP sur le jeu en ligne (MMO) Saint Seiya Online. Rejoignez nous dans l'aventure et devenez Chevalier d'Athéna, Marinas de Poseidon ou Spectre d'Hades !" />
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container">
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
                echo '<form action="marinas.php" method="get">';
                echo '<button type="submit" class="button__register">Retour à l\'index</button>';
                echo '</form>';

                echo '<img src="' . htmlspecialchars($card['image'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') . '">';
                echo '<div>';
                echo '<h1>' . htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') . '</h1>';
                echo '<p>Class: ' . htmlspecialchars($card['class'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '<p>SSO: ' . htmlspecialchars($card['sso'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '<img src="' . htmlspecialchars($card['imagesso2'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') . ' SSO">';
                echo '<p>Title: ' . htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') . '</p>';
                if (isset($card['mythology']))
                    echo '<p class="animate-text">Histoire: ' . htmlspecialchars($card['mythology'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '</div>';

                echo '<form method="POST" action="manage_story2.php" enctype="multipart/form-data">';
                echo '<input type="hidden" name="id" value="' . htmlspecialchars($card['id'], ENT_QUOTES, 'UTF-8') . '">';

                echo '<button type="button" class="accordion">Histoire</button>';
                echo '<div class="panel">';
                echo '<label for="mythology">Histoire:</label>';
                echo '<textarea name="mythology" id="mythology">' . (isset($card['mythology']) ? htmlspecialchars($card['mythology'], ENT_QUOTES, 'UTF-8') : '') . '</textarea>';
                echo '</div>';

                echo '<label for="new_image">Nouvelle image:</label>';
                echo '<input type="file" name="new_image" id="new_image">';

                echo '<button type="submit" name="action" value="update" class="btn-add-event--register">Mettre à jour l\'histoire</button>';

                echo '</form>';
            } else {
                echo '<p>Carte non trouvée.</p>';
            }
            ?>
        </div>
    </main>
    <script src="js/scripts.js"></script>
    <script src="js/accordeon.js"></script>
    <?php include 'footer.php'; ?>
</body>

</html>