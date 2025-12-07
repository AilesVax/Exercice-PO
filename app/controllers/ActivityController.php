<?php
require_once './app/utils/Render.php';
require_once './app/models/ActiviteModel.php';

class ActivityController extends Bdd {
    use Render;

    private ActiviteModel $activiteModel;

    public function __construct()
    {
        parent::__construct(); 
        $this->activiteModel = new ActiviteModel();
    }

    public function index(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        
        if ($userId === null) {
            header("Location: /MVC/user/register");
            die('<p>Utilisateur non connecté</p>');
        }
        $roleData = $this->activiteModel->getRoleByUserId($userId);
        $user = $roleData['role'] ?? null;
        
        if (!$user) {
            header("Location: /MVC/user/register");
            die('<p>Utilisateur introuvable</p>');
        }
        

        if ($user === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
            $this->create($_POST);
        }

        $activites = $this->activiteModel->getAllActivities();

        $data = [
            'title' => 'Liste des activités',
            'reserv' => $activites,
            'role' => $user
        ];

        $this->renderView('activity/index', $data);
    }

    public function show(int $id): void
{
    if ($id <= 0) {
        die('<p>ID d\'activité invalide</p>');
    }

    $userId = $_SESSION['user_id'] ?? null;
    
    if ($userId === null) {
        header("Location: /MVC/user/register");
        die('<p>Utilisateur non connecté</p>');
    }

        $roleData = $this->activiteModel->getRoleByUserId($userId);
        $user = $roleData['role'] ?? null;
    
    if (!$user) {
        header("Location: /MVC/user/register");
        die('<p>Utilisateur introuvable</p>');
    }
    
    if ($user === 'admin' && isset($_POST['update'])) {
        $this->update($id, $_POST);
    }

    if ($user === 'admin' && isset($_POST['delete'])) {
        $this->delete($id);
        header("Location: /MVC/activity");
        exit;
    }
    $placesLeft = $this->activiteModel->getPlacesLeft($id);
    $details = $this->activiteModel->getActivityById($id);

    if (!$details) {
        die('<p>Activité introuvable</p>');
    }

    $data = [
        'title' => 'Détail de l\'activité',
        'reserv' => $details,
        'role' => $user,
        'placesLeft' => $placesLeft

    ];

    $this->renderView('activity/show', $data);
}


    public function create(array $data): void
    {
        $Insert = $this->co->prepare("
            INSERT INTO activities (nom, type_id, places_disponibles, description, datetime_debut, duree)
            VALUES (:nom, :type_id, :places, :description, :date, :duree)
        ");

        $Insert->execute([
            'nom'        => $data['nom'],
            'type_id'    => $data['type_id'],
            'places'     => $data['places_disponibles'],
            'description'=> $data['description'],
            'date'       => $data['datetime_debut'],
            'duree'      => $data['duree']
        ]);
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