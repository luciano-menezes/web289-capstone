<?php
if (!isset($page_title)) {
  $page_title = 'My Crafty Mind';
}

// get the current page's filename
$current_page = h(basename($_SERVER['PHP_SELF']));

// set the "active" class on the corresponding nav-item
if ($current_page == 'index.php') {
  $nav_item1_class = 'active';
} elseif ($current_page == 'about.php') {
  $nav_item2_class = 'active';
} elseif ($current_page == 'contact_us.php') {
  $nav_item3_class = 'active';
} elseif ($current_page == 'cart.php') {
  $nav_item4_class = 'active';
} elseif ($current_page == 'login.php' || $current_page == 'navbar_logout.php' || $current_page == 'account.php') {
  $nav_item5_class = 'active';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>My Crafty Mind - <?php echo h($page_title) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css">
  <link href="favicon.ico" rel="icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div id="wrapper">
    <a href="#main-content" id="bypass">Skip to main content</a>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top" role="navigation">
      <div class="container">
        <img class="logo" src="images/logo.png" alt="The business logo" width="500" height="500">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item <?php echo h($nav_item1_class ?? '')  ?>">
              <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item <?php echo h($nav_item2_class ?? '')  ?>">
              <a class="nav-link" href="about.php">About</a>
            </li>

            <li class="nav-item <?php echo h($nav_item3_class ?? '')  ?>">
              <a class="nav-link" href="contact_us.php">Contact Us</a>
            </li>

            <li class="nav-item <?php echo h($nav_item4_class ?? '')  ?>">
              <a href="cart.php">
                <i class="fas fa-shopping-cart">Cart
                  <?php if (isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                    <span class="cart-quantity"><?php echo h($_SESSION['quantity']); ?></span>
                  <?php } ?>
                </i>
              </a>
            </li>

            <li class="nav-item dropdown <?php echo h($nav_item5_class ?? '')  ?>">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                if (isset($_SESSION['username'])) {
                  echo 'Hello, ' . h($_SESSION['username']);
                } else {
                  echo 'Hello, log in';
                  // echo '<i class="fas fa-sign-in-alt"></i>'; // Add login button icon
                }
                ?>
              </a>
              <ul class="dropdown-menu">
                <?php if (isset($_SESSION['username'])) { // If user is logged in, show logout link 
                ?>
                  <li><a class="dropdown-item" href="navbar_logout.php">Logout</a></li>
                  <li><a class="dropdown-item" href="account.php">Account</a></li>
                <?php } else { // If user is not logged in, show login link 
                ?>
                  <li><a class="dropdown-item" href="login.php">Log in</a></li>
                  <li><a class="dropdown-item" href="account.php">Account</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="signup.php">New customer? Sign Up here</a></li>
                <?php } ?>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </nav>