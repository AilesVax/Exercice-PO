<h1>Détail de la réservation</h1>

<?php if (!empty($act)): ?>

    <div class="reservation-detail">

        <h3>Activité réservée</h3>

        <p><strong>Nom de l’activité :</strong>
            <?= htmlspecialchars($act['nom']) ?>
        </p>

        <p><strong>Description :</strong>
            <?= htmlspecialchars($act['description']) ?>
        </p>

        <p><strong>Date & heure :</strong>
            <?= htmlspecialchars($act['datetime_debut']) ?>
        </p>

        <p><strong>Durée :</strong>
            <?= htmlspecialchars($act['duree']) ?> minutes
        </p>

        <p><strong>Places disponibles :</strong>
            <?= htmlspecialchars($act['places_disponibles']) ?>
        </p>
        <a href=""></a>

    </div>
<form method="post" action="/MVC/reservation/cancel/<?= $act['id'] ?>">
    <button type="submit">Annuler la réservation</button>
</form>

<?php else: ?>

    <p>Aucune réservation trouvée.</p>

<?php endif; ?>
