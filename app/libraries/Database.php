<?php 

/* 
  PDO Database Class
  Connect to datasbase 
  create prepared statement
  Bind values 
  return rows and result 
*/

class Database {
  private  $host = DB_HOST; 
  private $user = DB_USER; 
  private $pass = DB_PASS; 
  private $dbname = DB_NAME; 

  // Database handler 
  private $dbh; 
  private $stmt; 
  private $error;

  

  // Create  a PDO instance

  //$pdo = new PDO( $dsn, $user, $password); 
  // Object model by default 
  //$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


  public function __construct () {
    $dsn = 'mysql:host='. $this->host. '; dbname=' . $this->dbname ; 
    $option = array(
      PDO::ATTR_PERSISTENT => true, 
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
    ); 
    try {
      $this->dbh = new PDO ( $dsn, $this->user, $this->pass, $option); 
    } catch (PDOException $e ){
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  public function query ( $sql) {
    $this->stmt  = $this->dbh->prepare( $sql );  
  }

  // Bind values 
  public function bind ( $param , $value ,  $type = null){
    if ( is_null($type)) {
      switch (true){
        case is_int($value): 
          $type = PDO :: PARAM_INT; 
          break; 
        case is_bool($value): 
          $type = PDO :: PARAM_BOOL; 
          break; 
        case is_null($value): 
          $type = PDO :: PARAM_NULL; 
          break; 
        default: 
          $type = PDO :: PARAM_STR; 
          break; 
      }
    }
    $this->stmt->bindValue($param, $value, $type); 
  }

  // Execute the prepared statement 
  public function execute(){
    return $this->stmt->execute(); 
  }

  // Get result set as array of object 

  public function resultSet() {
    $this->execute(); 
    return $this->stmt->fetchAll( PDO :: FETCH_OBJ); 
  }

  // get single record as object 
  public function single(){
    $this->execute(); 
    return $this->stmt->fetch( PDO :: FETCH_OBJ); 
  }

  // get row count 
  public function rowCount() {
     return $this->stmt->rowCount();  
  }
}

