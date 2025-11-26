<?php
 echo '<h1>Liste des utilisateur</h1>';

foreach ($users as $user) {
  echo '<h2>'. $user->getEmail() .'</h2>';
}
