<?php

include '../jenny_mart/_Layout/Layout_header.php';

?>


    <style>
input[type="number"]::-webkit-inner-spin-button {
  /* -webkit-appearance: none !important; */
  opacity: 1 !important;
  background: white !important;
  border-width: 0px;
  margin: 0;
  border-left: 1px solid #d8d8d8;
  height: 34px;
  width: 23px;
  cursor: pointer;
}

.cart_up_input{
    margin: 15% 0 5px 0;
    width: 100px;
    border-top: none;
    /* border-bottom: none; */
    border-left: none;
    border-right: none;
    text-align: center;
    border-width: thin;
    padding: 0px 6px 2px 0;
    /* border-radius: 50px; */
    height: 37px;
    border-color: gainsboro;
}
.cart_up_button{
    width: 100px;
    text-transform: uppercase;
    border: none;
    color: white;
    background: #ca1515;
    border-radius: 25px;
}



    </style>



    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

                                <tr>
                                    <td class="cart__product__item">
                                    <!-- <img src="data:image/jpeg;base64,<?php echo base64_encode($fetch_cart['image']); ?>" height="100" alt=""> -->
                                    <img src="<?php echo $fetch_cart['image']; ?>" height="100" alt="">
                                    <!-- <div class="product__item__pic set-bg" data-setbg="data:image/jpeg;base64,<?php echo base64_encode($fetch_cart['image']); ?>"> -->
                                        <div class="cart__product__item__title">
                                            <h6><?php echo $fetch_cart['name']; ?></h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">Rs <?php echo $fetch_cart['price']; ?>/-</td>
                                    <td class="cart__quantity">
                                        <form action="" method="post">
                                            <div class="">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1" class="cart_up_input"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" class="cart_up_button" name="update_update_btn">
                </div>
               </form>  
                                            <!-- <input type="text" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>"> -->
                                        <!-- <input type="submit" value="update" name="update_update_btn"> -->

                                    </td>
                                    <td class="cart__total">Rs <?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>/-</td>
                                    <td class="cart__close"><a href="shop-cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"><span class="icon_close"></span></a></td>
                                </tr>

         <?php
           number_format($grand_total += $sub_total);  
            };
         }else{
         ?>

<tr>
<?php
            echo "<td colspan='6'><div class='display-order'><span>your cart is empty!</span></div></td>";         

?>
</tr>

<?php
}
?>

                       </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                    <a href="index.php" class="option-btn">continue shopping</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                    <td><a href="shop-cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>"> <i class="fa fa-trash-o"></i> Delete All</a></td>

                    </div>
                </div>
            </div>
            <div class="row" style="justify-content: center;">
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>Rs<?php echo number_format($grand_total); ?>/-</span></li>
                            <li>Total <span>Rs<?php echo number_format($grand_total); ?>/-</span></li>
                        </ul>
                        <!-- <a href="#" class="primary-btn">Proceed to checkout</a> -->
                        <!-- <a href="webcheckout.php" class="primary-btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a> -->
                        <?php
if(!isset($_SESSION['id']) || $_SESSION['id'] === null){
?>
      <a href="login.php" style="display: block; font-size: 14px; text-transform: uppercase;  text-align: center; background: #ca1515; border-radius: 50px; padding: 12px 0px 10px; color: #ffffff;  " class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Login to Proceed</a>
<?php
}else{
?>
      <a href="webcheckout.php" style="display: block; font-size: 14px; text-transform: uppercase;  text-align: center; background: #ca1515; border-radius: 50px; padding: 12px 0px 10px; color: #ffffff;  " class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
<?php

}
?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->


    <?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>