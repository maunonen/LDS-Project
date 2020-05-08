<?php require APPROOT . '/views/lds/header.php';?>  

<div class="container mt-5">
  <?php flash('cars_message'); ?>
  <?php foreach( $data['cars'] as $car): ?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
      <h1 class="display-3"><?php echo $car->brand . ' ' . $car->model ;?></h1>
      <p class="lead"><?php echo $car->brand; ?></p> 
      <a href="<?php echo URLROOT;?>/cars/details/<?php echo $car->car_id?>" class="btn btn-success">detail</a>
      <a href="<?php echo URLROOT;?>/rentals/add/<?php echo $car->car_id?>" class="btn btn-success">rent</a>
      <a href="<?php echo URLROOT;?>/rentals/index" class="btn btn-success">show my rentals</a>
      <a href="<?php echo URLROOT;?>/cars/delete/<?php echo $car->car_id?>" class="btn btn-danger">delete</a>
    </div>  
  </div>
  <?php endforeach; ?>
</div> <!-- container end  -->
<?php require APPROOT . '/views/lds/footer.php';?>  