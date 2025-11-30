<?php 
require_once './app/utils/Render.php';
class ActivityController{
      use Render;

 public function index(int $userId): void
{
    $role = $this->co->prepare("SELECT role FROM users WHERE id = :id");
    $role->execute(['id' => $userId]);
    $user = $role->fetch(PDO::FETCH_ASSOC);
    $Role = $user['role'];

    if ($Role === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        $Insert = $this->co->prepare("
            INSERT INTO activities (nom, type_id, places_disponibles, description, datetime_debut, duree)
            VALUES (:nom, :type_id, :places, :description, :date, :duree)
        ");

        $Insert->execute([
            'nom'        => $_POST['nom'],
            'type_id'    => $_POST['type_id'],
            'places'     => $_POST['places_disponibles'],
            'description'=> $_POST['description'],
            'date'       => $_POST['datetime_debut'],
            'duree'      => $_POST['duree']
        ]);
    }

    $activites = getAllActivities();

    $data = [
        'title' => 'Liste des activités',
        'reserv' => $activites,
        'role' => $role
    ];

    $this->renderView('/', $data);
}

public function show(int $id,int $userId):void {

    $role = $this->co->prepare("SELECT role FROM users WHERE id = :id");
    $role->execute(['id' => $userId]);
    $user = $role->fetch(PDO::FETCH_ASSOC);
    $Role = $user['role'];

    if ($role === 'admin' && isset($_POST['update'])) {
        $this->update($id, $_POST);
    }

    if ($role === 'admin' && isset($_POST['delete'])) {
        $this->delete($id);
    }
    
    $details = getActivityById($id);
    $data = [
        'title' => 'Detail de l"activité',
        'reserv' => $details,
        'role' => $role
    ];
    $this->renderView('activity/show', $data);

}

public function update(int $id, array $data): void
{
    $sql = "UPDATE activities SET nom = :nom, type_id = :type_id, places_disponibles = :places, description = :description, datetime_debut = :date, duree = :duree WHERE id = :id";

    $insert = $this->co->prepare($sql);
    $insert->execute([
        'nom'        => $data['nom'],
        'type_id'    => $data['type_id'],
        'places'     => $data['places_disponibles'],
        'description'=> $data['description'],
        'date'       => $data['datetime_debut'],
        'duree'      => $data['duree'],
        'id'         => $id
    ]);
}

public function delete(int $id): void
{
    $deleteReserv = $this->co->prepare("DELETE FROM reservations WHERE activite_id = :id");
    $deleteReserv->execute(['id' => $id]);

    $delete = $this->co->prepare("DELETE FROM activities WHERE id = :id");
    $delete->execute(['id' => $id]);
}



}


