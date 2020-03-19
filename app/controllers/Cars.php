<?php 

class Cars extends Controller {

  public function __construct () {
    
  }

  public function index () {
    if ( isLoggedIn()) { 
      die('SUCCESS'); 
    }
  }
}