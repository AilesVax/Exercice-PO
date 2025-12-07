<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des activités</title>
    <link rel="stylesheet" href="/MVC/app/public/css/style.css">
</head>
<body>
<?php foreach ($reserv as $reserve): ?>
    <?php if ($reserve['etat'] == 1): ?>
        <p>
            Activité : <?= htmlspecialchars($reserve['activite_id']) ?><br>
            Date : <?= htmlspecialchars($reserve['date_reservation']) ?><br>
            État : <?= htmlspecialchars($reserve['etat']) ?>
        </p>
        <a href="/MVC/reservation/show/<?= $reserve['id'] ?>">Voir détails</a>
    <?php endif; ?>
<?php endforeach; ?> 
<br>
<a href="/MVC/activity">Liste des activitées</a>
</body>
</html>