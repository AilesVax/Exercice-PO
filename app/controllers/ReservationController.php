<?php
require_once './app/utils/Render.php';
class ReservationController{
    use Render;
    private ReservationModel $reservationModel;

    public function __construct() {
        $this->reservationModel = new ReservationModel();
    }

    // afficher toutes les reservations
  public function index(): void
  {
    $user = $_SESSION['user_id'];
    $reservModel = new ReservationModel();
    $reserv = $reservModel->getReservationsByUserId($user);
    $data = [
      'title' => 'Liste des reservations',
      'reserv' => $reserv
    ];
 
    $this->renderView('reservation/index', $data);
  }

// creer la reservation
 public function create(int $activityId): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        $reservationModel = new ReservationModel();
        
        try {
            $reservationModel->createReservation($userId, $activityId);
            $_SESSION['success'] = "Réservation effectuée avec succès !";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        header("Location: /MVC/reservation");
        exit;
    }

    // montrer les details d'une reservation
  public function show(int $id){
      {
    $detailsModel = new ReservationModel();
    $details = $detailsModel->reservationDetail($id);
    $data = [
      'title' => 'activité',
      'act' => $details
    ];
 
    $this->renderView('reservation/show', $data);
  }
  }
  
// annuler une reservation
    public function cancel(int $id){

    $cancelModel = new ReservationModel();
    $cancelModel->cancelReservation($id);

      header('Location: /MVC/reservation/index');
 
      exit;
  
  }
// afficher toutes les reservations effectuer ou annuler avec le faite de prendre le role car visible apr admin
  public function list(): void {
        $userId = $_SESSION['user_id'] ?? null;
        
        $roleData = $this->reservationModel->getRoleByUserId($userId);
        $role = $roleData['role'] ?? null;

        $reservations = $this->reservationModel->getAllReservations();

        $this->renderView('reservation/list', [
            'title' => 'Liste des réservations',
            'reservations' => $reservations,
            'role' => $role
        ]);
    }

}