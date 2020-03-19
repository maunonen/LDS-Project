<?php 

class Users extends Controller {
  public function __construct () {
    $this->userModel = $this->model('User'); 
  }

  public function register() {
    
    
    //die('Submiteted');   
    // check for POST 
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
      
      // Sanitize POST data

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

      //proccess form 
      $data = [ 
        'username' => trim($_POST['username']), 
        'email' => trim($_POST['email']), 
        'password' => trim($_POST['password']), 
        'confirm_password' => trim($_POST['confirm_password']), 
        'username_err' => '', 
        'email_err' => '', 
        'password_err' => '', 
        'confirm_password_err' => '' 
      ]; 

      // validate email
      if ( empty($data['email'])) {
        $data['email_err'] = 'Please enter email';
      } else {
        if ( $this->userModel->findUserByEmail( $data['email'])) {
          $data['email_err'] = 'Email is already taken';
        }
      }

      // Validate name
      if ( empty($data['username'])) {
        $data['username_err'] = 'Please enter username';
      }
      
      // Validate confirm password 
      if ( empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      } elseif ( strlen( $data['password']) < 6){
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      // Validate confirm password 
      if ( empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please confirm password';
      } elseif ($data['password'] != $data['confirm_password']){
        $data['confirm_password_err'] = 'Password do not match';
      }
      // Make sure errors are empty 
      if (   empty($data['email_err']) && empty($data['username_err']) 
          && empty($data['password_err']) && empty($data['confirm_password_err'])){
        // validated
        // Hash Password 
        $data['password'] = password_hash( $data['password'], PASSWORD_DEFAULT); 

        // Register user
        if ($this->userModel->register($data)){
          // redirect 
          flash('register_success', 'You are registered and can log in'); 
          redirect('users/login');
        } else {
          die('Something went wrong') ;
        }

      } else {
        $this->view('users/register', $data); 
      }

    } else {
      
      // init data
      $data = [ 
        'username' => '', 
        'email' => '', 
        'password' => '', 
        'confirm_password' => '', 
        'username_err' => '', 
        'email_err' => '', 
        'password_err' => '', 
        'confirm_password_err' => '' 
      ]; 
      // Load view
      $this->view('users/register', $data); 
    }
    
  }

  public function login() {
    
    // check for POST 
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
      // process form 

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

      //proccess form 
      $data = [ 
        
        'email' => trim($_POST['email']), 
        'password' => trim($_POST['password']), 
        'email_err' => '', 
        'password_err' => ''
      ]; 

      // validate email
      if ( empty($data['email'])) {
        $data['email_err'] = 'Please enter email';
      }

      // Validate password 
      if ( empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      } elseif ( strlen( $data['password']) < 6){
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      // Check user for user/email 

      if( $this->userModel->findUserByEmail( $data['email'])){
        // User found 
        
      } else {
        $data['email_err'] = 'No user found'; 
      }

      // Make sure errors are empty 
      if ( empty($data['email_err']) && empty($data['password_err'])){
        // validated
        // Check and set logged in user
        $loggedInUser = $this->userModel->login( $data['email'], $data['password']);  
        if ( $loggedInUser){
          // create a session variable and redirect to User main page
          $this->createUserSession($loggedInUser); 
        } else {
          $data['password_err'] = 'Password incorrect'; 
          $this->view('users/login', $data); 
        }
      } else {
        $this->view('users/login', $data); 
      }
    } else {
      
      // init data
      $data = [ 
        'email' => '', 
        'password' => '', 
        'email_err' => '', 
        'password_err' => ''
      ]; 
      // Load view
      $this->view('users/login', $data); 
    }
    
  }

  public function createUserSession ( $user) {
    $_SESSION['user_id'] = $user->user_id; 
    $_SESSION['user_email'] = $user->email; 
    $_SESSION['user_name'] = $user->username; 
    redirect('cars/index'); 
  }

  public function logout () {
    unset($_SESSION['user_id']); 
    unset($_SESSION['user_email']); 
    unset($_SESSION['user_name']); 
    session_destroy(); 
    redirect('users/login'); 
  }
}