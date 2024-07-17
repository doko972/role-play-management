<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

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
                <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Accueil</a></li>
                <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'news.php') ? 'active' : ''; ?>" href="news.php">News</a></li>
                <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'saint.php') ? 'active' : ''; ?>" href="saint.php">Athena</a></li>
                <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'marinas.php') ? 'active' : ''; ?>" href="marinas.php">Poseidon</a></li>
                <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'spectres.php') ? 'active' : ''; ?>" href="spectres.php">Hades</a></li>
                <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'forum.php') ? 'active' : ''; ?>" href="forum.php">Forum</a></li>
                <li><a class="btn-add-event--register--nav" href="https://discord.gg/3zkTwdDnhc">Discord</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'login.php') ? 'active' : ''; ?>" href="login.php">Se connecter</a></li>
                <?php else: ?>
                    <li><a class="btn-add-event--register--nav <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>" href="logout.php">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>