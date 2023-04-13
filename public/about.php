<?php
//session_start();
require_once('../private/initialize.php');
?>

<!-- The page title and the header file. -->
<?php
$page_title = 'About';
include(SHARED_PATH . '/header.php');
?>

<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Still have work to do!</h2>
    <hr class="mx-auto">
  </div>
</section>


<!-----Footer----->
<!-- footer file, with the closing tags and scripts. -->
<?php
include(SHARED_PATH . '/footer.php');
?>