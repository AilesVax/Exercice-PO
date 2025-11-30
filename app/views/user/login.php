<h1><?= $title ?></h1>

<?php if (!empty($error)) : ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="/user/login" method="POST">
    <label for="email">Email :</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="motdepasse">Mot de passe :</label><br>
    <input type="password" name="motdepasse" id="motdepasse" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<?php if (!empty($user)) : ?>
    <h2>Bienvenue <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?> !</h2>
<?php endif; ?>
