<?php
require_once('../initialize.php');

if (isset($_POST['create_product'])) {

  $product_name = $_POST['title'];
  $product_description = $_POST['description'];
  $product_price = $_POST['price'];
  $category_id = $_POST['category'];


  //this is the file itself (image)
  $image = $_FILES['image']['tmp_name'];

  //image names
  $image_name = $product_name . "img.jpeg";

  //upload images
  move_uploaded_file($image, "../../public/images/" . $image_name);

  // Create a new product in the product table
  $stmt = $connection->prepare("INSERT INTO `product` (product_name, product_description, product_price, category_id)
VALUES (?, ?, ?,?)");
  if (!$stmt) {
    // display the error message
    echo $connection->error;
    exit;
  }

  $stmt->bind_param('ssdi', $product_name, $product_description, $product_price, $category_id);
  if (!$stmt->execute()) {
    echo $stmt->error;
    exit;
  }

  // Get the ID of the newly created product
  $product_id = $stmt->insert_id;

  // Insert the image name for the new product in the image table
  $stmt = $connection->prepare("INSERT INTO `image` (product_id, image_name)
VALUES (?, ?)");
  if (!$stmt) {
    // display the error message
    echo $connection->error;
    exit;
  }
  $stmt->bind_param('is', $product_id, $image_name);
  if (!$stmt->execute()) {
    echo $stmt->error;
    exit;
  }


  // Insert the category name for the new product in the category table
  //   $stmt = $connection->prepare("INSERT INTO `category` (product_id, category_name)
  // VALUES (?, ?)");
  //   if (!$stmt) {
  //     // display the error message
  //     echo $connection->error;
  //     exit;
  //   }
  //   $stmt->bind_param('is', $product_id, $category_name);
  //   if (!$stmt->execute()) {
  //     echo $stmt->error;
  //     exit;
  //   }

  if ($stmt->affected_rows > 0) {
    header('location: products.php?product_created=Product has been created successfully');
    exit;
  } else {
    header('location: products.php?product_failed=Error occurred, try again');
    exit;
  }
}
