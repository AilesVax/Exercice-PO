<h1>Liste des activités</h1>

<?php if (empty($reserv)) : ?>
    <p>Aucune activité pour le moment.</p>
<?php else : ?>
    <ul>
        <?php foreach ($reserv as $act) : ?>
            <li>
                <strong><?= htmlspecialchars($act['nom']) ?></strong>
                - <?= htmlspecialchars($act['description']) ?>
                <a href="activity/show?id=<?= $act['id'] ?>">Voir détail</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($role === 'admin') : ?>
    <hr>
    <h2>Créer une nouvelle activité</h2>

    <form action="MVC/activity/create" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required><br>

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
