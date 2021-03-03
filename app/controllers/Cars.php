<?php 

class Cars extends Controller {


  public function __construct () {
    
    if ( !isLoggedIn()) { 
      redirect('users/login'); 
    }
    //$this->carModel = $this->model('User'); 
    $this->carModel = $this->model('Car'); 
  }

  public function index () {
    
    $cars = $this->carModel->getCars(); 
    $data = [
      'cars' => $cars
    ];
    $this->view('cars/index', $data); 
  }

  public function delete( $id = '') {
    if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
      if ( $this->carModel->deleteCar($id)) {
        flash('car_messasge', 'Car removed'); 
        redirect('cars'); 
      } else {
        die('Something went wrong'); 
      }
    } else {
      redirect('cars'); 
    }
  }

  public function add () {
    if ( !isLoggedIn()) { 
      redirect('users/login'); 
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      
      // sanitize input from POST
      $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING); 
      
      // create array from POST
      $data = [
              
              'brand' =>  strip_tags( trim($_POST['brand'])) , 
              'model' =>  strip_tags( trim($_POST['model'])) , 
              'reg_number' =>  strip_tags( trim($_POST['reg_number'])), 
              'color' =>  strip_tags( trim($_POST['color'])), 
              'issued_year' =>  strip_tags( trim($_POST['issued_year'])), 
              'photo_url' => strip_tags( trim($_POST['photo_url']))
            ]; 

      // validate Brand 

      if ( empty($data['brand'])) { 
        $data['brand_err'] = 'Please enter car brand'; 
      } 

      // Validate model 
      if ( empty($data['model'])) { 
        $data['model_err'] = 'Please choose car brand'; 
      } 
      // validate registration number 
      if ( empty($data['reg_number'])) { 
        $data['reg_number_err'] = 'Please choose cars model'; 
      } 
      // validate color
      if ( empty($data['color'])) { 
        $data['color_err'] = 'Please choose cars color'; 
      } 
      // Validate issued year 
      if ( empty($data['issued_year'])) { 
        $data['issued_year_err'] = 'Please enter cars issued year'; 
      } 
      // validate photo URL
      if ( empty($data['photo_url'])) { 
        $data['photo_url_err'] = 'Please upload cars Photo'; 
      } 

      if ( empty( $data['brand_err']) &&  empty( $data['model_err']) && 
          empty( $data['reg_number_err']) &&  empty( $data['color_err']) && 
          empty( $data['issued_year_err']) &&  empty( $data['photo_url'])
      ){
        if ( $this->carModel->updateCar( $data) ) {
          flash('cars_message', 'New car added to DB'); 
          redirect('cars/index'); 
        } else { 
          die ('Something went wrong'); 
        }
      } else {
        $this->view('cars/add', $data); 
      }

    


    } else {

      $brandList = $this->carModel->getBrandList();
      $modelList = $this->carModel->getModelList(2); 
      

      $data = [
              // data  
              'brand' =>  '' , 
              'model' =>  '' , 
              'brand_list' =>  $brandList , 
              'model_list' =>  $modelList, 
              'reg_number' =>  '', 
              'color' =>  '', 
              'issued_year' =>  '', 
              'photo_url' => '', 
              // errors 
              'brand_err' =>  '' , 
              'model_err' =>  '', 
              'reg_number_err' =>  '', 
              'color_err' =>  '', 
              'issued_year_err' =>  '', 
              'photo_url_err' => ''
            ]; 

    }
    $this->view('cars/add', $data); 

  }

  public function about ( $id) {
    
    $carAbout = $this->carModel->getCarById( $id ); 
    $this->view('cars/about', $carAbout); 
  }
}