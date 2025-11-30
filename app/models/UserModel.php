<?php

class UserModel extends Bdd{
 
  public function __construct(){
    parent::__construct();
  }
 
 
  // public function findOneById(int $id): User | false
  // {
  //   $users = $this->co->prepare('SELECT * FROM User WHERE id = :id LIMIT 1');
  //   $users->setFetchMode(PDO::FETCH_CLASS, 'User');
  //   $users->execute([
  //     'id' => $id
  //   ]);
 
  //   return $users->fetch();
  // }

  public function logUser(string $email, string $motdepasse): array{

 

    $sql = $this->co->prepare('SELECT * from Users WHERE email = :email LIMIT 1');
    $sql->execute(["email" => $email]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($motdepasse, $user["motdepasse"])){
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



public function createUser(array $data) : bool{
  $sql = $this->co->prepare("INSERT INTO user (prenom,nom,email, motdepasse) VALUES(:prenom,:nom,:email,:motdepasse)");
  if($sql->execute([
    'prenom' => $data['prenom'],
    'nom' => $data['nom'],
    'email' => $data['email'],
    'motdepasse' => $data['motdepasse']
  ])){
    return ['prenom' => $data['prenom'],
    'nom' => $data['nom'],
    'email' => $data['email'],
    'motdepasse' => $data['motdepasse']];
  }
return false;
} 


  public function getAllUsers(): array
  {
    $users = $this->co->prepare('SELECT prenom FROM User');
    $users->execute();
 
    return $users->fetchAll(PDO::FETCH_CLASS, 'User');
  }

}