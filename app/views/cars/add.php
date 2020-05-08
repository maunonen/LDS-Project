<?php require APPROOT . '/views/lds/header.php' ?>
<div class="container">
  <div class="row">
    <div class="col-md mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Add Car</h2>
        <p>Please fill all fields</p>  
        <?php flash('user_message'); ?>
        <form action="<?php echo URLROOT;?>/cars/add" method="POST">
          <div class="form-row">
            <div class="form-group col-md">
              <label for="brand">Brand</label>
              <select 
                type="text"
                name="brand"
                class="form-control form-control-lg  <?php echo (!empty($data['brand_err'])) ? 'is-invalid' : ''; ?>" 
                value="<?php echo $data['brand'] ; ?>"
              > 
                <?php foreach( $data['brand_list'] as $brand ) : ?>
                  <option value="<?php echo $brand->name; ?>"><?php echo $brand->name;  ?></option>
                <?php endforeach;?>
              </select>
              <span class="invalid-feedback"><?php echo $data['brand_err']; ?></span>
            </div>
            <div class="form-group col-md">
              <label for="model">Model</label>
              <select 
                type="text"
                name="model"
                class="form-control form-control-lg  <?php echo (!empty($data['model_err'])) ? 'is-invalid' : ''; ?>" 
                value="<?php echo $data['model'] ; ?>"
              > 
                <?php foreach( $data['model_list'] as $model ) : ?>
                  <option value="<?php echo $model->name; ?>"><?php echo $model->name;  ?></option>
                <?php endforeach;?>
              </select>
              <span class="invalid-feedback"><?php echo $data['model_err']; ?></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md">
              <label for="reg_number">Registration number</label>
              <input 
                type="text"
                name="reg_number"
                class="form-control form-control-lg  <?php echo (!empty($data['reg_number_err'])) ? 'is-invalid' : ''; ?>" 
                value="<?php echo $data['reg_number'] ; ?>"
              >  
              <span class="invalid-feedback"><?php echo $data['reg_number_err']; ?></span>
            </div>
            <div class="form-group col-md">
              <label for="brand">Color</label>
              <select 
                type="text"
                name="color"
                class="form-control form-control-lg  <?php echo (!empty($data['color_err'])) ? 'is-invalid' : ''; ?>" 
                value="<?php echo $data['color'] ; ?>"
              > 
                <?php foreach( $data['color_list'] as $color ) : ?>
                  <option value="<?php echo $color->color_name; ?>"><?php echo $color->color_name;  ?></option>
                <?php endforeach;?>
              </select>
              <span class="invalid-feedback"><?php echo $data['brand_err']; ?></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md">
              <label for="issued_year">Issued Year</label>
              <input 
                type="text"
                name="issued_year"
                class="form-control form-control-lg  <?php echo (!empty($data['issued_year_err'])) ? 'is-invalid' : ''; ?>" 
                value="<?php echo $data['issued_year'] ; ?>"
              >  
              <span class="invalid-feedback"><?php echo $data['issued_year_err']; ?></span>
            </div>
            <div class="form-group col-md">
              <label for="photo_url">Car photo</label>
              <input 
                type="text"
                name="photo_url"
                class="form-control form-control-lg  <?php echo (!empty($data['photo_url_err'])) ? 'is-invalid' : ''; ?>" 
                value="<?php echo $data['photo_url'] ; ?>"
              >  
              <span class="invalid-feedback"><?php echo $data['photo_url_err']; ?></span>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <input type="submit" value="Add" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>/cars/delete" class="btn btn-danger btn-block">delete</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/lds/footer.php' ?>
