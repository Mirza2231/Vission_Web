<?php

include '../jenny_mart/_Layout/Layout_header.php';

?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Wishlist</span>
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
                                    <th>Add To Cart</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `wishlist`");
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_pro = mysqli_fetch_assoc($select_cart)){
         ?>

                                <tr>
                                    <td class="cart__product__item">
                                    <img src="<?php echo $fetch_pro['image']; ?>" height="100" alt="">
                                    <!-- <img src="<?php echo $fetch_cart['image']; ?>" height="100" alt=""> -->

                                        <div class="cart__product__item__title">
                                            <h6><?php echo $fetch_pro['name']; ?></h6>
                                            <h6><?= ($fetch_pro['status'] == 2 ?'(Out of Stock)': '' )?></h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">Rs <?php echo $fetch_pro['price']; ?>/-</td>

                                    <!-- <td class="cart__total">Rs<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>/-</td> -->
                                    <form action="" method="post">
                                    <td>
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_pro['name']; ?>">
                                 <input type="hidden" name="product_price" value="<?php echo $fetch_pro['price']; ?>">
                                 <input type="hidden" name="product_image" value="<?php echo $fetch_pro['image']; ?>">
                                 <input type="hidden" name="product_status" value="<?php echo $fetch_pro['status']; ?>">
                                 
                                 
                                 <button type="submit" class="site-btn" value="add to cart" name="add_to_cart" <?= ($fetch_pro['status'] == 2) ? 'style="opacity:.65;" disabled' : ''; ?>>
                                 <span>Add to cart</span>
</button>
    
    
                                            </td>
                                <td class="cart__close"><a href="wishlist.php?remove_wish=<?php echo $fetch_pro['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"><span class="icon_close"></span></a></td>

                                            


                                            </form>
                                </tr>

         <?php

            };
         }else{
         ?>

               <tr>
               <?php
                           echo "<td colspan='6'><div class='display-order'><span>your wishlist is empty!</span></div></td>";         
               
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
                        <a href="index.php" class="option-btn" >continue shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn update__btn">
                        <td><a href="shop-cart.php?delete_all_wish" onclick="return confirm('are you sure you want to delete all?');" class="btn <?= (mysqli_num_rows($select_cart) > 0)?'':'disabled'; ?>"> <i  class="fa fa-trash-o"></i> Delete All</a></td>
    
                        </div>
                    </div>
                </div>
</div>

</div>


<?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>