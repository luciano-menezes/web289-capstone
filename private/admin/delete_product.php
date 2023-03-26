<?php session_start();
require_once('../initialize.php');
?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php');
  exit();
}

if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];
  $stmt = $connection->prepare("DELETE FROM `product` WHERE product_id=?");
  $stmt->bind_param('i', $product_id);

  $stmt1 = $connection->prepare("DELETE FROM `image` WHERE product_id=?");
  $stmt1->bind_param('i', $product_id);
  $stmt1->execute();

  $stmt3 = $connection->prepare("DELETE FROM `order_item` WHERE product_id=?");
  $stmt3->bind_param('i', $product_id);
  $stmt3->execute();


  if ($stmt->execute()) {
    header('Location: products.php?deleted_successfully=Product has been deleted successfully!');
  } else {
    header('Location: products.php?deleted_failure=Could not delete product!');
  }
}
?>
