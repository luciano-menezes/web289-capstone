<?php
//session_start();
require_once('../private/initialize.php');
?>

<?php

if (isset($_POST['add_to_cart'])) {

  //if user has already an added product to cart
  if (isset($_SESSION['cart'])) {

    $products_array_ids = array_column($_SESSION['cart'], "product_id");

    //if product has been added to cart or not
    if (!in_array($_POST['product_id'], $products_array_ids)) {

      $product_id = $_POST['product_id'];

      $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'image_name' => $_POST['image_name'],
        'product_quantity' => $_POST['product_quantity'],
      );

      $_SESSION['cart'][$product_id] = $product_array;

      //product has already been added
    } else {

      echo '<script>alert("Product was already added to cart")</script>';
    }

    //if this is the first product
  } else {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $image_name = $_POST['image_name'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = array(
      'product_id' => $product_id,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'image_name' => $image_name,
      'product_quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $product_array;
  }

  //calculate total
  calculateTotalCart();

  //remove product from cart
} else if (isset($_POST['remove_product'])) {

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  //calculate total
  calculateTotalCart();
} else if (isset($_POST['edit_product_quantity'])) {

  //get id and product_quantity from the form 
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  //get the product array from the session
  $product_array = $_SESSION['cart'][$product_id];

  //update product product_quantity
  $product_array['product_quantity'] = $product_quantity;

  //return array back to its place
  $_SESSION['cart'][$product_id] = $product_array;

  //calculate total
  calculateTotalCart();
} else {
  //header('location: index.php');
}

?>
<?php
$page_title = 'Shopping Cart';
include(SHARED_PATH . '/header.php');
?>
<!--Cart-->
<section class="cart container my-5 py-5">
  <div class="container mt-5">
    <h2 class="font-weight-bold">Your Cart</h2>
  </div>

  <table class="mt-5 pt-5">
    <tr>
      <th>Product</th>
      <th>Quantity</th>
      <th>Subtotal</th>
    </tr>

    <?php if (isset($_SESSION['cart'])) { ?>

      <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
        <tr>
          <td>
            <div class="product-info">
              <img src="images/<?php echo $value['image_name']; ?>">
              <div>
                <p><?php echo $value['product_name']; ?></p>
                <small><span>$</span><?php echo $value['product_price']; ?></small>
                <br>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                  <input type="submit" name="remove_product" class="remove-btn" value="remove" />
                </form>
              </div>
            </div>
          </td>
          <td>
            <form method="post" action="cart.php">
              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
              <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
              <input type="submit" class="edit-btn" value="edit" name="edit_product_quantity" />
            </form>

          </td>
          <td>
            <span>$</span>
            <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
          </td>
        </tr>

      <?php } ?>

    <?php } ?>

  </table>

  <div class="cart-total">
    <table>
      <tr>
        <td>Total</td>
        <?php if (isset($_SESSION['cart'])) { ?>
          <td>$ <?php echo $_SESSION['total']; ?></td>
        <?php } ?>
      </tr>
    </table>
  </div>

  <div class="checkout-container">
    <form method="post" action="checkout.php">
      <input type="submit" class="btn checkout-btn" name="checkout" value="Proceed to checkout">

    </form>
  </div>
</section>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>