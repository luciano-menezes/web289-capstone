<?php
//session_start();
require_once('../private/initialize.php');
?>

<!-- The page title and the header file. -->
<?php
$page_title = 'Contact Us';
include(SHARED_PATH . '/header.php');
?>

<section id="contact" class="container my-5 py-5">
  <div class="container text-center mt-5">
    <h3>Contact us</h3>
    <hr class="mx-auto">
    <p class="w-50 mx-auto">
      Phone number: <span>123 456 789</span>
    </p>
    <p class="w-50 mx-auto">
      Email address: <span>info@email.com</span>
    </p>
  </div>
</section>


<!-----Footer----->
<!-- footer file, with the closing tags and scripts. -->
<?php
include(SHARED_PATH . '/footer.php');
?>