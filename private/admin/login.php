<!-- The reCAPTCHA is not active locally, only on the web host. -->

<?php
require_once('../initialize.php');
$page_title = 'Admin Login';

// Check if the current page requires the sidebar
$showSidebar = false; // Set this to false for pages where the sidebar is not needed

include(SHARED_PATH . '/admin_header.php');
?>

<?php

if (isset($_SESSION['logged_in'])) {
  header('location: index.php');
  exit;
}

if (isset($_POST['login_btn'])) {
  $email = h($_POST['email']);
  $password = md5($_POST['password']);

  // Verify reCAPTCHA

  // if (isset($_POST['g-recaptcha-response'])) {
  //   // Verify reCAPTCHA response
  //   $recaptchaResponse = $_POST['g-recaptcha-response'];
  //   $secretKey = "Secret_KEY"; // Replace with your Secret Key
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

  $stmt = $connection->prepare("SELECT user_id, first_name, last_name, email, user_password, user_level FROM `user` WHERE email = ? AND user_password = ? AND user_level = 'a' LIMIT 1");
  $stmt->bind_param('ss', $email, $password);

  if ($stmt->execute()) {
    $stmt->bind_result($user_id, $first_name, $last_name, $email, $user_password, $user_level);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $stmt->fetch();

      $_SESSION['user_id'] = $user_id;
      $_SESSION['first_name'] = $first_name;
      $_SESSION['last_name'] = $last_name;
      $_SESSION['email'] = $email;
      $_SESSION['admin_logged_in'] = true;

      header('location: index.php?login_success=Logged in successfully!');
      exit;
    } else {
      header('location: login.php?error=Could not verify your account!');
      exit;
    }
  } else {
    //error
    header('location: login.php?error=Something went wrong!');
    exit;
  }

  // Verify reCAPTCHA

  //   } else {
  //     // reCAPTCHA verification failed, show an error message or take appropriate action
  //     header('location: login.php?error=reCAPTCHA verification failed!');
  //     exit;
  //   }
  // } else {
  //   // reCAPTCHA response not present, show an error message or take appropriate action
  //   header('location: login.php?error=Please complete the reCAPTCHA verification!');
  //   exit;
  // }
}
?>

<!----------Header-------->
<div class="container-fluid">
  <div class="" style="min-height: 1000px">

    <main class="col-md-6 mx-auto col-lg-6 px-md-4 text-center" role="main" id="main-content" tabindex="-1">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="mx-auto" style="width: 100%;">Login</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">

          </div>

        </div>
      </div>

      <!-- <h2>Login</h2> -->

      <div class="table-responsive">
        <div class="mx-auto container">
          <form id="login-form" enctype="multipart/form-data" method="POST" action="login.php">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo h($_GET['error']);
                                    } ?></p>
            <div class="form-group mt-2">
              <label for="product-name">Email</label>
              <input type="email" class="form-control" id="product-name" name="email" placeholder="Email" required />
            </div>
            <div class="form-group mt-2">
              <label for="product-desc">Password</label>
              <input type="password" class="form-control" id="product-desc" name="password" placeholder="Password" required />
            </div>

            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="SITE_KEY"></div> <!-- Replace with your Site Key -->
            </div>

            <div class="form-group mt-3">
              <input type="submit" class="btn btn-primary" name="login_btn" value="Login" />
            </div>

          </form>
        </div>
      </div>
    </main>
  </div>
</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>
</body>

</html>