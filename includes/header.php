<?php $rootFolder =  "/" . basename(dirname(__DIR__)) ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VagaBond</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <!-- 
    <link rel="stylesheet" href="<?php echo $rootFolder . "/css/style.css" ?>"> -->
</head>

<body>
  <header class="bg-dark">
    <div class="text-white w-100 py-2 d-flex container gap-3 ">
      <div class="d-flex align-items-center gap-1 ">
        <i data-lucide="map-pin" class="icon"></i>
        <span class="fs-6 fw-lighter ">Location: Sour-Al-Housh</span>
      </div>

      <div class="d-flex align-items-center gap-1 ">
        <i data-lucide="phone" class="icon"></i>
        <span class="fs-6 fw-lighter ">Phone Number: +961-76740055</span>
      </div>
    </div>

  </header>

  <nav class="navbar navbar-expand-lg navbar-light  bg-bg-transparent ">
    <div class="container w-100">
      <a class="navbar-brand fs-3 fw-bold" href="./">Vaga<img src="./images/soul.png" height="50px">Bond</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="ms-auto collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./#about-us">about us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./#menu">Our Menu</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./#contact-us">Contact Us</a>
          </li>


          <?php
          if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }

          if (isset($_SESSION['user'])) {
          ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo "Welcome " . $_SESSION['user']['name'] ?>
              </a>
              <ul class="dropdown-menu" style="width:fit-content" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item text-dark " href="./order-history.php">Order History</a></li>
                <li><a class="dropdown-item text-dark" href="./logout.php">Logout</a></li>
           
                <?php
                 if (isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1) {
                ?>
                  <li><a class="dropdown-item text-dark" href="./admin/">Admin Dashboard</a></li>    
                <?php
                  }
                ?>
              </ul>
            </li>
          <?php
          } else {
            // User is not logged in
            echo "<li class='nav-item'><a class='nav-link' href='./login.php'>Login</a></li>";
          }
          ?>

          <li class="cursor-pointer d-flex align-items-center justify-content-center position-relative cart-js">
            <i data-lucide="shopping-cart" class="icon"></i>
            <span class="cart-items-counter cart-items-counter-js ">0</span>
          </li>
        </ul>
      </div>
    </div>
  </nav>




  <?php include('./includes/shopping-cart.php') ?>