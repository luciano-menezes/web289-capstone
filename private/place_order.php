<?php
session_start();
require_once('initialize.php');

//if user is not logged in
if (!isset($_SESSION['logged_in'])) {
  header('location: ../public/checkout.php?message=Please login/signup to place an order!');
  exit;

  //if user is logged in
} else {

  if (isset($_POST['place_order'])) {

    //1. get user info and store it in the database
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $total_cost = $_SESSION['total'];
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    // Get user's address information from the user table
    $address = find_user_address_by_id($user_id);

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
      $quantity = $product['product_quantity'];

      //4. store single item in order_items database
      $stmt1 = $connection->prepare("INSERT INTO `order_item` (order_id, product_id, item_price, quantity)
                          VALUES(?,?,?,?)");

      $stmt1->bind_param('iidi', $order_id, $product_id, $product_price, $quantity);
      $stmt1->execute();
    }
    //5. remove everything from cart --> delay until payment is done
    //unset($_SESSION['cart]);


    //6.inform user weather everything is ok or if there's a problem
    header('location: ../public/payment.php');
  }
}
