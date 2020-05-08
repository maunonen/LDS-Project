<?php

class Pages extends Controller { 

  public function __construct () {
    //echo 'Pages loaded'; 
    //$this->postModel = $this->model('Post');   
  }

  public function index( ) {
    $this->view('pages/index');  
  }

  public function contact () {

    $date = new DateTime(); 
    $curTime = $date->format('Y-m-d H:i:s');
    if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
      $data = [
        'email' =>  strip_tags( trim ( $_POST['email'])), 
        'name' => strip_tags( trim ( $_POST['name'])), 
        'phone_number' => strip_tags( trim ( $_POST['phone_number'])), 
        'message' => strip_tags( trim ( $_POST['message'])) 
      ]; 
      if ( empty($data['email'])){
        $data['email_err'] = 'Please enter email'; 
      } elseif (!ValInput::email($data['email'])) {
        $data['email_err'] = 'Email is not valid'; 
      }
      if ( empty($data['name'])){
        $data['name_err'] = 'Please enter name'; 
      } elseif ( !ValInput::str($data['name'])) {
        $data['name_err'] = 'Name must be a string'; 
      }
      if ( empty($data['phone_number'])){
        $data['phone_number_err'] = 'Please enter phone number'; 
      }
      if ( empty($data['message'])){
        $data['message_err'] = 'Please enter message'; 
      }
      if ( empty( $data['email_err']) && empty( $data['name_err']) && 
           empty($data['phone_number_err']) && empty($data['message_err'])
          ){
            $notificationMessage = "<div> 
                                      <h3>You have new message from ". $data['name'] ."</h3>
                                      <p>Phone humber: ". $data['phone_number'] ."</p>
                                      <p>Email: ". $data['email'] ."</p>
                                      <p>Send time: ". $curTime ."</p>
                                      <p>IP address ". $_SERVER['REMOTE_ADDR']. " </p>
                                      <p>". $data['message']."</p>
                                      <br>
                                    </div>"; 
          $notificationAltBody =  "You have new message from ". $data['name'] . "/n". 
                                  "Phone humber: ". $data['phone_number'] ."/n".
                                  "Email: ". $data['email'] ."/n".
                                  "Send time: ". $curTime ."/n".
                                  "IP address ". $_SERVER['REMOTE_ADDR']."/n".
                                  $data['message']; 
          $notificationSubject = "New message from" . $data['name'] . " " . $_SERVER['REMOTE_ADDR'];
          $notificationEmail = MAIL_CONTACT; 
          $notificationUsername = $data['name']; 
          sendNotification( $notificationSubject, $notificationUsername, $notificationEmail, $notificationMessage, $notificationAltBody); 
          redirect('pages/index'); 
          return ; 
      } else {
        $this->view('pages/contact', $data); 
      }

      redirect('pages/index'); 
      return; 
    } else {
      $data = [
        'email' =>  '', 
        'name' =>  '', 
        'phone_number' =>  '', 
        'messasge' =>  '', 
        'email_err' => '', 
        'name_err' => '', 
        'phone_number_err' => '',
        'message_err' => '',
      ]; 
      $this->view('pages/contact', $data); 
    }
    
  }

  public function about( $id  = '') {
    //echo "This is about " . $id; 
    $data = [ 
      'title' => 'About us', 
      'description' => 'App to share post with others users'
    ]; 
    $this->view('pages/about', $data); 
  }

  public function notfound() {
     $this->view('pages/404');  
  }
}