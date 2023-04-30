<?php

/**
 * Get user's address information from the user table.
 *
 * @param int $user_id The ID of the user.
 * @return array An associative array containing the user's address information:
 *               - 'street_1': The first line of the street address.
 *               - 'street_2': The second line of the street address.
 *               - 'city': The city name.
 *               - 'state_abbrev': The abbreviation of the state.
 *               - 'zip_code': The ZIP code.
 */
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

/**
 * Calculate the total price and quantity of items in the cart.
 *
 * This function calculates the total price and quantity of items in the cart
 * based on the product prices and quantities stored in the session variable 'cart'.
 * The calculated total price is stored in the session variable 'total',
 * and the total quantity is stored in the session variable 'quantity'.
 *
 * @return void
 */
function calculateTotalCart()
{

  $total_price = 0;
  $total_quantity = 0;
  foreach ($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];

    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];
    $total_price = $total_price + ($product_price * $product_quantity);
    $total_quantity = $total_quantity + $product_quantity;
  }

  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}

/**
 * Calculate the total price of the order.
 *
 * This function calculates the total price of the order based on the item prices
 * and quantities provided in the $order_details array.
 *
 * @param array $order_details An array containing the details of the order.
 *                            Each element should be an associative array with
 *                            'item_price' and 'quantity' keys.
 *
 * @return float The total price of the order.
 */
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

/**
 * Escape special characters to prevent XSS attacks.
 *
 * This function takes a string as input and applies the htmlspecialchars function
 * to escape special characters that have special meaning in HTML, thus preventing
 * potential cross-site scripting (XSS) attacks. The string is encoded using the
 * 'UTF-8' character encoding and the ENT_QUOTES flag is set to convert both
 * double and single quotes.
 *
 * @param string $string The string to be escaped.
 * @return string The escaped string.
 */
function h($string)
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
