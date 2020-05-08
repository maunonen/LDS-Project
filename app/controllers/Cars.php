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
        flash('cars_message', 'Car has been successfully removed'); 
        redirect('cars'); 
      } else {
        die('Something went wrong'); 
      }
    } else {
      redirect('cars'); 
    }
  }

  public function update ( $id ) {
    if ( !isLoggedIn()) { 
      redirect('users/login'); 
    }
    $brandList = $this->carModel->getBrandList();
    $modelList = $this->carModel->getModelList(2); 
    $colorList = $this->carModel->getColorList(); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING); 

      $data = [
        'car_id' => $id, 
        'brand_list' =>  $brandList , 
        'model_list' =>  $modelList, 
        'color_list' =>  $colorList, 
        'brand' =>  strip_tags( trim($_POST['brand'])) , 
        'model' =>  strip_tags( trim($_POST['model'])) , 
        'reg_number' =>  strip_tags( trim($_POST['reg_number'])), 
        'color' =>  strip_tags( trim($_POST['color'])), 
        'issued_year' =>  strip_tags( trim($_POST['issued_year'])), 
        'photo_url' => strip_tags( trim($_POST['photo_url']))
      ]; 

      // validate Brand 

      if ( empty($data['brand'])) { 
        $data['brand_err'] = 'Please choose cars brand'; 
      } 

      // Validate model 
      if ( empty($data['model'])) { 
        $data['model_err'] = 'Please choose cars brand'; 
      } 
      // validate registration number 
      if ( empty($data['reg_number'])) { 
        $data['reg_number_err'] = 'Regestration number is empty'; 
      } 
      // validate color
      if ( empty($data['color'])) { 
        $data['color_err'] = 'Please enter cars color'; 
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
          empty( $data['issued_year_err']) &&  empty( $data['photo_url_err'])
      ){
        if ( $this->carModel->updateCar( $data) ) {
          flash('cars_message', 'Car updated'); 
          redirect('cars/index'); 
        } else { 
          die ('Something went wrong'); 
        }
      } else {
        $this->view('cars/update', $data); 
      }
    } else {
      $car = $this->carModel->getCarById( $id );
      $data = [
        'brand_list' =>  $brandList , 
        'model_list' =>  $modelList, 
        'color_list' =>  $colorList, 
        'car_id' => $car->car_id,
        'brand' =>  $car->brand, 
        'model' =>  $car->model, 
        'reg_number' =>  $car->reg_number, 
        'color' =>  $car->color, 
        'issued_year' =>  $car->issued_year, 
        'photo_url' => $car->photo_url,
        // 
        'brand_err' =>  '' , 
        'model_err' =>  '', 
        'reg_number_err' =>  '', 
        'color_err' =>  '', 
        'issued_year_err' =>  '', 
        'photo_url_err' => ''
      ];
      $this->view('cars/update', $data);  
     }
  }

  public function add () {
    if ( !isLoggedIn()) { 
      redirect('users/login'); 
      return;
    }
    
    $brandList = $this->carModel->getBrandList();
    $colorList = $this->carModel->getColorList();
    $modelList = $this->carModel->getModelList(2); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      
      // sanitize input from POST
      $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING); 
      
      // create array from POST
      $data = [
              'brand_list' =>  $brandList , 
              'model_list' =>  $modelList, 
              'color_list' =>  $colorList, 
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
          empty( $data['issued_year_err']) &&  empty( $data['photo_url_err'])
      ){
        if ( $this->carModel->addCar( $data) ) {
          flash('cars_message', 'New car added to DB'); 
          redirect('cars/index'); 
        } else { 
          die ('Something went wrong'); 
        }
      } else {
        $this->view('cars/add', $data); 
      }
    
    } else {
      
      $data = [
              // data  
              'brand' =>  '' , 
              'model' =>  '' , 
              'brand_list' =>  $brandList , 
              'model_list' =>  $modelList, 
              'color_list' =>  $colorList, 
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

  public function details ( $id) {
    
    $carDetail = $this->carModel->getCarById( $id ); 
    $this->view('cars/details', $carDetail); 
  }
}