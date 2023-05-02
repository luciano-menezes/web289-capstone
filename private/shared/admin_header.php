<?php
require_once('../initialize.php');
if (!isset($page_title)) {
  $page_title = 'My Crafty Mind Admin Area';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
  <title>My Crafty Mind - <?php echo h($page_title) ?></title>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link href="favicon.ico" rel="icon">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>


<body>
  <a href="#main-content" id="bypass">Skip to main content</a>

  <!-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-3 shadow"> -->
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-3 shadow" style="position: relative; z-index: 1;">

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 d-none d-md-block" href="index.php">My Crafty Mind</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" <?php if ($showSidebar) { ?> data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" <?php } ?> aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav ms-auto">
      <div class="nav-item text-nowrap">
        <?php if (isset($_SESSION['admin_logged_in'])) { ?>
          <a class="nav-link px-3" href="logout.php?logout=1">Sign out</a>
        <?php } ?>
      </div>
    </div>
  </header>