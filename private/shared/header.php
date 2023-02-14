<?php
if (!isset($page_title)) {
  $page_title = 'Healing Food Craft';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Healing Food Craft - <?php echo ($page_title) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
      <img class="logo" src="images/logo-test.jpeg" alt="" width="" height="">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Shop</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>

          <li class="nav-item">
            <a href="#"><i class="fas fa-shopping-cart"></i></a>
            <a href="#"><i class="fas fa-user"></i></a>
          </li>

        </ul>
      </div>
    </div>
  </nav>