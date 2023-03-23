<?php require_once('../private/initialize.php'); ?>

<?php

session_start();

// if this conditions are met, let user in.
if (!empty($_SESSION['cart'])) {

  //if not, send user to the home page.
} else {
  header('location: index.php');
}

?>

<?php
$page_title = 'Checkout';
include(SHARED_PATH . '/header.php');
?>

<!--Checkout-->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Checkout</h2>
    <hr class="mx-auto">
  </div>

  <div class="mx-auto container">
    <form id="checkout-form" method="POST" action="../private/place_order.php">
      <p class="text-center" style="color: red;"><?php if (isset($_GET['message'])) {
                                                    echo $_GET['message'];
                                                  } ?>
        <?php if (isset($_GET['message'])) { ?>

          <a href="login.php" class="btn btn-primary">Login</a>
          <a href="signup.php" class="btn btn-primary">Sign Up</a>

        <?php } ?>
      </p>
      <div class="form-group checkout-small-element">
        <label for="first-name">First Name</label>
        <input type="text" class="form-control" id="checkout-first-name" name="first-name" placeholder="First Name" required>
      </div>

      <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" class="form-control" id="checkout-last-name" name="last-name" placeholder="Last Name" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
      </div>

      <div class="form-group checkout-btn-container">
        <p><strong>Total Amount: $ <?php echo $_SESSION['total']; ?></strong></p>
        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
      </div>
    </form>
  </div>

</section>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>