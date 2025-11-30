<h1>Créer un utilisateur</h1>

<form action="/MVC/user/register" method="POST">

    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" name="username" id="username" required><br><br>

    <label for="email">Email :</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" name="password" id="password" required><br><br>

    <button type="submit">Créer l'utilisateur</button>

</form>

<?php if (!empty($users)) : ?>
    <h2>Utilisateur créé :</h2>
    <p><strong>Nom :</strong> <?= htmlspecialchars($users['username']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($users['email']) ?></p>
<?php endif; ?>
