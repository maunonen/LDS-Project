<?php require APPROOT . '/views/inc/header.php';?>  
  
<?php foreach( $data['cars'] as $car): ?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
      <h1 class="display-3"><?php echo $car->brand . ' ' . $car->model ;?></h1>
      <p class="lead"><?php echo $car->brand; ?></p> 
      
      <a href="<?php echo URLROOT;?>/cars/update/<?php echo $car->car_id?>" class="btn btn-success">update</a>
      <a href="<?php echo URLROOT;?>/cars/delete/<?php echo $car->car_id?>" class="btn btn-danger">delete</a>
    </div>  
  </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php';?>  