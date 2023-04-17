<?php
  //session_start();
  require_once('../private/initialize.php');
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit;
