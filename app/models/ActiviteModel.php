<?php

Class ActiviteModel extends Bdd{
 
  public function __construct(){
    parent::__construct();
  }
    
public function getAllActivities(): array {
    $activites = $this->co->prepare('SELECT nom FROM activities');
    $activites->execute();
    return $activites->fetchAll(PDO::FETCH_ASSOC);
}

public function getActivityById(int $id) : array {
    $activite = $this->co->prepare('SELECT nom FROM activities WHERE id=$id');
    $activite->execute();
    return $activite->fetchAll(PDO::FETCH_ASSOC);

}
    
}