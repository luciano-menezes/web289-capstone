<?php
require_once('../private/initialize.php');

$page_title = 'Home';
include(SHARED_PATH . '/header.php');

include('../private/get_featured_products.php');
?>

<!--Home - Top-->
<header id="banner" role="banner">
  <div class="container">
    <h1 class="display-4"><span>Welcome To</span> My Crafty Mind</h1>
    <!-- <h2>Best Prices This Season</h2> -->
    <h4 class="intro-container text-center px-5 text-md fw-light"><?php echo h("We specialize in handmade wood products that add beauty and functionality to your home. From decorative accents to practical storage solutions, each of our items is lovingly crafted to bring a unique touch to your living space. Browse our selection and discover the perfect piece to enhance your home's style and organization."); ?></h4>
    <!-- <button>Shop Now</button> -->
  </div>
</header>

<!---Featured-->
<main role="main" id="main-content" tabindex="-1">
  <section id="featured" class="my-5 py-5">
    <div class="container text-center mt-5 py-5">
      <h3>Products</h3>
      <hr class="mx-auto">
      <p>Check out some of our products</p>
    </div>

    <!-- the loop fetches the featured products from the database and displays them in a product section...
...the product section contains an image of the product, the product name, the price, and a "Shop Now" button that links to the single product page.-->
    <div class="row mx-auto container">
      <?php while ($row = $featured_products->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <a href="<?php echo h("single_product.php?product_id=" . $row['product_id']); ?>">
            <img class="img-fluid mb-3" src="<?php echo h("images/" . $row['image_name']); ?>">
            <h5 class="p-name"><?php echo h($row['product_name']); ?></h5>
            <p class="p-price">$ <?php echo h($row['product_price']); ?></p>
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