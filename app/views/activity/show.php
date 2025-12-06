<h1>Détail de l'activité : <?= htmlspecialchars($reserv['nom']) ?></h1>

<p><strong>Description :</strong> <?= htmlspecialchars($reserv['description']) ?></p>
<p><strong>Places disponibles :</strong> <?= $reserv['places_disponibles'] ?></p>
<p><strong>Date début :</strong> <?= date('d/m/Y à H:i', strtotime($reserv['datetime_debut'])) ?></p>
<p><strong>Durée :</strong> <?= $reserv['duree'] ?> heures</p>

<a href="/MVC">Retour à la liste</a>

<?php if ($role === 'admin') : ?>
    <hr>
    <h2>Modifier l'activité</h2>

    <form action="/activity/show?id=<?= $reserv['id'] ?>" method="POST">
        <input type="hidden" name="update" value="1">

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($reserv['nom']) ?>" required><br>

        <label>Description :</label>
        <textarea name="description"><?= htmlspecialchars($reserv['description']) ?></textarea><br>

        <label>Type d'activité :</label>
        <input type="number" name="type_id" value="<?= $reserv['type_id'] ?>" required><br>

        <label>Places disponibles :</label>
        <input type="number" name="places_disponibles" value="<?= $reserv['places_disponibles'] ?>" required><br>

        <label>Date de début :</label>
        <input type="datetime-local" name="datetime_debut" value="<?= date('Y-m-d\TH:i', strtotime($reserv['datetime_debut'])) ?>" required><br>

        <label>Durée (heures) :</label>
        <input type="number" name="duree" value="<?= $reserv['duree'] ?>" required><br>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <hr>
    <h2>Supprimer l'activité</h2>
    <form action="/activity/show?id=<?= $reserv['id'] ?>" method="POST"
          onsubmit="return confirm('Voulez-vous vraiment supprimer cette activité ?');">
        <input type="hidden" name="delete" value="1">
        <button type="submit">Supprimer</button>
    </form>
<?php endif; ?>