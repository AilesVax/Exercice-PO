<?php if ($role === 'admin'): ?>
<h2>Chnagez une activité</h2>

<form action="" method="UPDATE">
    <input type="text" name="nom" placeholder="Nom" required><br>
    <input type="number" name="type_id" placeholder="Type" required><br>
    <input type="number" name="places_disponibles" placeholder="Places" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="datetime-local" name="datetime_debut" required><br>
    <input type="number" name="duree" placeholder="Durée (minutes)" required><br>

    <button type="submit">Changez l'activité</button>
</form>
<?php endif; ?>
