<?php
require_once('../private/initialize.php');

session_start()
?>



<?php
$page_title = 'Payment';
include(SHARED_PATH . '/header.php');
?>

<!--Payment-->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Payment</h2>
    <hr class="mx-auto">
  </div>
  <div class="mx-auto container text-center">
    <p>Total payment: $<?php if (isset($_SESSION['total'])) {
                          echo $_SESSION['total'];
                        } ?></p>
    <?php if (isset($_SESSION['total'])) { ?>
      <input class="btn btn-primary" type="submit" value="Pay Now">
    <?php  } ?>
  </div>
</section>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>