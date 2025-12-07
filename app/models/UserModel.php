<?php

class UserModel extends Bdd{
 
  public function __construct(){
    parent::__construct();
  }

// se connecter
  public function logUser(string $email, string $motdepasse): array{
    $sql = $this->co->prepare('SELECT * from Users WHERE email = :email LIMIT 1');
    $sql->execute(["email" => $email]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if($user && $user['motdepasse'] === $motdepasse){
      $_SESSION['user_id'] = $user['id'];
      return [
            "id"     => $user["id"],
            "email"  => $user["email"],
            "prenom" => $user["prenom"],
            "nom"    => $user["nom"],
            "role"   => $user["role"]
        ];
    }
    
return [];

}


// creer un utilisateur
public function createUser(array $data) : bool{
  $sql = $this->co->prepare("INSERT INTO Users (prenom,nom,email, motdepasse) VALUES(:prenom,:nom,:email,:motdepasse)");
  return $sql->execute([
    'prenom' => $data['prenom'],
    'nom' => $data['nom'],
    'email' => $data['email'],
    'motdepasse' => $data['motdepasse']
  ]);
  }


// avoir tous les utilisateurs
  public function getAllUsers(): array
  {
    $users = $this->co->prepare('SELECT * FROM Users');
    $users->execute();
 
    return $users->fetchAll(PDO::FETCH_ASSOC);
  }

  // prendre utilisateur par leur role
public function getRoleByUserId(int $id): string
{
    $stmt = $this->co->prepare('SELECT role FROM users WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['role'] ?? '';
}
}