<?php
//session_start();
require_once('../private/initialize.php');

// if this conditions are met, let user in.
if (!empty($_SESSION['cart'])) {

  //if not, send user to the home page.
} else {
  header('location: index.php');
}

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
      <div class="form-group checkout-btn-container">
        <p><strong>Total Amount: $ <?php echo $_SESSION['total']; ?></strong></p>
        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Proceed to payment">
      </div>
    </form>
    <form id="checkout-form" method="POST" action="../private/place_order.php">

  </div>

</section>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>