<?php
session_start();
include 'includes/_database.php';
include 'includes/_functions.php';

// Check if user is logged in and is an administrator
// isset - session variable
// If this variable is not set (indicating that the user is not logged in), the condition returns true
// If the user is logged in, but his role is not "admin", this condition will also be true
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
generateToken();
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
            <?// Code d'affichage des messages
            if (isset($_SESSION['success_message'])) {
                echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
                unset($_SESSION['success_message']);
            }

            if (isset($_SESSION['error_message'])) {
                echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
            ?>
            <table class="table-array_container">
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th class="table-array-dsb__border--col">ID</th>
                            <th class="table-array-dsb__border--col">Nom RP</th>
                            <th class="table-array-dsb__border--col">Faction</th>
                        </tr>
                        <!-- Ligne principale : ID, Nom RP, Faction -->
                        <tr>
                            <td class="table-array-dsb__border"><?php echo htmlspecialchars($user['id_user']); ?></td>
                            <td class="table-array-dsb__border"><?php echo htmlspecialchars($user['truename']); ?></td>
                            <td class="table-array-dsb__border">
                                <?php
                                // Affiche la faction selon l'ID
                                if ($user['faction_id'] == 1) {
                                    echo htmlspecialchars($text['faction_1']);
                                } elseif ($user['faction_id'] == 2) {
                                    echo htmlspecialchars($text['faction_2']);
                                } elseif ($user['faction_id'] == 3) {
                                    echo htmlspecialchars($text['faction_3']);
                                }
                                ?>
                            </td>
                        </tr>

                        <!-- Ligne supplémentaire : En ligne et actions -->
                        <tr>
                            <td colspan="3" class="table-array-dsb__border">
                                <div class="table-array-dsb__border--alg">
                                    <strong>En ligne : </strong>
                                    <?php if ($user['is_online'] === 1): ?>
                                        <span class="taken-container">
                                            <p class="taken_free"></p>
                                            <span class="taken-font">Connecté</span>
                                        </span>
                                    <?php else: ?>
                                        <span class="taken-container">
                                            <p class="taken"></p>
                                            <span class="taken-font">Déconnecté</span>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="table-array-dsb__border--alg">
                                <strong>Statut :</strong>
                                </div>
                                <div class="table-array-dsb__border--alg">
                                    <form action="update_role.php" method="post"
                                        style="display:inline-block; margin-left:10px;">
                                        <input type="hidden" name="id_user"
                                            value="<?php echo htmlspecialchars($user['id_user']); ?>">
                                        <input type="hidden" name="token"
                                            value="<?= htmlspecialchars($_SESSION['token']); ?>">

                                        <select class="button button__register" name="role" id="role">
                                            <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>
                                                Utilisateur</option>
                                            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>
                                                Administrateur</option>
                                        </select>
                                        <button type="submit" name="update_role" class="button button__register">MaJ Statut</button>

                                        <button type="submit" name="delete_user" class="button button__register"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                            Supprimer le compte
                                        </button>
                                    </form>
                                </div>
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