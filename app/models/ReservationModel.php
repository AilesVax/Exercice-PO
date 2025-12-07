<?php
require_once 'UserModel.php';
class ReservationModel extends Bdd{


    public function __construct()
    {
        parent::__construct(); 
    }
    // crrer une reservation 
    public function createReservation(int $userId, int $activityId) : bool{
        $sql = $this->co->prepare("INSERT INTO reservations (user_id,activite_id) VALUES(:user_id,:activite_id)");
        if($sql->execute([
            'user_id' => $userId,
            'activite_id' => $activityId
        ])){
    return true;
  }
return false;
} 

// prendre reservation par l'id
    public function getReservationsByUserId(int $userId) : array{
        $sql = $this->co->prepare("SELECT * FROM reservations WHERE user_id = :user_id");
        $sql->execute([
            'user_id' => $userId,
            
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    } 
// retirer une reservation
    public function cancelReservation(int $reservationId): bool {
        $sql = $this->co->prepare("UPDATE reservations SET etat = 0 WHERE id = :id");
        return $sql->execute(['id' => $reservationId]);
    }

    // detail d'une reservation
    public function reservationDetail(int $reservationId): array{
        $sql = $this->co->prepare("SELECT 
        reservations.id AS reservation_id,
        reservations.user_id,
        reservations.activite_id,
        reservations.date_reservation,
        
        activities.id AS activity_id,
        activities.nom,
        activities.description,
        activities.datetime_debut,
        activities.duree,
        activities.places_disponibles

    FROM reservations
    JOIN activities 
        ON reservations.activite_id = activities.id
    WHERE reservations.id = :id");
            $sql->execute(['id' => $reservationId]);

            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
    }
// detail de toutes les reservations
     public function getAllReservations(): array {
        $stmt = $this->co->query(" SELECT reservations.*, activities.nom AS activite_nom, users.prenom AS user_prenom, users.nom AS user_nom FROM reservations
        JOIN activities 
        ON reservations.activite_id = activities.id
        JOIN users 
        ON reservations.user_id = users.id
        ORDER BY reservations.date_reservation DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // prendre le role de l(utilisateur)
    public function getRoleByUserId(int $id): array {
        $stmt = $this->co->prepare("SELECT role FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


