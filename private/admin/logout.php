<?php

session_start();
session_destroy();
header("Location: login.php");
exit;

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
  if (isset($_SESSION['admin_logged_in'])) {
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['email']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    header('location: login.php');
    exit;
  }
}
