<?php require_once('../private/initialize.php'); ?>

<?php
$page_title = 'Home Page';
include(SHARED_PATH . '/header.php');
?>

<!--Home - Top-->
<section id="home-top">
  <div class="container">
    <!-- <h1>New Arrivals</h1>
        <h2><span>Best Prices</span> This Season</h2>
        <p>Our shop offers the best products for the most affordable prices</p>
        <button>Shop Now</button>-->
  </div>
</section>

<!---Featured-->
<section id="feature" class="my-5 py-5">
  <div class="container text-center mt-5 py-5">
    <h3>Featured Products</h3>
    <hr class="mx-auto">
    <p>Check it out our featured products</p>
  </div>
  <div class="row mx-auto container">

    <?php include('../private/get_featured_products.php'); ?>

    <?php while ($row = $featured_products->fetch_assoc()) { ?>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="images/<?php echo $row['image_name']; ?>" alt="" width="" height="">
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <p class="p-price">$ <?php echo $row['product_price']; ?></p>
        <button class="buy-btn">Shop Now</button>
      </div>

    <?php } ?>
  </div>
</section>

<?php
include(SHARED_PATH . '/footer.php');
?>