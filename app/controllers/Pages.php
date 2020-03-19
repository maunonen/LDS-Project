<?php

class Pages extends Controller { 

  public function __construct () {
    //echo 'Pages loaded'; 
    //$this->postModel = $this->model('Post');   
  }

  public function index( ) {
    
    if (isLoggedIn()){
      redirect('posts/login'); 
    }
    //$posts = $this->postModel->getPosts(); 
    //echo 'Hello from index' . $id;
    $data = [ 
      'title' => 'Share posts',  
      'description' => 'Simple social network built on Traversy MVC PHP frame work'
      //'posts' => $posts
    ]; 
    $this->view('pages/index', $data); 
    
  }

  public function about( $id  = '') {
    //echo "This is about " . $id; 
    $data = [ 
      'title' => 'About us', 
      'description' => 'App to share post with others users'
    ]; 
    $this->view('pages/about', $data); 
  }
}