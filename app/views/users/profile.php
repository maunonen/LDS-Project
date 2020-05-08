<?php require APPROOT . '/views/lds/header.php';?>  

<div class="container">
  <div class="row">
    <div class="col-md mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>User profile</h2>
        <p>Please fill out this profile form</p>
        <?php flash('user_message'); ?>
        <form action="<?php echo URLROOT?>/users/profile" method="POST">
          <div class="form-row">
            <div class="form-group col-md">
              <label for="username">Username: <sup>*</sup></label>
              <input 
                type="text" 
                name="username" 
                class="form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['username']?>"
              >
              <span class="invalid-feedback"><?php echo $data['username_err']?></span>
            </div>
            <div class="form-group col-md">
              <label for="email">Email: <sup>*</sup></label>
              <input 
                placeholder="example@gmail.com"
                type="email" 
                name="email" 
                class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['email']?>"
              >
              <span class="invalid-feedback"><?php echo $data['email_err']?></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md">
              <label for="first_name">First name: <sup>*</sup></label>
              <input 
                type="text" 
                placeholder="John"
                name="first_name" 
                class="form-control form-control-lg <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['first_name']?>"
              >
              <span class="invalid-feedback"><?php echo $data['first_name_err']?></span>
            </div>

            <div class="form-group col-md">
              <label for="last_name">Last name: <sup>*</sup></label>
              <input 
                type="text" 
                name="last_name" 
                placeholder="Doe"
                class="form-control form-control-lg <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['last_name']?>"
              >
              <span class="invalid-feedback"><?php echo $data['last_name_err']?></span>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md">
              <label for="user_role">Role:</label>
              <select 
                class="form-control form-control-lg  <?php echo (!empty($data['role_err'])) ? 'is-invalid' : ''; ?>"
                name="user_role"
              >
                <option value="admin" <?php echo ($data['user_role'] == 'admnin') ? 'selected' : '' ; ?>>admin</option>
                <option value="driver" <?php echo ($data['user_role'] == 'driver') ? 'selected' : ''; ?>>driver</option>
                <option value="tenant" <?php echo ($data['user_role'] == 'tenant') ? 'selected' : ''; ?>>tenant</option>
              </select>
              <span class="invalid-feedback"><?php echo $data['user_role_err']?></span>
            </div>


            
            <div class="form-group col-md">
              <label for="phone_number">Phone number: <sup>*</sup></label>
              <div class="input-group">
                <div class="input-group-prepend" id="phcode">
                  <span class="input-group-text">+358</span>
                </div>
                <input 
                  placeholder="407207272"
                  aria-describedby="phcode"
                  type="text" 
                  name="phone_number" 
                  class="form-control form-control-lg <?php echo (!empty($data['phone_number_err'])) ? 'is-invalid' : ''; ?>"
                  value="<?php echo $data['phone_number']?>"
                >
                <span class="invalid-feedback"><?php echo $data['phone_number_err']?></span>
              </div>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md">
              <label for="dl_issued_date">Driver licence issued date: <sup>*</sup></label>
              <input 
                type="date" 
                name="dl_issued_date" 
                class="form-control form-control-lg <?php echo (!empty($data['dl_issued_date_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['dl_issued_date'];?>"
              >
              <span class="invalid-feedback"><?php echo $data['dl_issued_date_err']?></span>
            </div>

            <div class="form-group col-md">
              <label for="dl_expire_date">Driver licence expire date: <sup>*</sup></label>
              <input 
                type="date" 
                name="dl_expire_date" 
                class="form-control form-control-lg <?php echo (!empty($data['dl_expire_date_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['dl_expire_date'];?>"
              >
              <span class="invalid-feedback"><?php echo $data['dl_expire_date_err']?></span>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md">
              <label for="personal_id">Personal ID: <sup>*</sup></label>
              <input 
                type="text" 
                placeholder="010676-A1234"
                name="personal_id" 
                class="form-control form-control-lg <?php echo (!empty($data['personal_id_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['personal_id']?>"
              >
              <span class="invalid-feedback"><?php echo $data['personal_id_err']?></span>
            </div>
          </div>
          
          <div class="row">
            <div class="col">
              <input type="submit" value="Save" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>/cars/list" class="btn btn-light btn-block">
                To cars List
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div> <!-- end container  -->
<?php require APPROOT . '/views/lds/footer.php';?>  