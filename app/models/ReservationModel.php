<?php
require_once 'UserModel.php';
class ReservationModel extends Bdd{

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

    public function __construct()
    {
        parent::__construct(); // autorisé depuis la classe enfant
    }

    public function getReservationsByUserId(int $userId) : array{
        $sql = $this->co->prepare("SELECT * FROM reservations WHERE user_id = :user_id");
        $sql->execute([
            'user_id' => $userId,
            
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    } 

    public function cancelReservation(int $reservationId): bool {
        $sql = $this->co->prepare("UPDATE reservations  SET etat = 0 WHERE id = :id");
        return $sql->execute(['id' => $reservationId]);
    }

    public function reservationDetail(int $reservationId): array{
        $sql = $this->co->prepare("SELECT reservations.* , activities.* FROM reservations JOIN activities ON reservations.activite_id = activities.id WHERE reservations.id = :id");
            $sql->execute(['id' => $reservationId]);

            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
    }

     public function getAllReservations(): array {
        $stmt = $this->co->query("SELECT reservations.*,a.nom AS activite_nom,u.prenom, u.nom AS user_nom
    FROM reservations 
    JOIN activities a ON reservations.activite_id = a.id
    JOIN users u ON reservations.user_id = u.id
    ORDER BY reservations.date_reservation DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoleByUserId(int $id): array {
        $stmt = $this->co->prepare("SELECT role FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


