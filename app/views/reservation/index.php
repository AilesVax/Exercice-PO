<?php foreach ($reserv as $reserve): ?>
    <?php if ($reserve['etat'] == 1): ?>
        <p>
            Activité : <?= htmlspecialchars($reserve['activite_id']) ?><br>
            Date : <?= htmlspecialchars($reserve['date_reservation']) ?><br>
            État : <?= htmlspecialchars($reserve['etat']) ?>
        </p>
        <a href="show/<?= $reserve['activite_id'] ?>">Voir détails</a>
    <?php endif; ?>
<?php endforeach; ?>
