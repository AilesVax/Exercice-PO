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

    if ($Role === 'admin' && $_SERVER['REQUEST_METHOD'] === 'UPDATE') {
        update(getActivityById($id));
    }

    if ($Role === 'admin' && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        delete($id);
    }
    $details = getActivityById($id);
    $data = [
        'title' => 'Detail de l"activité',
        'reserv' => $details,
        'role' => $role
    ];
    $this->renderView('activity/show', $data);

}







}


