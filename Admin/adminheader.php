
<link rel="stylesheet" href="css/lipadmin.css">
<?php session_start();
if(!isset($_SESSION['AdminLoginId'])){
    header("location: adminlogin.php");
}



?>

<?php

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: adminlogin.php");
}
?>

<style>

.logout_btn{
    background-color: transparent;
    text-transform: capitalize;
    font-size: 22px;
    display: flex;
    width: 112px;
    justify-content: space-between;
    align-items: center;
    color: red;
}


    /* Dropdown Button */
    .dropbtn {
    background-color: transparent;
    color: #111111;
    padding: 16px;
    font-size: 16px;
    border: none;
    font-weight: 500;
    text-transform: uppercase;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 225px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
/* .dropdown-content a:hover {background-color: #ddd;} */

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

.adheaddrop{
    display: block !important;
    padding: 10px;
}

</style>

<!-- <header class="header">

   <div class="flex">

    <a href="./index.php" class="logo"><img src="img/logo2.png" alt=""></a>
      <a href="#" class="logo">Jenny'sMart</a>
      <div class="header__logo" style="margin-right:12%">
                        <a href="./index.php"><img src="img/logo2.png" alt=""></a>
                    </div>
      <nav class="navbar">
         <a href="lipadmin.php">Lipstick products</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="shop-cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header> -->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>

<li>
<button name="logout" class="logout_btn" >Log Out</button>
</form> </li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.php"><img src="img/logo2.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">

        </div>
    </div>
    <!-- Offcanvas Menu End -->

<header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                        <li><a href="./orderadmin.php">Order Admin</a></li>
                        <div class="dropdown">
  <li class="dropbtn dropdown-toggle">Cosematics Products</li>
  <div class="dropdown-content">
    <li class="adheaddrop"><a href="./lipadmin.php">Lip Admin</a></li>
    <li class="adheaddrop"><a href="./brushadmin.php">Brush Admin</a></li>
    <li class="adheaddrop"><a href="./eyeshadowadmin.php">Eyeshadow Admin</a></li>
    <li class="adheaddrop"><a href="./nailpaintadmin.php">Nail Paint Admin</a></li>

</div>
</div>

<div class="dropdown">
  <li class="dropbtn dropdown-toggle">Jewellry Products</li>
  <div class="dropdown-content">
    <li class="adheaddrop"><a href="./earringadmin.php">Ear Ring Admin</a></li>
    <li class="adheaddrop"><a href="./necklaceadmin.php">Necklace Admin</a></li>
    <li class="adheaddrop"><a href="./bangleadmin.php">Bangle Admin</a></li>
    <li class="adheaddrop"><a href="./ringadmin.php">Ring Admin</a></li>

    
</div>
</div>

                            <li><a href="./contactadmin.php">Contact Admin</a></li>
                            <li><a href="./newsletteradmin.php">Newsletter Admin</a></li>





                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">

                        <ul class="header__right__widget">
                      <li>
                      <form action="" method="post">
    <button name="logout" class="logout_btn" >Log Out<i class="fas fa-sign-out"></i></button>
</form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>