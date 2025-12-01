<h1>Créer un utilisateur</h1>

<form action="/MVC/user/register" method="POST">

    <label for="prenom">Prénom :</label><br>
    <input type="text" name="prenom" id="prenom" required><br><br>

    <label for="nom">Nom :</label><br>
    <input type="text" name="nom" id="nom" required><br><br>

    <label for="email">Email :</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" name="motdepasse" id="password" required><br><br>

    <button type="submit">Créer l'utilisateur</button>

</form>

<?php if (!empty($users)) : ?>
    <h2>Utilisateur créé :</h2>
    <p><strong>Nom :</strong> <?= htmlspecialchars($users['nom']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($users['email']) ?></p>
<?php endif; ?>
