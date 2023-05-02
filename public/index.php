<?php
require_once('../private/initialize.php');

$page_title = 'Home';
include(SHARED_PATH . '/header.php');
?>

<!--Home - Top-->
<header id="banner" role="banner">
  <div class="container">
    <h1><span>Welcome To</span> My Crafty Mind</h1>
    <!-- <h2>Best Prices This Season</h2> -->
    <p class="intro-container text-center px-5 text-md fw-light"><?php echo h("We specialize in handmade wood products that add beauty and functionality to your home. From decorative accents to practical storage solutions, each of our items is lovingly crafted to bring a unique touch to your living space. Browse our selection and discover the perfect piece to enhance your home's style and organization."); ?></h4>
      <!-- <button>Shop Now</button> -->
  </div>
</header>

<!---Featured-->
<main role="main" id="main-content" tabindex="-1">
  <section id="featured" class="my-5 py-5">
    <div class="container text-center mt-5 py-5">
      <h2>Products</h2>
      <hr class="mx-auto">
      <p>Check out some of our products</p>
    </div>

    <?php
    $stmt = $connection->prepare("SELECT * FROM product JOIN image ON product.product_id = image.product_id LIMIT 8");
    $stmt->execute();
    $featured_products = $stmt->get_result();
    ?>

    <div class="row mx-auto container">
      <?php while ($row = $featured_products->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <a class="buy-btn" href="<?php echo h("single_product.php?product_id=" . $row['product_id']); ?>">
            <img class="img-fluid mb-3" src="<?php echo h("images/" . $row['image_name']); ?>" alt="<?php echo h($row['alt_text']); ?>">
            <h3 class="p-name"><?php echo h($row['product_name']); ?></h3>
            <p class="p-price">$ <?php echo h($row['product_price']); ?></p>
            <span>Shop Now</span>
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