<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($users)) : ?>
    <ul>
        <?php foreach($users as $user) : ?>
            <li><?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?> - <?= htmlspecialchars($user['email']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun utilisateur trouvé.</p>
<?php endif; ?>