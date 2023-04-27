<?php
require_once('../private/initialize.php');
?>

<?php

//if user has already registered, then take user to account page
if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if (isset($_POST['signup'])) {

  $first_name = trim(h($_POST['first-name']));
  $last_name = trim(h($_POST['last-name']));
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = trim(h($_POST['password']));
  $confirm_password = trim(h($_POST['confirmPassword']));
  $user_level = 'u';
  $street_1 = trim(h($_POST['street1']));
  $street_2 = trim(h($_POST['street2']));
  $city = trim(h($_POST['city']));
  $state = trim(h($_POST['state']));
  $zip_code = trim(h($_POST['zip-code']));

  //if passwords don't match
  if ($password != $confirm_password) {
    header('location: signup.php?error=Passwords don\'t match');

    //if password is less than 6 char
  } else if (strlen($password) < 6) {
    header('location: signup.php?error=Password must be at least 6 characters');

    //if there is not error
  } else {

    //check weather there is a user with this email or not
    $stmt1 = $connection->prepare("SELECT count(*) FROM `user` where email=?");
    if (!$stmt1) {
      die("Error: " . mysqli_error($connection));
    }
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($num_rows);
    $stmt1->fetch();
    $stmt1->free_result(); // free up the result set

    //if there's a user already registered with this email
    if ($num_rows != 0) {
      header('location: signup.php?error=This email already exists');

      //if no user registered with this email before
    } else {

      //create a new user
      $stmt = $connection->prepare("INSERT INTO `user` (first_name, last_name, email, user_password, user_level, street_1, street_2, city, state_abbrev, zip_code)
                          VALUES (?,?,?,?,?,?,?,?,?,?)");
      if (!$stmt) {
        die("Error: " . mysqli_error($connection));
      }
      $stmt->bind_param('ssssssssss', $first_name, $last_name, $email, md5($password), $user_level, $street_1, $street_2, $city, $state, $zip_code);
      // $stmt->execute();
      //if account was created successfully  
      if ($stmt->execute()) {
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['logged_in'] = true;

        // Set session variable with username
        $_SESSION['username'] = $first_name;

        header('location: account.php?signup_success=You signed up successfully!');

        //account could not be created
      } else {
        header('location: signup.php?error=Could not create an account at the moment!');
      }
    }
  }
}
?>

<?php
$page_title = 'Sign Up';
include(SHARED_PATH . '/header.php');
?>

<!--Sign Up-->
<main role="main" id="main-content" tabindex="-1">
  <section class="my-5 py-5"></section>
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Sign Up</h2>
    <hr class="mx-auto">
  </div>
  <div class="mx-auto container">
    <form id="signup-form" method="POST" action="signup.php">
      <p style="color: red;"><?php if (isset($_GET['error'])) {
                                echo h($_GET['error']);
                              } ?></p>
      <div class="form-group">
        <div>
          <label for="signup-first-name">First Name</label>
          <input type="text" class="form-control" id="signup-first-name" name="first-name" placeholder="First Name" required>
        </div>

        <div>
          <label for="signup-last-name">Last Name</label>
          <input type="text" class="form-control" id="signup-last-name" name="last-name" placeholder="Last Name" required>
        </div>

        <label for="signup-email">Email</label>
        <input type="email" class="form-control" id="signup-email" name="email" placeholder="Email" required>
      </div>

      <div class="form-group">
        <label for="signup-password">Password</label>
        <input type="password" class="form-control" id="signup-password" name="password" placeholder="Password" required>
      </div>

      <div class="form-group">
        <label for="signup-confirm-password">Confirm Password</label>
        <input type="password" class="form-control" id="signup-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
      </div>

      <div class="form-group">
        <label for="checkout-street1">Street1</label>
        <input type="text" class="form-control" id="checkout-street1" name="street1" placeholder="Street1" required>
      </div>

      <div class="form-group">
        <label for="checkout-street2">Street2</label>
        <input type="text" class="form-control" id="checkout-street2" name="street2" placeholder="Street2">
      </div>

      <div class="form-group">
        <label for="checkout-city">City</label>
        <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
      </div>

      <div class="form-group">
        <label for="checkout-state">State</label>
        <select type="text" class="form-control" id="checkout-state" name="state" placeholder="State" required>
          <option value="">Select State</option>
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
        </select>
      </div>

      <div class="form-group">
        <label for="checkout-zip">Zip Code</label>
        <input type="text" class="form-control" id="checkout-zip" name="zip-code" placeholder="Zip Code" required>
      </div>

      <div class="form-group">
        <input type="submit" class="btn" id="signup-btn" name="signup" value="Signup">
      </div>

      <div class="form-group">
        <a id="login-url" href="login.php" class="btn">Already have an account? Login!</a>
      </div>

    </form>
  </div>
  </section>
</main>
<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>