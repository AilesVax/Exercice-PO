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

    public function getReservationsByUserId(int $userId) : array{
        $sql = $this->co->prepare("SELECT * FROM reservation WHERE id_user = :id_user LIMIT 1 ");
        $sql->execute([
            'id_user' => $userId,
            
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    } 

    public function cancelReservation(int $reservationId): bool {
        $sql = $this->co->prepare("UPDATE etat FROM reservation  SET etat = 0 WHERE id = :id");
        return $sql->execute(['id' => $reservationId]);
    }

}

