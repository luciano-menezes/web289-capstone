<?php
require_once('../initialize.php');

if (isset($_POST['create_product'])) {

  $product_name = $_POST['product_name'];
  $product_id = $_POST['product_id'];

  // check if an image file was uploaded
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image = $_FILES['image']['tmp_name'];

    // get the current image name from the database
    $stmt = $connection->prepare("SELECT image_name FROM image WHERE product_id=?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $current_image_name = $row['image_name'];

    // delete the current image file
    unlink("../../public/images/" . $current_image_name);

    // generate a new image name and upload the image file
    $image_name = $product_name . "image.jpeg";
    move_uploaded_file($image, "../../public/images/" . $image_name);

    // update the image name in the database
    $stmt = $connection->prepare("UPDATE image SET image_name=? WHERE product_id=?");
    $stmt->bind_param('si', $image_name, $product_id);

    if ($stmt->execute()) {
      header('location: products.php?images_updated=Images have been updated successfully');
    } else {
      header('location: products.php?images_failed=Error occurred, try again');
    }
  } else {
    header('location: products.php?images_failed=No image file was uploaded');
  }
}
