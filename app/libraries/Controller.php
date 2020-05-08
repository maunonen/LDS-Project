<?php 

/* 
  Base Controller  
*/

class Controller {
  // Load model 
   public function model ( $model ) {
    // Requier model file 
    if (file_exists('../app/models/' . $model . '.php') ){
      require_once '../app/models/' . $model . '.php';  
      return new $model(); 
    } else {
      die('Model does not exist: '. $model); 
    }
    //return false; 
    // Instatiate model 
    
   }

   public function view ( $view, $data = [] ) { 
     // check for view file 

    if ( file_exists('../app/views/' .$view . '.php') ) {
      require_once '../app/views/' .$view . '.php';  
    } else {
       die('View does not exist');  
    }

   }
}