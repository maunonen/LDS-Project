<?php 

class Posts extends Controller {
  
  public function __construct (){
    if (!isLoggedIn()){
      redirect('users/login'); 
    }
    $this->postModel = $this->model('Post'); 
    $this->userModel = $this->model('User'); 
  }
  public function index () {

    $posts = $this->postModel->getPosts(); 
    $data = [
      'posts' => $posts
    ]; 
    $this->view('posts/index', $data); 
    
  }

  // add post 
  public function add () {
    // handle POST REQUEST FROM FORM
    if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
      // Sanitize POST array
      
      $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);
      
      // Create array of data from POST array
      $data = [ 
        'title' => trim($_POST['title']), 
        'body' => trim($_POST['body']), 
        'user_id' => $_SESSION['user_id'], 
        'title_err' => '', 
        'body_err' => '', 
      ];

      // validate data
      if( empty($data['title'])){
        $data['title_err'] = 'Please enter title'; 
      }
      if( empty($data['body'])){
        $data['body_err'] = 'Please enter body text'; 
      }
      // Make sure no errors
      if( empty( $data['title_err']) && empty( $data['body_err'])) {  
        if( $this->postModel->addPost( $data )) {
          flash('post_message', 'Post Added'); 
          redirect('posts'); 
        } else {
          die('Some went wrong'); 
        }
      } else {
        // Load view with errors 
        $this->view('posts/add', $data); 
      }


    } else {
      $data = [ 
      'title' => '', 
      'body' => ''
    ];     
    $this->view('posts/add', $data); 
    }
  }

  // show post
  public function show ( $id) {
      
      $post = $this->postModel->getPostById($id); 
      $user = $this->userModel->getUserById( $post->user_id ); 

      $data = [ 
        'post' => $post, 
        'user' => $user
      ];  
      $this->view('posts/show', $data); 
  }

  public function edit ($id) {
    // handle POST REQUEST FROM FORM
    if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
      // Sanitize POST array
      
      $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);
      
      // Create array of data from POST array
      $data = [ 
        'id' => $id,  
        'title' => trim($_POST['title']), 
        'body' => trim($_POST['body']), 
        'user_id' => $_SESSION['user_id'], 
        'title_err' => '', 
        'body_err' => '', 
      ];

      // validate data
      if( empty($data['title'])){
        $data['title_err'] = 'Please enter title'; 
      }
      if( empty($data['body'])){
        $data['body_err'] = 'Please enter body text'; 
      }
      // Make sure no errors
      if( empty( $data['title_err']) && empty( $data['body_err'])) {  
        if( $this->postModel->updatePost( $data )) {
          flash('post_message', 'Post Updated'); 
          redirect('posts'); 
        } else {
          die('Some went wrong'); 
        }
      } else {
        // Load view with errors 
        $this->view('posts/edit', $data); 
      }
    } else {
      
      // get existing post by id
      $post = $this->postModel->getPostById($id); 
      
      if( $post->user_id != $_SESSION['user_id']){
        redirect('posts'); 
      }
      
      // check for owner
      $data = [ 
        'id' => $id, 
        'title' => $post->title, 
        'body' => $post->body, 
        'body_err' => '', 
        'title_err' => '', 
      ];     
      $this->view('posts/edit', $data); 
    }
  }
 
  public function delete ( $id) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      // get existing post from model
      $post = $this->postModel->getPostById($id); 
      // Check for owner 
      if( $post->user_id != $_SESSION['user_id']){
        redirect('posts'); 
      }
      if( $this->postModel->deletePost($id)) {
        flash('post_message', 'Post removed') ; 
        redirect('posts'); 
      } else{
        die('Something went wrong'); 
      }
    } else {
      redirect('posts'); 
    } 
  }
}