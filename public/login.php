<?php
session_start();
require_once('../private/initialize.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if (isset($_POST['login_btn'])) {

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $connection->prepare("SELECT user_id, first_name, last_name, email, user_password FROM `user` WHERE email = ? AND user_password = ? LIMIT 1");
  $stmt->bind_param('ss', $email, $password);

  if ($stmt->execute()) {
    $stmt->bind_result($user_id, $first_name, $last_name, $email, $user_password);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $stmt->fetch();

      // if ($email == $_POST['email'] && $password == md5($_POST['password'])) {
      $_SESSION['user_id'] = $user_id;
      $_SESSION['first_name'] = $first_name;
      $_SESSION['last_name'] = $last_name;
      $_SESSION['email'] = $email;
      $_SESSION['logged_in'] = true;

      header('location: account.php?login_success=logged in successfully!');
    } else {
      header('location: login.php?error=could not verify your account!');
    }
  } else {
    //error
    header('location: login.php?error=something went wrong!');
  }
}
// }
?>

<?php
$page_title = 'Login';
include(SHARED_PATH . '/header.php');
?>

<!--Login-->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Login</h2>
    <hr class="mx-auto">
  </div>
  <div class="mx-auto container">
    <form id="login-form" method="post" action="login.php">
      <p style="color:red" class="text-center"><?php if (isset($_GET['error'])) {
                                                  echo $_GET['error'];
                                                } ?></p>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="login-email" name="email" placeholder="email" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required>
      </div>

      <div class="form-group">
        <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login">
      </div>

      <div class="form-group">
        <a id="register-url" href="signup.php" class="btn">Don't have an account? Sign Up here</a>
      </div>

    </form>
  </div>
</section>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>