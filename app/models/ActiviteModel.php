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
    
public function getPlacesLeft(int $activityId): int{
    $places = $this->co->prepare('SELECT places_disponibles FROM activities WHERE id = :id');
    $places->execute(['id' => $activityId]);
    $place = $places->fetchAll(PDO::FETCH_ASSOC);
    if (!$activityId) {
        return 0;
    }
    $totalPlaces = (int) $activityId['places_disponibles'];
    $id = $this->co->prepare('SELECT COUNT(*) as nb_reservations FROM reservations WHERE activite_id = :id AND etat = 1');   
    $id->execute(['id' => $activityId]);
    $reservation = $id->fetch(PDO::FETCH_ASSOC);    
    return $totalPlaces - $reservation;
    }
}