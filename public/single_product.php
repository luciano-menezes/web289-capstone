<?php require_once('../private/initialize.php');
$connection = db_connect();
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

<?php
$page_title = 'Home Page';
include(SHARED_PATH . '/header.php');
?>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
  <div class="container">
    <img class="logo" src="images/logo-test.jpeg" alt="" width="" height="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="shop.html">Shop</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact Us</a>
        </li>

        <li class="nav-item">
          <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
          <a href="account.html"><i class="fas fa-user"></i></a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!--Single Products-->
<section class="container single-product my-5 pt-5">
  <div class="row mt-5 p-4">
    <?php while ($row = $products->fetch_assoc()) { ?>
      <div class="col-lg-5 col-md-6 col-sm-12">
        <img id="main-img" class="img-fluid w-100 pb-1" src="images/<?php echo $row['image_name'] ?>" alt="" width="" height="">
      </div>


      <div class="col-lg-6 col-md-12 col-sm-12">
        <h4 class="py-4"><?php echo $row['product_name']; ?></h4>
        <h5></h5>
        <p>$ <?php echo $row['product_price']; ?></p>
        <input type="number" value="1">
        <button class="buy-btn">Add To Cart</button>
        <p class="mt-5 mb-5">Product Details</p>
        <span>
          <?php echo $row['product_description']; ?>
        </span>
      </div>
    <?php } ?>
  </div>
</section>

<!---Related Products-->
<!-- <section id="related-products" class="my-5 py-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related Products</h3>
      <hr class="mx-auto">
    </div>
    <div class="row mx-auto container">
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/featured1.jpeg" alt="" width="" height="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Sport Shoes</h5>
        <p class="p-price">$199.99</p>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/featured2.jpeg" alt="" width="" height="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Sport Shoes</h5>
        <p class="p-price">$199.99</p>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/featured3.jpeg" alt="" width="" height="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Sport Shoes</h5>
        <p class="p-price">$199.99</p>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/featured4.jpeg" alt="" width="" height="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Sport Shoes</h5>
        <p class="p-price">$199.99</p>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>
  </section> -->

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>