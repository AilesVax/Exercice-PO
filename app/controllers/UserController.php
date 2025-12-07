<?php
require_once './app/utils/Render.php';
class UserController extends Bdd{
      use Render;
 private UserModel $userModel;
    public function __construct()
    {
        parent::__construct(); 
        $this->userModel = new UserModel();
    }

    //  Affiche la liste des utilisateurs + le rôle du user connecté
  public function index() : void{
    $user = new UserModel();
    $allUser = $user->getAllUsers();
    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) die('<p>Utilisateur non connecté</p>');
    $Role = $user->getRoleByUserId($userId);
    $this->renderView('user/index', [
        'allUser' => $allUser,
        'role' => $Role
    ]);
  }  
  
//         Enregistrement d’un nouvel utilisateur
    //   Affiche le formulaire et traite le POST
public function register(): void {

    // Récupération des données POST
    if (!empty($_POST)) {

        $createUser = new UserModel();
        $userCreated = $createUser->createUser($_POST);

        $this->renderView('user/register', [
            'title' => 'Utilisateur créé',
            'users' => [
                'nom' => $_POST['nom'],
                'email' => $_POST['email']
            ]
        ]);
    } 
    else {
        $this->renderView('user/register', [
            'title' => 'Créer un utilisateur'
        ]);
    }
}

        // Connexion utilisateur
    //  Vérifie l’email et le mot de passe, définit la session
public function login(string $email = '', string $mdp = ''): void {

    // Récupérer les POST si les arguments sont vides
        if ($email === '' && $mdp === '' && !empty($_POST)) {
            $email = $_POST['email'];
            $mdp   = $_POST['motdepasse'];
        }
        $logUser = new UserModel();
        $userLog = $logUser->logUser($email, $mdp);
        if (!empty($userLog)) {
            $_SESSION['user_id'] = $userLog['id'];
            $_SESSION['prenom']  = $userLog['prenom'];
            $_SESSION['nom']     = $userLog['nom'];
        }

        $this->renderView('user/login', [
            'title' => 'Connexion',
            'user'  => $userLog
        ]);
    }
// Déconnexion : supprime la session
     public function logout() : void{
      $_SESSION = [];

    // Détruit la session
    session_destroy();
    $this->renderView('user/logout', [
            'title' => 'Decoonexion',
            
        ]);
    exit;
  }  


  // public function findAll(): void
  // {
  //   $userModel = new UserModel();
  //   $users = $userModel->getAllUsers();
 
  //   // require_once './app/views/user/all.php'; remplacer par ce qu'il y a dessous
  //    // Prépatation du tableau à envoyer au layout
  //   $data = [
  //     'title' => 'Liste des utilisateurs',
  //     'users' => $users
  //   ];
 
  //   // Rendu avec layout
  //   $this->renderView('user/all', $data);
  // }
 
  // public function findOneById(int $id): void
  // {
  //   $userModel = new UserModel();
  //   $user = $userModel->findOneById($id);
 
  //   // require_once './app/views/user/one.php';
  //       $data = [
  //     'title' => 'Liste des utilisateurs',
  //     'user' => $user
  //   ];
 
  //   // Rendu avec layout
  //   $this->renderView('user/one', $data);
  // }
}