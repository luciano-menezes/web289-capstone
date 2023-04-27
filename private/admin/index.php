<?php
require_once('../initialize.php');
include('admin_header.php');
?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php');
  exit();
}
?>

<?php
//1. determine page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
  //if user has already entered page then page number is the one that they selected
  $page_no = h($_GET['page_no']);
} else {
  //if user just entered the page then default page is 1
  $page_no = 1;
}

//2. return number of products 
$stmt1 = $connection->prepare("SELECT COUNT(*) As total_records FROM `order`");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

//3. products per page
$total_records_per_page = 10;

$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_pages = ceil($total_records / $total_records_per_page);

//4. get all products

$stmt2 = $connection->prepare("SELECT * FROM `order` LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$orders = $stmt2->get_result();

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

      <h2>Orders</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">User ID</th>
              <th scope="col">Order Date</th>
              <th scope="col">Total Cost</th>
              <!-- <th scope="col">Edit</th>
              <th scope="col">Delete</th> -->
            </tr>
          </thead>
          <tbody>

            <?php foreach ($orders as $order) { ?>
              <tr>
                <td><?php echo h($order['order_id']); ?></td>
                <td><?php echo h($order['user_id']); ?></td>
                <td><?php echo h($order['order_date']); ?></td>
                <td><?php echo h($order['total_cost']); ?></td>

                <!-- <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td> -->
                <!-- <td><a class="btn btn-danger">Delete</a></td> -->
              </tr>
            <?php } ?>

          </tbody>
        </table>

        <!----pagination------>
        <nav aria-label="Page navigation example" class="mx-auto">
          <ul class="pagination mt-5 mx-auto">

            <li class="page-item <?php if ($page_no <= 1) {
                                    echo 'disabled';
                                  } ?> ">
              <a class="page-link" href="<?php if ($page_no <= 1) {
                                            echo '#';
                                          } else {
                                            echo "?page_no=" . ($page_no - 1);
                                          } ?>"><?php echo h('Previous'); ?></a>
            </li>


            <li class="page-item"><a class="page-link" href="?page_no=1"><?php echo h('1'); ?></a></li>
            <li class="page-item"><a class="page-link" href="?page_no=2"><?php echo h('2'); ?></a></li>

            <?php if ($page_no >= 3) { ?>
              <li class="page-item"><a class="page-link" href="#"><?php echo h('...'); ?></a></li>
              <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo h($page_no); ?></a></li>
            <?php } ?>



            <li class="page-item <?php if ($page_no >=  $total_no_of_pages) {
                                    echo 'disabled';
                                  } ?>">
              <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                            echo '#';
                                          } else {
                                            echo "?page_no=" . ($page_no + 1);
                                          } ?>"><?php echo h('Next'); ?></a>
            </li>
          </ul>
        </nav>

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