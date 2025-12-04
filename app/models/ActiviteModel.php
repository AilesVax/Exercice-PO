<?php

class ActiviteModel extends Bdd {
 
  public function __construct(){
    parent::__construct();
  }
    
  public function getAllActivities(): array {
    $activites = $this->co->prepare('SELECT * FROM activities');
    $activites->execute();
    return $activites->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getActivityById(int $id) : array {
    $activite = $this->co->prepare('SELECT * FROM activities WHERE id = :id');
    $activite->execute(['id' => $id]);
    return $activite->fetch(PDO::FETCH_ASSOC);
  }
    
  public function getPlacesLeft(int $activityId): int{
    $places = $this->co->prepare('SELECT places_disponibles FROM activities WHERE id = :id');
    $places->execute(['id' => $activityId]);
    $place = $places->fetch(PDO::FETCH_ASSOC); 

    if (!$place) {
        return 0;
    }

    $places_disponibles = (int) $place['places_disponibles']; 

    $id = $this->co->prepare('SELECT COUNT(*) as nb_reservations FROM reservations WHERE activite_id = :id AND etat = 1');   
    $id->execute(['id' => $activityId]);
    $reservation = $id ->fetch(PDO::FETCH_ASSOC);  

    $nb_reservations = (int) $reservation['nb_reservations']; 
    $place_total = $places_disponibles - $nb_reservations;

    return max($place_total,0);
  }
}
