<?php
require_once('../controller/start.inc.php');
if (isset($_SESSION['uniqueid']) && isset($_SESSION['token'])) {
  $access_account =

    '<li class="nav-item ">
        <a class="nav-link" href="./myaccount.php" >My Account</a>
    </li>';
  $access_button =
    '<li class="nav-item">
    <a href="#" class="btn btn-sm btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#modal-signout">Sign Out</a>
    </li>';
} else {
  $access_account = '';
  $access_button =
    '<li class="nav-item">
      <a href="#" class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modal-signin"><small>Sign In / Register</small></a>
    </li>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Econometrics and Data Analysis Resources for Beginners, Intermediate and Advanced Professionals">
  <meta name="keywords" content="Econometrics, Data Analysis, CrunchEconometrix, Econometrics Tutorials, Data Analysis Tutorials">
  <meta name="author" content="CrunchEconometrix, Ngozi Adeleye">
  <title>CrunchEconometrix</title>
  <link rel="shortcut icon" href="../assets/img/web/weblogo.png">
  <link rel="stylesheet" href="../assets/css/plugins.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/colors/aqua.css">
  <link rel="preload" href="../assets/css/fonts/dm.css" as="style" onload="this.rel='stylesheet'">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</head>

<body>
  <div class="page-loader"><small>CrunchEconometrix</small></div>
  <div class="content-wrapper">
    <header class="wrapper bg-light pt-1">