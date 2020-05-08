<?php 

class Rentals extends Controller {

  public function __construct()
  {
    if (!isLoggedIn()){
      redirect('users/login'); 
    }
    $this->rentalModel = $this->model('Rental'); 
    $this->carModel = $this->model('Car'); 
    $this->userModel = $this->model('User'); 
  }

  public function index(){
    
    if (!isset($_SESSION['user_role']) ){
      redirect('users/login');
      return;
    }
    if ( $_SESSION['user_role'] == 'admin') { 
      $rentals = $this->rentalModel->getAllRentals(); 
    } else {
      if ( isset ($_SESSION['user_id']) ) {
        $userId = $_SESSION['user_id']; 
        $rentals = $this->rentalModel->getRentalsByUserId($userId); 
      } else {
        flash('user_message', 'Please login in'); 
        redirect('users/login');
        return; 
      }
    } 
    $data = [
      'rentals' => $rentals 
    ]; 
    $this->view('rentals/index', $data); 
  }
  
  public function details ( $id ){
    
    $rentalDetail3 = $this->rentalModel->getRentalById( $id); 
    echo var_dump($rentalDetail3); 
  }

  
  public function add( $id ){
    
    if ( !isLoggedIn() ){
      redirect('users/login');
      flash('users_message', 'Please login in'); 
      return; 
    } 
    $carToRent = $this->carModel->getCarById( $id );
    
    if ( !$carToRent ){
      redirect('cars/index');
      flash('cars_message', 'Car not found', 'alert alert-danger'); 
      return;
    } 
    
    $userId = $_SESSION['user_id']; 
    $renter = $this->userModel->getUserById( $userId );
    
    $curDate = new DateTime(); 
    if ( $_SERVER[ 'REQUEST_METHOD'] == 'POST') {
      // sanitize input from string 
      $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'brand' => $carToRent->brand,
        'model' => $carToRent->model,
        'reg_number' => $carToRent->reg_number,
        'photo_url' => $carToRent->photo_url,
        'car_id' => $carToRent->car_id,
        'user_id' => $userId,
        'user_first_name' => $renter->first_name,
        'user_last_name' => $renter->last_name,
        //'rental_sum' => strip_tags(  trim ($_POST['rental_sum'])),
        'rental_start' => strip_tags(  trim ($_POST['rental_start'])), 
        'rental_end' => strip_tags(  trim ($_POST['rental_end']))
      ]; 

      // POST rental start date not empty
      $rentalStart = null; 
      if ( empty( $data['rental_start'])) {
        $data['rental_start_err'] = 'Please fill the start day field'; 
      } elseif ( !ValInput :: date( $data['rental_start']) ) {
        // check date format is a date 
        $data['rental_start_err'] = 'Is not a date format'; 
      } else  {
        $rentalStart = DateTime :: createFromFormat('Y-m-d', $data['rental_start'] ); 
        if ( $rentalStart < $curDate) {
          $data['rental_start_err'] = 'Rental start date must be greater than current date'; 
        }
      }

      // validate end date 
      if ( empty( $data['rental_end'])) {
        $data['rental_end_err'] = 'Please fill the start day field'; 
      } elseif ( !ValInput :: date( $data['rental_end']) ) {
        // check date format is a date 
        $data['rental_end_err'] = 'Is not a date format'; 
      } else  {
        $rentalEnd = DateTime :: createFromFormat('Y-m-d', $data['rental_end'] ); 
        if ( $rentalEnd < $rentalStart ) {
          $data['rental_end_err'] = 'Rental end date must be greater than start date'; 
        }
      }

      if ( empty( $data['rental_start_err']) && empty( $data['rental_end_err']) ) {
        if ( $this->rentalModel->add( $data)) {
          flash('rentals_message', 'New rental has been added successfully'); 
          redirect('rentals/index'); 
          return ; 
        } else {
          flash('pages_message', 'Can not add new rental', 'alert alert-danger'); 
          redirect('pages/notfound'); 
          return; 
        }
      } else {
        flash('rentals_message', 'Input fields are not valid', 'alert alert-danger'); 
        $this->view('rentals/add', $data); 
      }
    } else {
      // echo $date1->diff($date2)->days; 
      // var_dump( $carToRent); 
      $data = [
        'brand' => $carToRent->brand,
        'model' => $carToRent->model,
        'reg_number' => $carToRent->reg_number,
        'photo_url' => $carToRent->photo_url,
        'car_id' => $carToRent->car_id,
        'user_firstname' => $renter->first_name,
        'user_lastname' => $renter->last_name,
        //'rental_sum' => strip_tags(  trim ($_POST['rental_sum'])),
        'rental_start' => '', 
        'rental_end' => ''
      ]; 

      $this->view('rentals/add', $data); 
    }
  }

  public function delete ( $id ){
    
    if (!isset($_SESSION['user_role']) ){
      redirect('users/login');
    }
    if ( $_SESSION['user_role'] != 'admin' ){ 
      flash('rentals_message', 'Permission denied', 'alert alert-danger'); 
      redirect('rentals/index');
      return ; 
    }
    if ( $this->rentalModel->delete( $id) ) {
      flash('rentals_message', 'Rental removed'); 
      redirect('rentals/index');
    } else {
      flash('rentals_message', 'Can not delete rental'); 
      redirect('rentals/index');
    }
  }

  public function update ( $id ) {
    
    $dataUpdate = [
      'rental_start' => '2020-01-26', 
      'rental_end' => '2020-01-28', 
      'rental_sum' => '5.45', 
    ];
    $this->rentalModel->update( $dataUpdate); 
  }

}