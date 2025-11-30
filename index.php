<?php
// Chargement de l'autoload de vendor
require './vendor/autoload.php';
// Chargement des variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
 
// Chargement de nos class
// require_once './app/utils/Bdd.php';
// require_once './app/models/User.php';
// require_once './app/models/UserModel.php';
 
// Chargement de notre autoload
require_once './app/utils/Autoload.php';
// Appel de la méthode register qui va recenser notre autoload
Autoload::register();

// Récupération des utilisateurs
// $userModel = new UserModel();
// $users = $userModel->findAll();
// // Affichage des utilisateurs
// var_dump($users);

session_start();
require_once './app/utils/Router.php';

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);

