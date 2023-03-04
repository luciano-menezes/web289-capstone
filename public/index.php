<!-- establish a connection to the database and define constants for paths -->
<?php require_once('../private/initialize.php'); ?>
<?php include('../private/get_featured_products.php'); ?>

<!-- The page title and the header file. -->
<?php
$page_title = 'Home Page';
include(SHARED_PATH . '/header.php');
?>

<!--Home - Top-->
<header id="banner" role="banner">
  <div class="container">
    <h1>Welcome To Healing Food Craft</h1>
    <h2><span>Best Prices</span> This Season</h2>
    <h3>Making spaces beautiful and functional</h3>
    <button>Shop Now</button>
  </div>
</header>

<!---Featured-->
<main role="main" id="main-content" tabindex="-1">
  <section id="featured" class="my-5 py-5">
    <div class="container text-center mt-5 py-5">
      <h3>Featured Products</h3>
      <hr class="mx-auto">
      <p>Check it out our featured products</p>
    </div>


    <!-- the loop fetches the featured products from the database and displays them in a product section...
...the product section contains an image of the product, the product name, the price, and a "Shop Now" button that links to the single product page.-->
    <div class="row mx-auto container">
      <?php while ($row = $featured_products->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="images/<?php echo $row['image_name']; ?>" alt="" width="" height="">
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <p class="p-price">$ <?php echo $row['product_price']; ?></p>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
            <button class="buy-btn">Shop Now</button>
          </a>
        </div>

      <?php } ?>
    </div>
  </section>
</main>

<!-----Footer----->
<!-- footer file, with the closing tags and scripts. -->
<?php
include(SHARED_PATH . '/footer.php');
?>