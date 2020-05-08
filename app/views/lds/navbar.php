<!-- Navbar Start-->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container">
    <a href="<?php echo URLROOT;?>/pages/index" class="navbar-brand">LDS taxi</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <?php if(isset( $_SESSION['user_id'])) :  ?>
          <li class="nav-item">
            <a href="<?php echo URLROOT;?>/rentals/index" class="nav-link">My rentals</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT;?>/cars/index" class="nav-link">Cars</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT;?>/users/profile">Welcome <?php echo $_SESSION['user_name'];?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT;?>/users/logout">Logout</a>
          </li>
        <?php else :?>
          <li class="nav-item active">
            <a href="<?php echo URLROOT;?>/pages/index" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT;?>/pages/about" class="nav-link">About us</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT;?>/pages/contact" class="nav-link">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT;?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT;?>/users/login">Login</a>
          </li>
        <?php endif; ?> 
      </ul>
    </div>
  </div>
</nav>
        <!-- Navbar End -->