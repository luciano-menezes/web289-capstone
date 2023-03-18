<?php
session_start();
require_once('../private/initialize.php');

$page_title = 'Account';
include(SHARED_PATH . '/header.php');

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
} else {
  header('location: account.php');
}
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


    <?php while ($row = $order_details->fetch_assoc()) { ?>
      <tr>
        <td>
          <div class="product-info">
            <img src="images/<?php echo $row['image_name']; ?>">
            <div>
              <p class=" mt-3"><?php echo $row['product_name']; ?></p>
            </div>
          </div>
        <td>
          <span>$<?php echo $row['item_price']; ?></span>
        </td>
        <td>
          <span><?php echo $row['quantity']; ?></span>
        </td>
      </tr>

    <?php } ?>
  </table>

</section>


<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>