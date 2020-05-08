<?php 

class Users extends Controller {
  public function __construct () {
    $this->userModel = $this->model('User'); 
    
  }

  public function index () {
    if ( !isLoggedIn()){
      redirect('users/login');
    } else {
      redirect('cars/index'); 
    }

  }

  public function show ( $userId) {
    $user = $this->userModel->getUserById( $userId);  
    $this->view('users/show', $user); 
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
      } elseif (strlen( $data['username']) < 2  && strlen( $data['username'] ) > 50 )  {
        $data['username_err'] = 'Username must be in range ( 2 - 50 )';
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
          flash('register_success', 'You are registered and can log in now'); 
          $notificationMessage =  "<div> 
                                    <h1>Dear ". $data['username'] ."Welcome to LDS project</h1>
                                    <p>Congratulations you have been succefully regiesterdd in <strong>LDS project</strong></p>
                                    <br>
                                    <p>Best regards</p>
                                    <p>LDS Project</p>
                                  </div>"; 
          $notificationAltBody = "Dear ". $data['username'] ."Welcome to LDS project/n".
                                 "Congratulations you have been succefully regiesterdd inLDS project/n".
                                  "/n".
                                  "Best regards/n".
                                  "LDS Project" ; 
          $notificationSubject = "LDS registration" . $data['username'];
          $notificationEmail = $data['email']; 
          $notificationUsername = $data['username']; 
          sendNotification( $notificationSubject, $notificationUsername, $notificationEmail, $notificationMessage, $notificationAltBody); 
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

  public function profile() {
    
    // redirect in case if user not Logged in 

    if ( !isLoggedIn()) {
      redirect('users/login'); 
    }
    // check if method POST is set

    if ( $_SERVER ['REQUEST_METHOD'] == 'POST') {
      // sanitize 
      $curDate = new DateTime(); 
      $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING); 
      
      // Create array from POST array
      $data = [
        'first_name' => strip_tags(trim( $_POST['first_name'])), 
        'last_name' =>  strip_tags (trim( $_POST['last_name'])), 
        'email' => strip_tags (trim($_POST['email'])), 
        'user_role' => strip_tags(trim( $_POST['user_role'])), 
        'username' => strip_tags(trim( $_POST['username'])), 
        'phone_number' => strip_tags(trim( $_POST['phone_number'])), 
        'personal_id' => strip_tags(trim( $_POST['personal_id'])), 
        'dl_issued_date' =>  strip_tags($_POST['dl_issued_date']), 
        'dl_expire_date' => strip_tags($_POST['dl_expire_date'])
      ]; 

      // validation data
      
      // Validate First Name
      if ( empty( $data['first_name'])) {
        $data['first_name_err'] = 'Please enter First Name';
      } else { 
        if ( strlen($data['first_name']) > 50 ) {
          $data['first_name_err'] = 'First name must be less then 50 character';
        }
      }
      // validate last name 
      if ( empty( $data['last_name'])) {
        $data['last_name_err'] = 'Please enter Last Name'; 
      } else {
          if ( strlen($data['first_name']) > 50 ) {
          $data['first_name_err'] = 'Last name must be less then 50 character';
        }
      }
      //validate and sanitize email 
      if ( empty( $data['email'])) {
        $data['email_err'] = 'Please enter email address'; 
      } else {
        $valEmail = filter_var( $data['email'], FILTER_SANITIZE_EMAIL); 
        if ( $valEmail == false || strlen( $data['email'] > 50 ) ){
          $data['email_err'] =  $data['mail']. ' is not valid'; 
        } else {
          $data['email'] = $valEmail; 
        }
      }
      // validate role 
      if ( empty( $data['user_role'])) {
        $data['user_role_err'] = 'Please enter role'; 
      } elseif ( strlen($data['user_role']) > 20) {
        $data['user_role_err'] = 'Role must be less then 20 character'; 
      }
      // validate username 
      if ( empty( $data['username'])) {
        $data['username_err'] = 'Please enter username'; 
      } elseif ( strlen( $data['username']) < 2 ||  strlen($data['username']) > 20 ) {
        // from 2 -30
        $data['username_err'] = 'Username must be from 2 to 20 character'; 
      }
      //validate Phone Number
      if ( empty( $data['phone_number'])) {
        $data['phone_number_err'] = 'Please enter phonenumber'; 
      } else {
        // check for phone number remove first 0 if entered  and add + 358
        if ( $data['phone_number'][0] == '0'){
          $data['phone_number'] = substr($data['phone_number'], 1);
        }
        if ( !ValInput :: phonenumber( $data['phone_number'] )) {
          $data['phone_number_err'] = 'Phonenumber is not valid'; 
        } 
      }
      //validate Personal ID
      if ( empty( $data['personal_id'])) {
        $data['personal_id_err'] = 'Please enter personal id'; 
      } else {
        // check if it finish personal number
        if ( !ValInput :: hetu( $data['personal_id'])){
          $data['personal_id_err'] = 'Personal id number not valid'; 
        }
      }
      //validate DL issued date 
      
      $issuedDate = null; 
      if ( empty( $data['dl_issued_date'])) {
        $data['dl_issued_date_err'] = 'Please enter driver licence issued date'; 
      } elseif ( ! ValInput::date( $data['dl_issued_date'])){
        //validate DL issued date if date is not Date format
        $data['dl_issued_date_err'] = 'Is not a date'; 
      } else  {
        $issuedDate =  DateTime::createFromFormat('Y-m-d', $data['dl_issued_date']);
        if ( $issuedDate > $curDate) {
          $data['dl_issued_date_err'] = 'Issued date can not greater than current Date'; 
        }
      }
      
      // Validate expire date 
      $expireDate = null; 
      if ( empty( $data['dl_expire_date'])) {
        $data['dl_expire_date_err'] = 'Please enter driver licence expire date'; 
      } elseif ( ! ValInput::date( $data['dl_issued_date'])){
        // check if date is a Date number and more than issued date
          $data['dl_expire_date_err']  = 'Is not a date'; 
      } else {
        // Validate expireDate > currentDate &&  expireDate > issueDate 
        $expireDate = DateTime::createFromFormat('Y-m-d', $data['dl_expire_date']);
        if (  $expireDate && $issuedDate && 
              $issuedDate instanceof DateTime && $expireDate instanceof DateTime
        ) {
          if ( $issuedDate > $expireDate || $expireDate <= $curDate ){
            $data['dl_expire_date_err']  = 'Issued date or expire date not valid'; 
          }
        }  
      }

      if ( 
          empty( $data['first_name_err']) && empty( $data['last_name_err']) &&
          empty( $data['email_err']) && empty( $data['user_role_err']) &&
          empty( $data['username_err']) && empty( $data['phone_number_err']) &&
          empty( $data['personal_id_err']) && empty( $data['dl_issued_date_err']) &&
          empty( $data['dl_expire_date_err'])
        ) {
          
          if( $this->userModel->updateProfile( $data )) {
            //die("Success"); 
          
            redirect('users/profile'); 
            flash('user_message', 'User profile data updated'); 
            
        } else {
          die('Some went wrong'); 
        }
          
      } else {
        $this->view('users/profile', $data); 
      }


      // Checking validation error 

    } else {

      $userProfile = $this->userModel->getUserById($_SESSION['user_id']); 
      $data = [
        // Data
        'first_name' => ($userProfile->first_name) ? $userProfile->first_name : '', 
        'last_name' => ($userProfile->last_name) ? $userProfile->last_name : '', 
        'email' => ($userProfile->email) ? $userProfile->email : '', 
        'user_role' => ($userProfile->user_role) ? $userProfile->user_role : '', 
        'username' => ($userProfile->username) ? $userProfile->username : '', 
        'phone_number' => ($userProfile->phone_number) ? $userProfile->phone_number : '', 
        'personal_id' => ($userProfile->personal_id) ? $userProfile->personal_id : '', 
        'dl_issued_date' =>  ($userProfile->dl_issued_date) ?  substr ($userProfile->dl_issued_date , 0, 10)  : '', 
        'dl_expire_date' => ($userProfile->dl_expire_date) ? substr($userProfile->dl_expire_date, 0, 10) : '', 
        // Erros
        'first_name_err' => '', 
        'last_name_err' =>  '', 
        'email_err' => '', 
        'user_role_err' =>  '', 
        'username_err' =>  '', 
        'phone_number_err' => '', 
        'personal_id_err' =>  '', 
        'dl_issued_date_err' =>   '', 
        'dl_expire_date_err' => '', 
        
      ]; 
      //flash('user_message', 'User profile data updated'); 
      $this->view('users/profile', $data); 
    }
  } 

  public function createUserSession ( $user) {
    $_SESSION['user_id'] = $user->user_id; 
    $_SESSION['user_email'] = $user->email; 
    $_SESSION['user_name'] = $user->username; 
    $_SESSION['user_role'] = $user->user_role ? $user->user_role : 'driver' ; 
    redirect('users/profile'); 
  }

  public function logout () {
    unset($_SESSION['user_id']); 
    unset($_SESSION['user_email']); 
    unset($_SESSION['user_name']); 
    unset($_SESSION['user_role']); 
    session_destroy(); 
    redirect('users/login'); 
  }
}