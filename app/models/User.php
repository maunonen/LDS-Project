<?php 

class User {
  private $db; 

  public function __construct() {
    $this->db = new Database; 
  }

  // Register user
  public function register ( $data) {
    $this->db->query('INSERT INTO users ( username, email, password ) VALUES (:username, :email, :password)'); 
    // Bind values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']); 
    $this->db->bind(':password', $data['password']);  
    
    // Execute  
    if( $this->db->execute()){
      return true; 
    } else {
      return false; 
    }
  }

  public function updateProfile( $data) {

    // Bind values
    $sqlQuery= 'UPDATE users SET 
                                first_name = :first_name, last_name = :last_name, email = :email, 
                                user_role = :user_role, username = :username, phone_number = :phone_number, 
                                personal_id = :personal_id, dl_issued_date = :dl_issued_date, dl_expire_date = :dl_expire_date 
                WHERE user_id = :user_id'; 
    // bind params
    $this->db->query($sqlQuery); 
    $this->db->bind(':user_id', $_SESSION['user_id']);  
    $this->db->bind(':first_name', $data['first_name']);
    $this->db->bind(':last_name', $data['last_name']); 
    $this->db->bind(':email', $data['email']); 
    $this->db->bind(':user_role', $data['user_role']); 
    $this->db->bind(':username', $data['username']); 
    $this->db->bind(':phone_number', $data['phone_number']); 
    $this->db->bind(':personal_id', $data['personal_id']); 
    $this->db->bind(':dl_issued_date', $data['dl_issued_date']); 
    $this->db->bind(':dl_expire_date', $data['dl_expire_date']);  
    
    // Execute  
    if( $this->db->execute()){
      return true; 
    } else {
      return false; 
    }
  }

  public function login ( $email, $password) {
    $this->db->query('SELECT * FROM users WHERE email = :email'); 
    $this->db->bind(':email', $email); 

    $row = $this->db->single(); 
    $hashed_password = $row->password; 
    if ( password_verify($password , $hashed_password )) {
      return $row; 
    } else {
      return false; 
    }

  }

  public function findUserByEmail($email) {
    $this->db->query('SELECT * FROM users WHERE email=:email'); 
    // bind values
    $this->db->bind(':email', $email); 

    $row = $this->db->single(); 
    
    // check row 
    if ( $this->db->rowCount() > 0){
      return true; 
    } else {
      return false; 
    }
  }

  // Get user by ID
  public function getUserById($id) {
    $this->db->query('SELECT * FROM users WHERE user_id=:user_id'); 
    // bind values
    $this->db->bind(':user_id', $id); 
    $row = $this->db->single(); 
    return $row; 
  }
}