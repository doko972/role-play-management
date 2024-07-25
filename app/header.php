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
                <li>
                    <input type="checkbox" id="athena-toggle">
                    <a class="btn-add-event--register--nav" href="#">Factions</a>
                    <ul class="submenu">
                        <li><a class="btn-add-event--register--nav" href="saint.php">Chevaliers</a></li>
                        <li><a class="btn-add-event--register--nav" href="marinas.php">Marinas</a></li>
                        <li><a class="btn-add-event--register--nav" href="spectres">Spectres</a></li>
                    </ul>
                </li>

                <!-- <li><a class="btn-add-event--register--nav" href="saint.php">Chevaliers</a></li>
                <li><a class="btn-add-event--register--nav" href="marinas.php">Marinas</a></li>
                <li><a class="btn-add-event--register--nav" href="spectres.php">Spectres</a></li> -->
                <li><a class="btn-add-event--register--nav" href="forum.php">Forum</a></li>
                <li><a class="btn-add-event--register--nav" href="useringame/account.php">Jouer en ligne</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a class="btn-add-event--register--nav" href="login.php">Connexion</a></li>
                <?php else: ?>
                    <li><a class="btn-add-event--register--nav" href="logout.php">Déconnexion</a></li>

                    <!--condition pour afficher le lien vers le tableau de bord uniquement pour les administrateurs-->
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a class="btn-add-event--register--nav" href="dashboard.php">Tableau de Bord</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>