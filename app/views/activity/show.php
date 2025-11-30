
<p><strong>Nom :</strong> <?= $reserv['nom'] ?></p>
<p><strong>Description :</strong> <?= $reserv['description'] ?></p>
<p><strong>Date début :</strong> <?= $reserv['datetime_debut'] ?></p>
<p><strong>Durée :</strong> <?= $reserv['duree'] ?> heures</p>
<p><strong>Places disponibles :</strong> <?= $reserv['places_disponibles'] ?></p>

<hr>

<?php if ($role === 'admin'): ?>
    <h2>Modifier / Créer une activité</h2>

    <form action="/index.php?action=updateActivity&id=<?= $reserv['id'] ?>" method="POST">

        <label for="nom">Nom de l'activité :</label>
        <input type="text" name="nom" value="<?= $reserv['nom'] ?>" required><br>

        <label for="type_id">Type :</label>
        <select name="type_id">
            <option value="1">Sport</option>
            <option value="2">Culture</option>
            <option value="3">Loisir</option>
        </select><br>

        <label for="places_disponibles">Places disponibles :</label>
        <input type="number" name="places_disponibles" value="<?= $reserv['places_disponibles'] ?>" required><br>

        <label for="description">Description :</label>
        <textarea name="description" required><?= $reserv['description'] ?></textarea><br>

        <label for="datetime_debut">Date de début :</label>
        <input type="datetime-local" name="datetime_debut" value="<?= $reserv['datetime_debut'] ?>" required><br>

        <label for="duree">Durée (heures) :</label>
        <input type="number" name="duree" value="<?= $reserv['duree'] ?>" required><br>

        <button type="submit">Enregistrer</button>
    </form>

    <br>

    <form action="/index.php?action=deleteActivity&id=<?= $reserv['id'] ?>" method="POST"
          onsubmit="return confirm('Voulez-vous vraiment supprimer cette activité ?');">
        <button type="submit">Supprimer l'activité</button>
    </form>

<?php endif; ?>
