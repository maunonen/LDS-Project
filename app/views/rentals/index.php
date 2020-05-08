<?php require APPROOT . '/views/lds/header.php';?>  
<div class="container">
  <div class='row'>
    <div class='col'>
      <?php flash('rentals_message'); ?>
      <table class='table table-hover mt-3'>
          <thead class='thead-dark'>
            <tr>
              <th scope='col'>Rented car</th>
              <th scope='col'>Reg number</th>
              <th scope='col'>Issued Year</th>
              <!-- first_name and last_name  -->
              <th scope='col'>User name</th>
              <th scope='col'>Rental start</th>
              <th scope='col'>Rental end</th>
              <th scope='col'>Sum</th>
              <th scope='col'>Action</th>
            </tr>
          </thead>
        <tbody>
          <?php foreach( $data['rentals'] as $rental): ?>
            <tr>
              <td class="align-middle">
                <a 
                  href="<?php echo URLROOT;?>/cars/details/<?php echo $rental->car_id?>" 
                  class="btn btn-outline-secondary">
                  <?php echo $rental->brand .' ' . $rental->model . ' '. $rental->reg_number ; ?>
                </a>
              </td>
              <td class="align-middle"><?php echo $rental->reg_number; ?></td>
              <td class="align-middle"><?php echo $rental->issued_year; ?></td>
              <td class="align-middle">
                <a 
                  href="<?php echo URLROOT;?>/users/show/<?php echo $rental->user_id?>" 
                  class="btn btn-outline-secondary"><?php echo $rental->last_name .' '. $rental->first_name; ?>
                </a>
              </td>
              <td class="align-middle"><?php echo substr($rental->rental_start, 0, 10); ?></td>
              <td class="align-middle"><?php echo substr($rental->rental_end, 0, 10); ?></td>
              <td class="align-middle"><?php echo $rental->rental_sum;?> €</td>
              <td>
                <div class="align-middle">
                  <a 
                      href="<?php echo URLROOT;?>/rentals/delete/<?php echo $rental->rental_id?>" 
                      class="text-danger text-decoration-none"
                      style="font-size:1.5em"
                      ><i class="fa fa-trash-o"></i></a>
                  <a 
                      style="font-size:1.5em"
                      href="<?php echo URLROOT;?>/rentals/update/<?php echo $rental->rental_id?>" 
                      class="text-success text-decoration-none"
                      ><i class="fa fa-edit"></i></a>
                </div>
              </td>
            </tr>
            <?php endforeach;  ?>
        </tbody>
      </table>
    </div>
  </div>  
</div>
<?php require APPROOT . '/views/lds/footer.php';?>  