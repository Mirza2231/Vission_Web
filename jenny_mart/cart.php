

<?php

include '../jenny_mart/_Layout/Layout_header.php';

if (isset($_GET['image_id'])) {
   $image_id = $_GET['image_id'];

   // Retrieve the image data from the database
   $query = mysqli_query($conn, "SELECT image FROM `cart` WHERE id = $image_id");
   $result = mysqli_fetch_assoc($query);

   if ($result && !empty($result['image'])) {
       // Set the content type header to indicate that it's an image
       header("Content-type: image/jpeg");

       // Output the image data
       echo $result['image'];
   } else {
       // If no image data found, you can display a placeholder image or an error message
       // For example, you can redirect to a default image or display an error message
       // header("Location: default_image.jpg"); // Redirect to a default image
       // echo "Image not found."; // Display an error message
   }
}

?>



<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <!-- <td><?php echo $fetch_cart['image']; ?></td> -->
            <td><img src="get_image.php?image_id=<?php echo $fetch_cart['id']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>Rs<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>Rs<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="shop-cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="index.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">grand total</td>
            <td>Rs<?php echo $grand_total; ?>/-</td>
            <td><a href="shop-cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
   
<?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>

