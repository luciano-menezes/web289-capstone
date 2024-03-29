<?php
require_once('../initialize.php');

$page_title = 'Admin New Product';

// Check if the current page requires the sidebar
$showSidebar = true; // Set this to false for pages where the sidebar is not needed

include(SHARED_PATH . '/admin_header.php');
?>

<div class="container-fluid">
  <div class="row" style="min-height: 1000px">
    <?php include('sidemenu.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" role="main" id="main-content" tabindex="-1">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">

          </div>

        </div>
      </div>

      <h2>Create Product</h2>
      <div class="table-responsive">

        <div class="mx-auto container">
          <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo h($_GET['error']);
                                    } ?></p>
            <div class="form-group mt-2">
              <label for="product-name">Title</label>
              <input type="text" class="form-control" id="product-name" name="title" placeholder="Title" required />
            </div>
            <div class="form-group mt-2">
              <label for="product-desc">Description</label>
              <input type="text" class="form-control" id="product-desc" name="description" placeholder="Description" required />
            </div>
            <div class="form-group mt-2">
              <label for="product-price">Price</label>
              <input type="text" class="form-control" id="product-price" name="price" placeholder="Price" required />
            </div>
            <div class="form-group mt-2">
            </div>

            <div class="form-group mt-2">
              <label for="category">Category</label>
              <select class="form-select" id="category" required name="category">
                <option value="" hidden>Select a category</option> <!-- Placeholder option with label -->
                <option value="1">Ceiling Hang Pot Racks</option>
                <option value="3">Coat Rack</option>
                <option value="4">Greeting Cards</option>
                <option value="2">Jewelry Organizer</option>
              </select>
            </div>

            <div class="form-group mt-2">
              <label for="image">Image</label>
              <input type="file" class="form-control" id="image" name="image" required />
            </div>

            <div class="form-group mt-3">
              <input type="submit" class="btn btn-primary" name="create_product" value="Create" />
            </div>

          </form>
        </div>

      </div>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<!-- <script src="dashboard.js"></script> -->
</body>

</html>