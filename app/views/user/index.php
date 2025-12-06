<?php if ($role === 'admin') : ?>
    <?php foreach ($allUser as $user) : ?>
        <tr>
            <td><?= htmlspecialchars($user['prenom']) ?></td><br>
            <td><?= htmlspecialchars($user['nom']) ?></td><br>
            <td><?= htmlspecialchars($user['email']) ?></td><br>
            <td><?= htmlspecialchars($user['role']) ?></td><br>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>


<?php if ($role === 'user') : ?>

    <p>Vous ne pouvez pas acceder a cette page </p>
<?php endif; ?>
