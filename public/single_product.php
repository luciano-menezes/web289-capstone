<!-- establish a connection to the database and define constants for paths -->
<?php require_once('../private/initialize.php');
?>

<?php
if (isset($_GET['product_id'])) {

  $product_id = $_GET['product_id'];

  $stmt = $connection->prepare("SELECT * FROM product JOIN image ON product.product_id = image.product_id WHERE product.product_id = ?");
  $stmt->bind_param("i", $product_id);
  $stmt->execute();

  $products = $stmt->get_result();
} else {
  header('location: index.php');
}
?>

<!-- The page title and the header file. -->
<?php
$page_title = 'Product Details';
include(SHARED_PATH . '/header.php');
?>

<!--Single Products-->
<!--code block responsible for displaying the details of the product based on the product_id parameter passed through the URL.-->
<section class="container single-product my-5 pt-5">
  <div class="row mt-5 p-4">
    <?php while ($row = $products->fetch_assoc()) { ?>

      <div class="col-lg-5 col-md-6 col-sm-12">
        <img id="main-img" class="img-fluid w-100" src="images/<?php echo $row['image_name'] ?>" alt="" width="" height="">
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <h4 class="py-4"><?php echo $row['product_name']; ?></h4>
        <p>$ <?php echo $row['product_price']; ?></p>

        <!--The product details are wrapped in a form tag with a hidden input field for each product detail 
        (product ID, image name, product name, and product price) to be submitted to the shopping cart page.-->
        <form method="post" action="cart.php">
          <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
          <input type="hidden" name="image_name" value="<?php echo $row['image_name'] ?>">
          <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

          <input type="number" name="product_quantity" value="1">
          <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
        </form>
        <p class="mt-5 mb-5">Product Details</p>
        <span>
          <?php echo $row['product_description']; ?>
        </span>
      </div>

    <?php } ?>
  </div>
</section>

<!--Footer-->
<!-- footer file, with the closing tags and scripts. -->
<?php
include(SHARED_PATH . '/footer.php');
?>