<?php
require_once './app/utils/Render.php';
class ReservationController{
    use Render;

  public function index(): void
  {
    $user = $_SESSION['user']['id'];
    $reservModel = new ReservationModel();
    $reserv = $reservModel->getReservationsByUserId($user);
    $data = [
      'title' => 'Liste des reservations',
      'reserv' => $reserv
    ];
 
    // Rendu avec layout
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
 
    // Rendu avec layout
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
 
    // Rendu avec layout
    $this->renderView('reservation/show', $data);
  }
  }
  

    public function cancel(int $id){
      {
    // $user = $_SESSION['user']['id'];
    $cancelModel = new ReservationModel();
    $cancel = $cancelModel->cancelReservation($id);
    $data = [
      'title' => 'activité',
      'act' => $cancel
    ];
 
    // Rendu avec layout
    $this->renderView('reservation/', $data);
  }
  }

}