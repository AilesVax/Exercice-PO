<?php
require_once './app/utils/Render.php';
class UserController{
      use Render;



  public function index() : void{

  }  
  
public function register(array $data = []): void {

    if (!empty($data)) {
        $createUser = new UserModel();
        $user = $createUser->createUser($data);

        $this->renderView('user/register', [
            'title' => 'Utilisateur créé',
            'users' =>  $user = [
                'nom' => $_POST['nom'],
                'email' => $_POST['email']
            ]
        ]);
    } else {
        $this->renderView('user/register', [
            'title' => 'Créer un utilisateur'
        ]);
    }
}
 
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