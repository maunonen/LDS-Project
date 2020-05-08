<?php require APPROOT . '/views/lds/header.php';?>  
<div class="container">
  <div class="row">
    <div class="col-md mx-auto">
      <div class="card bg-light mt-5">
        <div class="card-header">
          <h1>Car Details</h1>
        </div>
        <div class="card-body">
          <h5 class="card-title"><?php echo strtoupper ($data->brand) . ' ' . strtoupper ($data->model) . ' ' . strtoupper($data->reg_number); ?></h5>
            <div class="row">
              <div class="col-md-7">
                <img src="<?php echo URLROOT . $data->photo_url ;?>" class="rounded img-fluid" alt="Car image">
              </div>
              <div class="col-md-5">
                <h5>Details</h5>
                <p class="pr-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                  irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla 
                  pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                  deserunt mollit anim id est laborum.
                </p>
              </div>
            </div>  <!-- end row  -->
            <div class="mt-3">
              <a href="<?php echo URLROOT;?>/cars/delete/<?php echo $data->car_id?>" class="btn btn-danger">Delete</a>
              <a href="<?php echo URLROOT;?>/cars/update/<?php echo $data->car_id?>" class="btn btn-success">Update</a>
              <a href="<?php echo URLROOT;?>/cars/index" class="btn btn-light">To car list</a>
            </div>
        </div> <!-- end card-body -->
      </div> <!-- end card  -->
    </div> <!-- end old-md -->
  </div> <!-- END row -->
  </div> <!-- container end  -->
<?php require APPROOT . '/views/lds/footer.php';?>  

