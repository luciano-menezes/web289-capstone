<?php
//session_start();
require_once('../private/initialize.php');


if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

  $order_id = $_POST['order_id'];
  $stmt = $connection->prepare("SELECT product.product_name, image.image_name, order_item.quantity, order_item.item_price 
  FROM product 
  JOIN image ON product.product_id = image.product_id 
  JOIN order_item ON product.product_id = order_item.product_id
  WHERE order_item.order_id = ?");

  $stmt->bind_param("i", $order_id);
  $stmt->execute();
  $order_details = $stmt->get_result();


  $order_total_price = calculateTotalOrderPrice($order_details);
} else {
  header('location: account.php');
  exit;
}

?>

<?php

$page_title = 'Order Details';
include(SHARED_PATH . '/header.php');

?>

<!--Order Details-->
<section id="orders" class="orders container my-5 py-3">
  <div class="container mt-5">
    <h2 class="font-weight-bold text-center">Order Details</h2>
    <hr class="mx-auto">
  </div>

  <table class="mt-5 pt-5 mx-auto">
    <tr>
      <th>Product</th>
      <th>Price</th>
      <th>Quantity</th>
    </tr>


    <?php foreach ($order_details as $row) { ?>
      <tr>
        <td>
          <div class="product-info">
            <img src="images/<?php echo $row['image_name']; ?>">
            <div>
              <p class=" mt-3"><?php echo $row['product_name']; ?></p>
            </div>
          </div>
        </td>
        <td>
          <span>$<?php echo $row['item_price']; ?></span>
        </td>
        <td>
          <span><?php echo $row['quantity']; ?></span>
        </td>
      </tr>

    <?php } ?>
  </table>


  <!-- Save this payment button form in case I incorporate order status later on -->

  <!-- <form style="float: right;" method="POST" action="payment.php">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
    <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
    <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now">
  </form> -->

</section>


<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>