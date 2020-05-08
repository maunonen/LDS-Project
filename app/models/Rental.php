<?php 

class Rental {
  private $db; 

  public function __construct()
  {
    $this->db = new Database;   
  }

  public function add ( $data ) {

    // sql query
    $this->db->query('INSERT 
                      INTO rentals (
                        user_id, car_id, rental_start, 
                        rental_end, rental_sum)
                      VALUES ( 
                        :user_id, :car_id, :rental_start, 
                        :rental_end, :rental_sum )'
                      ); 
    // bind values
    $this->db->bind( ':user_id', $data['user_id']); 
    $this->db->bind( ':car_id', $data['car_id']); 
    $this->db->bind( ':rental_start', $data['rental_start']); 
    $this->db->bind( ':rental_end', $data['rental_end']); 
    $this->db->bind( ':rental_sum', $data['rental_sum']); 
    // Execute 
    if ( $this->db->execute() ) {
      return true; 
    } else {
      return false;
    }
  }

  public function update ( $data ) {
    $this->db->query('UPDATE rentals SET
                      rental_start = :rental_start, rental_end = :rental_end, 
                      rental_sum = :rental_sum'
                    ); 
    // bind values
    $this->db->bind( ':rental_start', $data['rental_start']); 
    $this->db->bind( ':rental_end', $data['rental_end']); 
    $this->db->bind( ':rental_sum', $data['rental_sum']); 
    // Execute 
    if ( $this->db->execute() ) {
      return true; 
    } else {
      return false;
    }
  }

  public function delete ( $id) {
    $this->db->query('DELETE FROM rentals WHERE rental_id = :rental_id'); 
    $this->db->bind(':rental_id', $id);

    if ( $this->db->execute()) {
      return true; 
    } else {
      return false; 
    }
  }


  public function getRentalsByUserId ( $user_id) {

    $this->db->query('SELECT 
                      cars.brand, cars.model, cars.reg_number, cars.photo_url, 
                      cars.issued_year, rentals.user_id, rentals.rental_start, 
                      rentals.rental_end, users.first_name, users.last_name,
                      rentals.rental_id, rentals.car_id, rentals.user_id, rentals.rental_sum
                    FROM rentals 
                    INNER JOIN cars ON cars.car_id = rentals.car_id
                    INNER JOIN users ON users.user_id = rentals.user_id 
                    WHERE rentals.user_id = :userid'); 
    $this->db->bind(':userid', $user_id );   
    $results = $this->db->resultSet(); 
    return $results;

  }

  public function getRentalById ( $rental_id) {

    $this->db->query('SELECT 
                      cars.brand, cars.model, cars.reg_number, cars.photo_url, 
                      cars.issued_year, 	rentals.user_id, rentals.rental_start, 
                      rentals.rental_end, users.first_name, users.last_name,
                      rentals.rental_id, rentals.car_id, rentals.user_id, rentals.rental_sum
                    FROM rentals 
                    INNER JOIN cars ON cars.car_id = rentals.car_id
                    INNER JOIN users ON users.user_id = rentals.user_id 
                    WHERE rentals.rental_id = :rental_id'); 
    
    $this->db->bind(':rental_id', $rental_id ); 
    $row = $this->db->single(); 
    return $row; 
  }

  public function getAllRentals () {
    
    $this->db->query('SELECT 
                      cars.brand, cars.model, cars.reg_number, cars.photo_url, 
                      cars.issued_year, 	rentals.user_id, rentals.rental_start, 
                      rentals.rental_end, users.first_name, users.last_name,
                      rentals.rental_id, rentals.car_id, rentals.user_id, rentals.rental_sum
                    FROM rentals 
                    INNER JOIN cars ON cars.car_id = rentals.car_id
                    INNER JOIN users ON users.user_id = rentals.user_id' 
                    ); 

    $rows = $this->db->resultSet(); 
    return $rows; 
  }
}