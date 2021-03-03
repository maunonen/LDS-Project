<?php 

class Car {

  private $db; 

  public function __construct () {

    $this->db = new Database; 
  }

  public function getCars(){
    $this->db->query('SELECT * FROM cars'); 
    $results = $this->db->resultSet(); 
    return $results; 
  }

  public function getModelList ( $brand = '2' ) {
    $this->db->query('SELECT * FROM models WHERE brand_id = :brand_id'); 
    $this->db->bind('brand_id', $brand); 
    $results = $this->db->resultSet(); 
    return $results; 
  }

  public function getBrandList () {
    $this->db->query('SELECT * FROM brands'); 
    $results = $this->db->resultSet(); 
    return $results; 
  }

  public function addCar ( $data ){

  }

  public function updateCar ( $data ) {

  }

  public function deleteCar ( $id ) {

    $this->db->query('DELETE FROM cars WHERE car_id = :car_id'); 
    $this->db->bind(':car_id', $id); 

    if ( $this->db->execute()){
      return true; 
    } else {
      return false; 
    }
  }

  public function getCarById ( $id) {

    $this->db->query('SELECT * FROM cars WHERE car_id =:car_id'); 
    $this->db->bind(':car_id', $id); 
    $row = $this->db->single();
    return $row; 
  }
}