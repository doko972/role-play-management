<?php
session_start();
include 'includes/_database.php';
include 'includes/_functions.php';

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Récupérer les utilisateurs
try {
    $stmt = $dbCo->prepare("SELECT id_user, login, name, is_online, truename, faction_id, email, role 
    FROM users
    LEFT JOIN characters USING (id_user)
    ");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="icon" href="img/logo.ico">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/scripts.js"></script>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="head-card" role="img" aria-label="Image de tête de carte"></div>
    <main>
        <section class="table_container">
            <h1>Gestion des Utilisateurs</h1>
            <table class="table-array_container">
                <thead class="table-array-dsb">
                    <tr>
                        <th class="table-array-dsb__border">ID</th>
                        <th class="table-array-dsb__border">Nom RP</th>
                        <th class="table-array-dsb__border">Faction</th>
                        <th class="table-array-dsb__border">En Ligne</th>
                        <th class="table-array-dsb__border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="table-array-dsb__border"><?php echo $user['id_user']; ?></td>
                            <td class="table-array-dsb__border"><?php echo $user['truename']; ?></td>
                            <td class="table-array-dsb__border">
                                <?php
                                if ($user['faction_id'] == 1) {
                                    echo $text['faction_1'];
                                } else if ($user['faction_id'] == 2) {
                                    echo $text['faction_2'];
                                } else if ($user['faction_id'] == 3) {
                                    echo $text['faction_3'];
                                }
                                ?>
                            </td>
                            <td class="table-array-dsb__border">
                                <?php
                                if ($user['is_online'] != 1) {
                                    echo ' <p><span class="taken"></span></p>';
                                } else {
                                    echo ' <p><span class="taken_free"></span></p>';
                                }
                                ?>
                            </td>
                            <td class="table-array-dsb__border">
                                <form action="update_role.php" method="post">
                                    <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                                    <select class="button button__register" name="role">
                                        <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>
                                            Utilisateur</option>
                                        <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>
                                            Administrateur</option>
                                    </select>
                                    <input class="button button__register" type="submit" value="Mettre à jour">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>