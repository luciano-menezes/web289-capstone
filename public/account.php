<?php
session_start();
require_once('../private/initialize.php');



if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['email']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    header('location: login.php');
    exit;
  }
}

if (isset($_POST['change_password'])) {

  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];
  $email = $_SESSION['email'];

  //if passwords don't match
  if ($password != $confirm_password) {
    header('location: account.php?error=passwords don\'t match!');

    //if password is less than 6 char
  } else if (strlen($password) < 6) {
    header('location: account.php?error=password must be at least 6 characters!');

    //no erros
  } else {
    // $stmt = $connection->prepare("UPDATE `user` SET user_password=? WHERE email=?");
    // $stmt->bind_param('ss', md5($password), $email);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("UPDATE `user` SET user_password=? WHERE email=?");
    $stmt->bind_param('ss', $hashed_password, $email);

    if ($stmt->execute()) {
      header('location: account.php?message=password has been updated successfully!');
    } else {
      header('location: account.php?error=could not update password!');
    }
  }
}

//get order
if (isset($_SESSION['logged_in'])) {
  $user_id = $_SESSION['user_id'];
  $stmt = $connection->prepare("SELECT * FROM `order` JOIN image ON order.order_id = image.product_id WHERE user_id=?");
  $stmt->bind_param('i', $user_id);
  $stmt->execute();

  $orders = $stmt->get_result();
}

$page_title = 'Account';
include(SHARED_PATH . '/header.php');
?>

<!--Account-->
<section class="my-5 py-5">
  <div class="row container mx-auto">

    <?php if (isset($_GET['payment_message'])) { ?>
      <p class="mt-5 text-center" style="color:green"> <?php echo $_GET['payment_message']; ?></p>
    <?php } ?>
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
      <p class="text-center" style="color:green"><?php if (isset($_GET['signup_success'])) {
                                                    echo $_GET['signup_success'];
                                                  } ?></p>
      <p class="text-center" style="color:green"><?php if (isset($_GET['login_success'])) {
                                                    echo $_GET['login_success'];
                                                  } ?></p>
      <h3 class="font-weight-bold">Account Info</h3>
      <hr class="mx-auto">
      <div class="account-info">
        <p>Name: <span> <?php if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
                          echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
                        } ?></span></p>
        <p>Email: <span><?php if (isset($_SESSION['email'])) {
                          echo $_SESSION['email'];
                        } ?></span></p>
        <p><a href="#orders" id="orders-btn">Your Orders</a></p>
        <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
      </div>
    </div>

    <div class="col-lg-6 col-md-12 col-sm-12">
      <form id="account-form" method="post" action="account.php">
        <p class="text-center" style="color:red"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                  } ?></p>
        <p class="text-center" style="color:green"><?php if (isset($_GET['message'])) {
                                                      echo $_GET['message'];
                                                    } ?></p>
        <h3>Change Password</h3>
        <hr class="mx-auto">
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="account-password-confirm" name="confirm-password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
        </div>
      </form>
    </div>
  </div>
</section>

<!--Orders-->
<section id="orders" class="orders container my-5 py-3">
  <div class="container mt-2">
    <h2 class="font-weight-bold text-center">Your Order</h2>
    <hr class="mx-auto">
  </div>

  <table class="mt-5 pt-5">
    <tr>
      <th>Order ID</th>
      <th>Order Cost</th>
      <th>Order Date</th>
    </tr>

    <?php while ($row = $orders->fetch_assoc()) { ?>

      <tr>
        <td>
          <!-- <div class="product-info">
            <img src="assets/imgs/featured1.jpeg" alt="" width="" height="">
            <div>
              <p class="mt-3"><?php echo $row['order_id']; ?></p>
            </div>
          </div> -->
          <span><?php echo $row['order_id']; ?></span>
        </td>
        <td>
          <span><?php echo $row['total_cost']; ?></span>
        </td>
        <td>
          <span><?php echo $row['order_date']; ?></span>
        </td>
      </tr>

    <?php } ?>
  </table>

</section>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>