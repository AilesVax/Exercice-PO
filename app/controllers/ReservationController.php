<?php
require_once './app/utils/Render.php';
class ReservationController{
    use Render;

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


  public function create(int $activityId){
      {
    $user = $_SESSION['user']['id'];
    $actModel = new ReservationModel();
    $act = $actModel->createReservation($user,$activityId);
    $data = [
      'title' => 'activité',
      'act' => $act
    ];

    $this->renderView('reservation/index', $data);
  }
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

}