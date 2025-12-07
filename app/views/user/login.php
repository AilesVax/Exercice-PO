<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des activités</title>
    <link rel="stylesheet" href="/MVC/app/public/css/style.css">
</head>
<body>
<h1><?= $title ?></h1>

<?php if (!empty($error)) : ?>
    
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="" method="POST">
    
    <label for="email">Email :</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="motdepasse">Mot de passe :</label><br>
    <input type="password" name="motdepasse" id="motdepasse" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<?php if (!empty($user)) : ?>
    <h2>Bienvenue <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?> !</h2>
     <a href="/MVC/activity">Liste des activitées</a>
<?php endif; ?>
</body>
</html>



