<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des activités</title>
    <link rel="stylesheet" href="/MVC/app/public/css/style.css">
</head>
<body>
<?php if ($role === 'admin') : ?>
    <?php foreach ($allUser as $user) : ?>
        <tr>
            <td><?= htmlspecialchars($user['prenom']) ?></td><br>
            <td><?= htmlspecialchars($user['nom']) ?></td><br>
            <td><?= htmlspecialchars($user['email']) ?></td><br>
            <td><?= htmlspecialchars($user['role']) ?></td><br>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>


<?php if ($role === 'user') : ?>

    <p>Vous ne pouvez pas acceder a cette page </p>
<?php endif; ?>
</body>
</html>