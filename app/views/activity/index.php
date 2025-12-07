<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des activités</title>
    <link rel="stylesheet" href="app/public/css/style.css">
</head>
<body>

<h1>Liste des activités</h1>

<?php if (empty($reserv)) : ?>
    <p>Aucune activité pour le moment.</p>
<?php else : ?>
    <ul>
        <?php foreach ($reserv as $act) : ?>
            <li>
                <strong><?= htmlspecialchars($act['nom']) ?></strong>
                 <?= htmlspecialchars($act['description']) ?>
                <a href="activity/show/<?= $act['id'] ?>">Voir détail</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($role === 'admin') : ?>
    <hr>
    <h2>Créer une nouvelle activité</h2>

    <form action="" method="POST">
        <input type="hidden" name="create" value="1">
        <label>Nom :</label>
        <input type="text" name="nom" required><br>
        <label>type :</label>
        <select name="type_id" required>
            <option value="">-- Choisir --</option>
            <option value="1"> 1 - Manège</option>
            <option value="2" > 2 - spectacle</option>
            <option value="3" > 3 - atelier</option>
            <option value="4" > 4 - Jeu / Animation</option>
        </select><br>
        <label>Description :</label>
        <textarea name="description"></textarea><br>

        <label>Places disponibles :</label>
        <input type="number" name="places_disponibles" required><br>

        <label>Date de début :</label>
        <input type="datetime-local" name="datetime_debut" required><br>

        <label>Durée (heures) :</label>
        <input type="number" name="duree" required><br>

        <button type="submit">Créer</button>
    </form>
<?php endif; ?>
<a href="/MVC/reservation">Reservation</a>
<br>
<p><a href="user/logout">Se deconnecter</a></p>
</body>
</html>