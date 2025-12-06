
<?php if ($role === 'admin') : ?>
<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($reservations)) : ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID Réservation</th>
            <th>Activité</th>
            <th>Utilisateur</th>
            <th>Date</th>
            <th>Statut</th>
        </tr>
        <?php foreach ($reservations as $r) : ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= htmlspecialchars($r['activite_nom']) ?></td>
                <td><?= htmlspecialchars($r['prenom'] . ' ' . $r['user_nom']) ?></td>
                <td><?= htmlspecialchars($r['date_reservation']) ?></td>
                <td><?= $r['etat'] == 1 ? 'Confirmée' : 'Annulée' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucune réservation trouvée.</p>
<?php endif; ?>
<?php endif; ?>