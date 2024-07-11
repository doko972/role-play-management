<header class="sticky">
    <nav class="navbar" role="navigation" aria-label="Menu principal">
        <div class="navbar-container container">
            <input type="checkbox" name="menu-toggle" id="menu-toggle" aria-label="Ouvrir le menu">
            <div class="hamburger-lines" aria-hidden="true">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
            <ul class="menu-items">
                <li><a class="btn-add-event--register--nav" href="index.php">Accueil</a></li>
                <li><a class="btn-add-event--register--nav" href="news.php">News</a></li>
                <li><a class="btn-add-event--register--nav" href="saint.php">Athena</a></li>
                <li><a class="btn-add-event--register--nav" href="marinas.php">Poseidon</a></li>
                <li><a class="btn-add-event--register--nav" href="spectres.php">Hades</a></li>
                <li><a class="btn-add-event--register--nav" href="https://discord.gg/3zkTwdDnhc">Discord</a></li>
                <!-- <li><a class="btn-add-event--register--nav" href="login.php">Se connecter</a></li>
                <li><a class="btn-add-event--register--nav" href="register.php">S'inscrire</a></li> -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- <li><a class="btn-add-event--register--nav" href="login.php">Se connecter</a></li> -->
                    <li><a class="btn-add-event--register--nav" href="register.php">S'inscrire</a></li>
                <?php else: ?>
                    <!-- <li><a href="profile.php">Mon Profil</a></li> -->
                    <li><a class="btn-add-event--register--nav" href="logout.php">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>