<?php
include "lookup.php";
?>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta description="CrunchEconometrix">
  <title>CrunchEconometrix -  Manager</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/bundles/jqvmap/dist/jqvmap.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../../assets/img/web/weblogo.png' />
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  
</head>


<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Account Activities</a>
                </div>
              </div>
              
              
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="../../assets/img/web/weblogo.png" 
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello Admin</div>
             
              <div class="dropdown-divider"></div>
              <a href="../../app/logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">  <span
                class="logo-name"><small>CrunchEconometrix</small></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="welcome.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link"><i data-feather="feather"></i><span>Admin Profile</span></a>
            </li>
            
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>Manage Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="userboard.php">Dashboard</a></li>
                <li><a class="nav-link" href="userview.php">Users Log</a></li>
                <li><a class="nav-link" href="activity.php">User Activity Log</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-bag"></i><span>Manage Products</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="productadd.php">Add Product </a></li>
                <li><a class="nav-link" href="productview.php">Product Shelf</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="layout"></i><span>Publications</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="publicationadd.php">Add Publication </a></li>
                <li><a class="nav-link" href="publicationview.php">My Publications</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="grid"></i><span>Manage Sales</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="pricing.php">Transaction Log</a></li>
                <li><a class="nav-link" href="report.php">Sales Coupon</a></li>
                <li><a class="nav-link" href="withdraw.php">Withrawal</a></li>
              </ul>
            </li>
            
         
            
          </ul>
        </aside>
      </div>