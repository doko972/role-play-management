<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chevalier d'Or Toutes les Cartes</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header class="sticky">
    <nav class="navbar">
      <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
          <span class="line line1"></span>
          <span class="line line2"></span>
          <span class="line line3"></span>
        </div>
        <ul class="menu-items">
          <li><button class="btn-add-event--register--nav "><a href="index.php.php">Accueil</a></button></li>
          <li><input type="checkbox" id="athena-toggle">
            <button class="btn-add-event--register--nav "><a href="saint.php">Athena</a></button>
          </li>
          <li>
            <input type="checkbox" id="athena-toggle">
            <button class="btn-add-event--register--nav"><a href="#">Poseidon</a></button>
          </li>
          <li>
            <input type="checkbox" id="athena-toggle">
            <button class="btn-add-event--register--nav"><a href="#">Hades</a></button>
          </li>
          <li><button class="btn-add-event--register--nav"><a href="calendrier/calendar.html">Calendrier</a></button>
          </li>
          <li><button class="btn-add-event--register--nav"><a href="https://discord.gg/3zkTwdDnhc">Discord</a></button>
          </li>
          <li><button class="btn-add-event--register--nav"><a href="carousel/carousel.html">Le jeu</a></button></li>
          <li><button class="btn-add-event--register--nav"><a href="login.html">Connexion</a></button></li>
        </ul>
      </div>
    </nav>
  </header>
  <!--end Header-->
    <div class="container">
        <?php
        $json = file_get_contents('json/cards.json');
        $cards = json_decode($json, true);

        if ($cards) {
            foreach ($cards as $card) {
                echo '<div class="card">';
                echo '<a href="card.php?id=' . $card['id'] . '">';
                echo '<img src="' . $card['image'] . '" alt="' . $card['name'] . '">';
                echo '<p>' . $card['name'] . '</p>';
                echo '</a>';
                echo '</div>';
                error_log('Link generated: card.php?id=' . $card['id']);
            }
        } else {
            echo '<p>No cards found.</p>';
        }
        ?>
    </div>
</body>

</html>