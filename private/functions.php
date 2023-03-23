<?php


// Get user's address information from the user table
function find_user_address_by_id($user_id)
{
  global $connection;

  $stmt = $connection->prepare("SELECT street_1, street_2, city, state_abbrev, zip_code FROM user WHERE user_id = ?");
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $stmt->bind_result($street_1, $street_2, $city, $state_abbrev, $zip_code);
  $stmt->fetch();
  $stmt->close();

  return array(
    'street_1' => $street_1,
    'street_2' => $street_2,
    'city' => $city,
    'state_abbrev' => $state_abbrev,
    'zip_code' => $zip_code,
  );
}

//calculate the cart total
function calculateTotalCart()
{

  $total = 0;
  foreach ($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];

    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];
    $total = $total + ($product_price * $product_quantity);
  }

  $_SESSION['total'] = $total;
}

//Calculate the total price of the order
function calculateTotalOrderPrice($order_details)
{

  $total = 0;

  foreach ($order_details as $row) {
    $item_price = $row['item_price'];
    $quantity = $row['quantity'];

    $total = $total + ($item_price * $quantity);
  }
  return $total;
}
