<?php require APPROOT . '/views/lds/header.php';?>  
<div class="container">
  <div class="row">
    <div class="col-md mx-auto">
      <div class="card bg-light mt-5">
        <div class="card-header">
          <h2>Add rentals</h2>
        </div>
        <div class="card-body">
          <h5 class="card-title">
            <?php echo strtoupper ($data['brand']) . ' ' . strtoupper ($data['model']) . ' ' . strtoupper($data['reg_number']); ?>
          </h5>
          <?php flash('rentals_message'); ?>
          <div class="row">
            <div class="col-md-7">
              <img src="<?php echo URLROOT . $data['photo_url'] ;?>" class="rounded img-fluid" alt="Car image">
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
            
          </div>
          
          <form action="<?php echo URLROOT;?>/rentals/add/<?php echo $data['car_id']; ?>" method="POST">

              <!-- 
                'brand' => string 'volvo' (length=5)
                'model' => string 'v40' (length=3)
                'reg_number' => string 'reg-456' (length=7)
                'photo_url' => string '/images/cars/volvo_v40_640.jpg' (length=30)
                'car_id' => string '2' (length=1)
                'user_firstmname' => string 'John' (length=4)
                'user_lastname' => string 'Doe' (length=3)
                'rental_start' => string '' (length=0)
                'rental_end' => string '' (length=0) 
              -->
            <div class="form-row mt-3">
              <div class="form-group col-md">
                <label for="rental_start">Rental start day: <sup>*</sup></label>
                <input 
                  type="date" 
                  name="rental_start" 
                  class="form-control form-control-lg <?php echo (!empty($data['rental_start_err'])) ? 'is-invalid' : ''; ?>"
                  value="<?php echo $data['rental_start'];?>"
                >
                <span class="invalid-feedback"><?php echo $data['rental_start_err']?></span>
              </div>
              <div class="form-group col-md">
                <label for="rental_end">Rental end day date: <sup>*</sup></label>
                <input 
                  type="date" 
                  name="rental_end" 
                  class="form-control form-control-lg <?php echo (!empty($data['rental_end_err'])) ? 'is-invalid' : ''; ?>"
                  value="<?php echo $data['rental_end'];?>"
                >
                <span class="invalid-feedback"><?php echo $data['rental_end_err']?></span>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <input type="submit" value="Rent" class="btn btn-success btn-block">
              </div>
              <div class="col">
                <a href="<?php echo URLROOT;?>/rentals/index<?php echo $data['car_id'];?>" class="btn btn-light btn-block">To car list</a>
              </div>
            </div>

          
          </form>
        </div> <!-- card Body end    -->
      </div>
    </div>
  </div>
  </div> <!-- container end  -->
  
  <?php require APPROOT . '/views/lds/footer.php';?>  