<?php
require_once('initialize.php');

session_start();

if (isset($_POST['place-order'])) {

  //1. get user info and store it in the database
  $first_name = $_POST['first-name'];
  $last_name = $_POST['last-name'];
  $email = $_POST['email'];
  $street_1 = $_POST['street1'];
  $street_2 = $_POST['street2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip_code = $_POST['zip-code'];
  $total_cost = $_SESSION['total'];
  $user_id = 1;
  $order_date = date('Y-m-d H:i:s');

  // Prepare and execute the user insert statement
  $stmt = $connection->prepare("INSERT INTO `user` (first_name, last_name, email, street_1, street_2, city, state_abbrev, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  if (!$stmt) {
    die('Error: ' . $connection->error);
  }
  $stmt->bind_param('ssssssss', $first_name, $last_name, $email, $street_1, $street_2, $city, $state, $zip_code);
  $stmt->execute();
  if ($stmt->error) {
    die('Error: ' . $stmt->error);
  }
  $user_id = $stmt->insert_id;
  $stmt->close();

  // Prepare and execute the order insert statement
  $stmt = $connection->prepare("INSERT INTO `order` (total_cost, order_date, user_id) VALUES (?, ?, ?)");
  if (!$stmt) {
    die('Error: ' . $connection->error);
  }
  $stmt->bind_param('isi', $total_cost, $order_date, $user_id);
  $stmt->execute();
  if ($stmt->error) {
    die('Error: ' . $stmt->error);
  }
  //2. issue new order and store order info in the database
  $order_id = $stmt->insert_id;
  $stmt->close();

  //3. get products from cart (from session)

  foreach ($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];
    $product_id = $product['product_id'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];

    //4. store single item in order_items database
    $stmt1 = $connection->prepare("INSERT INTO `order_item` (order_id, product_id, item_price, quantity)
                          VALUES(?,?,?,?)");

    $stmt1->bind_param('iidi', $order_id, $product_id, $product_price, $product_quantity);
    $stmt1->execute();
  }
  //5. remove everything from cart --> delay until payment is done
  //unset($_SESSION['cart]);


  //6.inform user weather everything is ok or if there's a problem
  header('location: ../payment.php');
}
