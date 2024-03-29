<!-- The reCAPTCHA is not active locally, only on the web host. -->

<?php
require_once('../private/initialize.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if (isset($_POST['login_btn'])) {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = md5($_POST['password']);

  // Verify reCAPTCHA

  // if (isset($_POST['g-recaptcha-response'])) {

  //   // Verify reCAPTCHA response
  //   $recaptchaResponse = $_POST['g-recaptcha-response'];
  //   $secretKey = "SECRET_KEY"; // Replace with your Secret Key
  //   $ip = $_SERVER['REMOTE_ADDR'];

  //   $url = 'https://www.google.com/recaptcha/api/siteverify';
  //   $data = array(
  //     'secret' => $secretKey,
  //     'response' => $recaptchaResponse,
  //     'remoteip' => $ip
  //   );

  //   $options = array(
  //     'http' => array(
  //       'header' => "Content-type: application/x-www-form-urlencoded\r\n",
  //       'method' => 'POST',
  //       'content' => http_build_query($data)
  //     )
  //   );

  //   $context = stream_context_create($options);
  //   $result = file_get_contents($url, false, $context);
  //   $response = json_decode($result, true);

  //   // Check if reCAPTCHA verification succeeded
  //   if ($response && $response['success']) {
  // reCAPTCHA verification passed, continue with your login logic


  $stmt = $connection->prepare("SELECT user_id, first_name, last_name, email, user_password, user_level FROM `user` WHERE email = ? AND user_password = ? AND (user_level = 'a' OR user_level = 'u') LIMIT 1");
  $stmt->bind_param('ss', $email, $password);

  if ($stmt->execute()) {
    $stmt->bind_result($user_id, $first_name, $last_name, $email, $user_password, $user_level);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $stmt->fetch();

      $_SESSION['user_id'] = $user_id;
      $_SESSION['first_name'] = h($first_name);
      $_SESSION['last_name'] = h($last_name);
      $_SESSION['email'] = h($email);
      $_SESSION['logged_in'] = true;

      // Set session variable with username
      $_SESSION['username'] = $first_name;

      header('location: index.php?login_success=Logged in successfully!');
    } else {
      header('location: login.php?error=Could not verify your account!');
    }
  } else {
    //error
    header('location: login.php?error=Something went wrong!');
  }

  // Verify reCAPTCHA

  //   } else {
  //     // reCAPTCHA verification failed, show an error message or take appropriate action
  //     header('location: login.php?error=reCAPTCHA verification failed!');
  //   }
  // } else {
  //   // reCAPTCHA response not present, show an error message or take appropriate action
  //   header('location: login.php?error=Please complete the reCAPTCHA verification!');
}

?>

<?php
$page_title = 'Login';
include(SHARED_PATH . '/header.php');
?>

<!--Login-->
<main role="main" id="main-content" tabindex="-1">
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h1 class="form-weight-bold">Login</h1>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form id="login-form" method="post" action="login.php">
        <p style="color:red" class="text-center"><?php if (isset($_GET['error'])) {
                                                    echo h($_GET['error']);
                                                  } ?></p>
        <div class="form-group">
          <label for="login-email">Email</label>
          <input type="email" class="form-control" id="login-email" name="email" placeholder="email" required>
        </div>

        <div class="form-group">
          <label for="login-password">Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required>
        </div>

        <div class="form-group">
          <div class="g-recaptcha" data-sitekey="SITE_KEY"></div> <!-- Replace with your Site Key -->
        </div>

        <div class="form-group">
          <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login">
        </div>

        <div class="form-group">
          <a id="register-url" href="signup.php" class="btn">Don't have an account? Sign Up here!</a>
        </div>
      </form>

    </div>
  </section>

  <!--Footer-->
  <?php
  include(SHARED_PATH . '/footer.php');
  ?>