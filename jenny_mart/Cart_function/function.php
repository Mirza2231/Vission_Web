<?php

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
 
    if(mysqli_num_rows($select_cart) > 0){
       $message[] = 'product already added to cart';
    }else{
       $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
       $message[] = 'product added to cart succesfully';
    }
 
 }

if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
    if($update_quantity_query){
       header('location:shop-cart.php');
    };
 };
 
 if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
    header('location:shop-cart.php');
 };

 if(isset($_GET['remove_wish'])){
   $remove_id = $_GET['remove_wish'];
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$remove_id'");
   header('location:wishlist.php');
};
 
 if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location:shop-cart.php');
 }

 if(isset($_GET['delete_all_wish'])){
   mysqli_query($conn, "DELETE FROM `wishlist`");
   header('location:wishlist.php');
}
 

 if(isset($_POST['add_to_wishlist'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_status = $_POST['product_status'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `wishlist`(name, price, image, status) VALUES('$product_name', '$product_price', '$product_image','$product_status')");
      $message[] = 'product added to cart succesfully';
   }

}

// if(isset($_POST['update_update_btn'])){
//    $update_value = $_POST['update_quantity'];
//    $update_id = $_POST['update_quantity_id'];
//    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
//    if($update_quantity_query){
//       header('location:shop-cart.php');
//    };
// };

// if(isset($_GET['remove'])){
//    $remove_id = $_GET['remove'];
//    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
//    header('location:shop-cart.php');
// };

// if(isset($_GET['delete_all'])){
//    mysqli_query($conn, "DELETE FROM `cart`");
//    header('location:shop-cart.php');
// }






?>