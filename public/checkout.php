<?php require_once('../private/initialize.php');
?>

<?php

session_start();


// if this conditions are met, let user in.
if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {

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
    <form id="checkout-form" method="post" action="../private/place_order.php">
      <div class="form-group">
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

      <div class="form-group">
        <label for="street1">Street1</label>
        <input type="text" class="form-control" id="checkout-street1" name="street1" placeholder="Street1" required>
      </div>

      <div class="form-group">
        <label for="street2">Street2</label>
        <input type="text" class="form-control" id="checkout-street2" name="street2" placeholder="Street2">
      </div>

      <div class="form-group">
        <label for="city">City</label>
        <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
      </div>

      <div class="form-group">
        <label for="State">State</label>
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
        <label for="Zip-Code">Zip Code</label>
        <input type="text" class="form-control" id="checkout-zip" name="zip-code" placeholder="Zip Code" required>
      </div>

      <div class="form-group checkout-btn-container">
        <p><strong>Total Amount: $ <?php echo $_SESSION['total']; ?></strong></p>
        <input type="submit" class="btn" id="checkout-btn" name="place-order" value="Place Order">
      </div>
    </form>
  </div>

</section>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>