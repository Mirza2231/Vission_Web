<?php
ob_start();
// Theme section
session_name('theme_session');
session_start();
include '../Configuration/config.php';
include './Cart_function/function.php';
// Initialize $image_data with an empty string
$image_data = '';

// Check if the user is logged in
if (isset($_SESSION['id']) && $_SESSION['id'] !== null) {
    $user_id = $_SESSION['id'];
    
    // Retrieve user image extension from the database
    $query = "SELECT image FROM users WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        // Check if the query was successful
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $image_data);
            mysqli_stmt_fetch($stmt);
        
            // Verify image data
            if (!empty($image_data)) {
                $image_info = @getimagesizefromstring($image_data); // Use @ to suppress errors
                if ($image_info !== false) {
                    $image_extension = image_type_to_extension($image_info[2], false);
                } else {
                    // Handle image data error here (e.g., set a default image)
                    $image_extension = 'png'; // Set a default image extension
                    $image_data = ''; // Set a default image
                }
            } 
        }
        
        mysqli_stmt_close($stmt);
    }
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jenny's Mart</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./asset/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="./asset/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="./asset/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="./asset/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="./asset/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="./asset/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="./asset/css/cus.css" type="text/css">
    <!-- <link rel="stylesheet" href="./asset/css/style.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="./asset/css/addcart.css" type="text/css"> -->


    


</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <style>
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
        .dropdown:hover .dropdown-content {
            display: block;
        }


        .adheaddrop {
            display: block !important;
            padding: 10px;
        }
    </style>
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper active">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <?php
                            $select_rows = mysqli_query($conn, "SELECT * FROM `wishlist`") or die('query failed');
                            $wish_count = mysqli_num_rows($select_rows);
                            ?>
            <li><a href="./wishlist.php"><span class="icon_heart_alt"></span>
                <div class="tip"> <?php echo $wish_count; ?></div>
            </a></li>
            <?php
                            $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                            $row_count = mysqli_num_rows($select_rows);
                            ?>
            <li><a href="./shop-cart.php"><span class="icon_bag_alt"></span>
                <div class="tip"> <?php echo $row_count; ?></div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="index.php"><img src="./asset/img/logo2.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"><div class="slicknav_menu"><a href="#" aria-haspopup="true" role="button" tabindex="0" class="slicknav_btn slicknav_collapsed" style="outline: none;"><span class="slicknav_menutxt">MENU</span><span class="slicknav_icon"><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a><nav class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
                        <ul>
                            <!-- <li class=""><a href="./index.php">Home</a></li>
                            <li class=""><a href="./lipstick.php">Product</a></li>


                            <li><a href="./contact.php" role="menuitem">Contact</a></li> -->
                        </ul>
                    </nav></div></div>
                    <?php
if (!isset($_SESSION['id']) || $_SESSION['id'] === null) {
    ?>
    <div class="offcanvas__auth">
        <a href="./login.php">Login</a>
        <a href="./register.php">Register</a>
    </div>
<?php
} else {
    if (isset($image_data) && isset($image_extension)) {
        // If user image data is available, display it
        ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width:35px">
                <img src="data:image/<?php echo $image_extension; ?>;base64,<?php echo base64_encode($image_data); ?>" class="img-xs rounded-circle" alt="">
            </a>
            <ul class="dropdown-menu dropdown-menu1">
                <li><a href="reset-password.php">Reset Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    <?php
    } else {
        // If user image data is not available, display the first letter of their username
        $firstLetter = substr($_SESSION['username'], 0, 1);
        ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width:50px; display:flex; align-items:center">
                <div class="img-xs rounded-circle" style="background-color: #007BFF; color: #fff; text-align: center; line-height: 30px; width:31px"><?php echo $firstLetter; ?></div>
            </a>
            <ul class="dropdown-menu dropdown-menu1">
                <li><a href="reset-password.php">Reset Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    <?php
    }
}
?>


 <!-- <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a> -->


    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="./index.php"><img src="./asset/img/logo2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class=""><a href="./index.php">Home</a></li>
                            <li class=""><a href="./product.php">Product</a></li>
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                    <?php
if (!isset($_SESSION['id']) || $_SESSION['id'] === null) {
    ?>
    <div class="header__right__auth">
        <a href="./login.php">Login</a>
        <a href="./register.php">Register</a>
    </div>
<?php
} else {
    if (isset($image_data) && isset($image_extension)) {
        // If user image data is available, display it
        ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width:35px">
                <img src="data:image/<?php echo $image_extension; ?>;base64,<?php echo base64_encode($image_data); ?>" class="img-xs rounded-circle" alt="">
            </a>
            <ul class="dropdown-menu dropdown-menu1">
                <li><a href="reset-password.php">Reset Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    <?php
    } else {
        // If user image data is not available, display the first letter of their username
        $firstLetter = substr($_SESSION['username'], 0, 1);
        ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width:50px; display:flex; align-items:center">
                <div class="img-xs rounded-circle" style="background-color: black; color: #dbdadf; text-align: center; line-height: 30px; width:31px"><?php echo $firstLetter; ?></div>
            </a>
            <ul class="dropdown-menu dropdown-menu1">
                <li><a href="reset-password.php">Reset Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    <?php
    }
}
?>


                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                            <?php
                            $select_rows = mysqli_query($conn, "SELECT * FROM `wishlist`") or die('query failed');
                            $wish_count = mysqli_num_rows($select_rows);
                            ?>
                            <li><a href="./wishlist.php"><span class="icon_heart_alt"></span>
                                <div class="tip"><?php echo $wish_count; ?></div>
                            </a></li>
                            <?php
                            $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                            $row_count = mysqli_num_rows($select_rows);
                            ?>
                            <li><a href="./shop-cart.php"><span class="icon_bag_alt"></span>
                                <div class="tip"><?php echo $row_count; ?></div>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header> 
    <!-- Header Section End -->