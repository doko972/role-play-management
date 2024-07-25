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
    $stmt = $dbCo->prepare("SELECT id_user, login, truename, email, role FROM users");
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section>
            <h1>Gestion des Utilisateurs</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom d'utilisateur</th>
                        <th>Nom Réel</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id_user']); ?></td>
                        <td><?php echo htmlspecialchars($user['login']); ?></td>
                        <td><?php echo htmlspecialchars($user['truename']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td>
                            <form action="update_role.php" method="post">
                                <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                                <select name="role">
                                    <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>Utilisateur</option>
                                    <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Administrateur</option>
                                </select>
                                <input type="submit" value="Mettre à jour">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>