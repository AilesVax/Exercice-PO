<?php
require_once './app/utils/Render.php';
class ReservationController{
    use Render;
    private ReservationModel $reservationModel;

    public function __construct() {
        $this->reservationModel = new ReservationModel();
    }
  public function index(): void
  {
    $user = $_SESSION['user_id'];;
    $reservModel = new ReservationModel();
    $reserv = $reservModel->getReservationsByUserId($user);
    $data = [
      'title' => 'Liste des reservations',
      'reserv' => $reserv
    ];
 
    $this->renderView('reservation/index', $data);
  }


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
  

    public function cancel(int $id){

    $cancelModel = new ReservationModel();
    $cancelModel->cancelReservation($id);

      header('Location: /MVC/reservation/index');
 
      exit;
  
  }

  public function list(): void {
        // Vérifier si utilisateur connecté
        $userId = $_SESSION['user_id'] ?? null;
        
        $roleStmt = $this->reservationModel->getRoleByUserId($userId);


        // Récupérer toutes les réservations
        $reservations = $this->reservationModel->getAllReservations();

        $this->renderView('reservation/list', [
            'title' => 'Liste des réservations',
            'reservations' => $reservations,
            'role' => $roleStmt
        ]);
    }

}