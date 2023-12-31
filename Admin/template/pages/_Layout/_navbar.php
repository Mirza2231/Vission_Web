<?php
// Admin section
// session_name('admin_session');
session_start();
include('../../../../Configuration/config.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../Auth/login.php");
  exit;
}


// Full name of the user 
$fullName = $_SESSION["username"]; 
$shortName = ProfilePicFromName($fullName);
function ProfilePicFromName($fullName) {
      
     $fullNameArr = explode(" ", $fullName);
     $firstWord = current($fullNameArr);
     $lastWord  = end($fullNameArr);
     $firstCharacter = substr($firstWord, 0, 1);
    //  $lastCharacter = substr($lastWord, 0, 1);
     $defaultProfile = strtoupper($firstCharacter);
     return $defaultProfile;
    
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a style="       padding: 2.5rem 0rem 0rem 0.2rem;" class="sidebar-brand brand-logo" href="index.html"><img style="height:90%; width:90%;" src="../../assets/images/fitness-x-2.jpg" alt="logo" /></a>
          <a style="padding: 1rem 0rem 0rem 0.2rem;"class="sidebar-brand brand-logo-mini" href="index.html"><img style="
    width: 100%;
    height: 100%;
    padding-top: 20px;
    /* padding-bottom: -86px; */
" src="../../assets/images/fitness-x-s.jpg" alt="logo" /></a>
        </div>
        <ul class="nav" style="padding-top: 110px;">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <!-- <img class="img-xs rounded-circle " src="../../assets/images/faces/face15.jpg" alt=""> -->
                  <p class="img-xs rounded-circle " style="
    background: #dbdadf;
    color: #545353;
    line-height: 139px;
    display:flex;
    justify-content:center;
    align-items:center;  
    margin:0;  
    "><?php echo $shortName ?></p>
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal text-capitalize"><?php echo htmlspecialchars($_SESSION["username"]); ?></h5>
                  
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">

                <div class="dropdown-divider"></div>
                <a href="../Auth/reset-password.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../main_pages/index.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="../category/category.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Categories</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../product/products.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Products</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../contact/contact.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Contact</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../orders/orders.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Orders</span>
            </a>
          </li>

        </ul>
      </nav>

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" href="../product/products.php">+ Create New Product</a>

              </li>

              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                  <div class="navbar-profile">
                    <!-- <img class="img-xs rounded-circle" src="../../assets/images/faces/face15.jpg" alt=""> -->
                    <p class="img-xs rounded-circle " style="
    background: #dbdadf;
    color: #545353;
    line-height: 139px;
    display:flex;
    justify-content:center;
    align-items:center;  
    margin:0;  
    "><?php echo $shortName ?></p>
                    <p class="mb-0 d-none d-sm-block navbar-profile-name text-capitalize"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-divider"></div>
                  <a href="../Auth/logout.php" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">

                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                  <!-- <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">Advanced settings</p> -->
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
      
