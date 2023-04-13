<?php include('admin_header.php'); ?>
</header>

<div class="container-fluid">
  <div class="row" style="min-height: 1000px">

    <?php include('sidemenu.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">

          </div>

        </div>
      </div>

      <h2>Edit Order</h2>
      <div class="table-responsive">

        <div class="mx-auto container">
          <form id="edit-order-form" enctype="multipart/form-data">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo $_GET['error'];
                                    } ?></p>
            <div class="form-group my-3">
              <label>OrderId</label>
              <p class="my-4">#</p>

            </div>
            <div class="form-group mt-3">
              <label>OrderPrice</label>
              <p class="my-4">#</p>

            </div>

            <div class="form-group my-3">
              <label>Order Status</label>
              <select class="form-select" required name="category">
                <option value="not paid">Not Paid</option>
                <option value="paid">Paid</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
              </select>
            </div>

            <div class="form-group my-3">
              <label>OrderDate</label>
              <p class="my-4">#</p>

            </div>

            <div class="form-group mt-3">
              <input type="submit" class="btn btn-primary" name="edit_order" value="Edit" />
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
<script src="dashboard.js"></script>
</body>

</html>