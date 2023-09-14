<?php

include '../jenny_mart/_Layout/Layout_header.php';

?>
<?php



if(isset($_POST['order_btn'])){

   $fname = $_POST['fname'];
   $lname= $_POST['lname'];
   $number = $_POST['number'];
   $method = $_POST['method'];
   $street = $_POST['street'];
   $state = $_POST['state'];

   $city = $_POST['city'];
   $pin_code = $_POST['pin_code'];
   $remarks = $_POST['remarks'];
   $user_id = $_SESSION['id'] ;
   $email = $_SESSION['email'] ;


   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = $product_item['price'] * $product_item['quantity'];
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(fname,lname, number, method,street, state, city, pin_code,remarks, total_product, total_price,user_id) VALUES('$fname','$lname','$number','$method','$street','$state','$city','$pin_code','$remarks','$total_product','$price_total','$user_id')") or die('query failed');
   $delete_query = mysqli_query($conn, "DELETE FROM `cart`") or die('query failed');



//    if($cart_query && $detail_query){
//       echo "
//       <div class='order-message-container'>
//       <div class='message-container'>
//          <h3>thank you for shopping!</h3>
//          <div class='order-detail'>
//             <span>".$total_product."</span>
//             <span class='total'> total : $".$price_total."/-  </span>
//          </div>
//          <div class='customer-details'>
//             <p> your name : <span>".$fname."</span> </p>
//             <p> your name : <span>".$lname."</span> </p>
//             <p> your number : <span>".$number."</span> </p>
//             <p> your email : <span>".$email."</span> </p>
//             <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
//             <p> your payment mode : <span>".$method."</span> </p>
//             <p>(*pay when product arrives*)</p>
//          </div>
//             <a href='index.php' class='btn'>continue shopping</a>
//          </div>
//       </div>
//       ";
//    }


if ($cart_query && $detail_query) {
    // Display order confirmation message here
    echo "
    <div class='order-message-container'>
    <div class='message-container'style='
    height: 100%;
'>

    <div class='row' style='
    height: 100%;
'>
    <div class='col-md-12'>
        <div class='text-center lh-1 mb-2' style='display:flex;justify-content:center;align-items:center;flex-direction:column;'>
        <img src='./asset/img/logo2.png' alt='' >
        <img src='./asset/img/sucess.png' alt='' style='
        width: 12%;

    '>

        
             <span class='fw-normal'>Order Sucessfully Done</span>
        </div>
        <div class='row' style='    height: 70%;
        justify-content: center;
        align-items: center;'>
            <div class='col-md-10'>
                <div class='row'>
                    <div class='col-md-6'>
                        <div> <span class='fw-bolder'>Customer ID: </span> <small class='ms-3'>$user_id</small> </div>
                    </div>
                    <div class='col-md-6'>
                        <div> <span class='fw-bolder'>Customer Name: </span> <small class='ms-3 text-capitalize'>".$fname ." ".$lname."</small> </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <div> <span class='fw-bolder'>Customer Email: </span> <small class='ms-3'>$email</small> </div>
                    </div>
                    <div class='col-md-6'>
                    <div> <span class='fw-bolder'>Customer Number: </span> <small class='ms-3'>$number</small> </div>
                </div>
                </div>
               
            </div>
            

            <table class='mt-4 table table-bordered'>
            <thead class='bg-dark text-white'>
            <th colspan='2' >Address</th>
            </thead>
            <tbody>
            <tr>
            <th scope='row'>State</th>
            <td>$state</td>
        </tr>
                <tr>
                    <th scope='row'>Street</th>
                    <td>$street</td>
                </tr>

                <tr>
                <th scope='row'>City</th>
                <td>$city</td>
            </tr>

            <tr>
            <th scope='row'>Postal Code</th>
            <td>$pin_code</td>
        </tr>

            </tbody>
        </table>

            <table class='mt-2 table table-bordered'>
            <thead class='bg-dark text-white'>
                <tr>
                    <th scope='col'>Items</th>
                    <th scope='col'>Price</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope='row'>$total_product</th>
                    <td>$price_total</td>
                </tr>


            </tbody>
        </table>



        <div class='order_button'>
<a href='./index.php' style='        
text-align: center;
background-color: var(--blue);
color:var(--white);
font-size: 1.7rem;
padding: 6px 1rem;
border-radius: .5rem;
cursor: pointer;' >Continue To Shopping</a>
<a href='./index.php' onclick='window.print()' style='        text-align: center;
background-color: var(--red);
color:var(--white);
font-size: 1.7rem;
padding: 6px 1rem;
border-radius: .5rem;
cursor: pointer;'>Print Slip</a>

</div>


        </div>






    </div>
</div>
       </div>

</div>
    ";
} else {
    echo "Error: " . mysqli_error($conn);
}


}

?>



    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <form action="" method="post" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>First Name <span>*</span></p>
                                    <!-- <input type="text"> -->
                                    <input type="text" placeholder="enter your name" name="fname" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Last Name <span>*</span></p>
                                    <!-- <input type="text"> -->
                                    <input type="text" placeholder="enter your name" name="lname" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                               
                                <div class="checkout__form__input">
                                    <p>Address <span>*</span></p>
                                    <!-- <input type="text" placeholder="Street Address"> -->
                                    <input type="text" placeholder="e.g. street name" name="street" required>
                                </div>
                                <div class="checkout__form__input">
                                    <p>Town/City <span>*</span></p>
                                    <!-- <input type="text"> -->
                                    <input type="text" placeholder="e.g. mumbai" name="city" required>
                                </div>
                                <div class="checkout__form__input">
                                    <p>Country/State <span>*</span></p>
                                    <!-- <input type="text"> -->
                                    <input type="text" placeholder="e.g. maharashtra" name="state" required>
                                </div>
                                <div class="checkout__form__input">
                                    <p>Postcode/Zip <span>*</span></p>
                                    <!-- <input type="text"> -->
                                    <input type="text" placeholder="e.g. 123456" name="pin_code" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Phone <span>*</span></p>
                                    <!-- <input type="text"> -->
                                    <input type="number" placeholder="enter your number" name="number" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                            <div class="checkout__form__input">
                                    <p>Remarks/Feedback <span>*</span></p>
                                    <!-- <input type="text"> -->
                                    <!-- <input type="text" placeholder="e.g. Remarks" rows="7" name="remarks" required> -->
                                    <textarea name="remarks" rows="7" placeholder="e.g. Remarks" cols="81"></textarea>

                                    <!-- <textarea id="w3review" name="remarks" rows="7"> -->
                                </div>
</div>
                            <div class="col-lg-12" style="display:none;">
                                <div class="checkout__form__checkbox">
                                    <label for="acc">
                                        Create an acount?
                                        <input type="checkbox" id="acc">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>Create am acount by entering the information below. If you are a returing
                                        customer login at the <br />top of the page</p>
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Account Password <span>*</span></p>
                                        <input type="text">
                                    </div>
                                    <div class="checkout__form__checkbox">
                                        <label for="note">
                                            Note about your order, e.g, special noe for delivery
                                            <input type="checkbox" id="note">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Oder notes <span>*</span></p>
                                        <input type="text"
                                        placeholder="Note about your order, e.g, special noe for delivery">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Your order</h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>
                                            <span class="top__text">Product</span>
                                            <span class="top__text__right">Total</span>
                                        </li>
                                        <?php
                                           $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                                           $total = 0;
                                           $grand_total = 0;
                                           if(mysqli_num_rows($select_cart) > 0){
                                              while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                                              $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
                                              $grand_total = $total += $total_price;
                                        ?>
                                        <!-- <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span> -->

                                        <!-- <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span> -->

                                        <li><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>) <span><?= number_format($fetch_cart['price'] * $fetch_cart['quantity'])?></span></li>

                                        <?php
                                             }
                                          }else{
                                             echo "<div class='display-order'><span>your cart is empty!</span></div>";
                                          }
                                          ?>
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                        <li>Subtotal <span>Rs<?= $grand_total; ?>/- </span></li>
                                        <li>Total <span>Rs<?= $grand_total; ?>/- </span></li>
                                    </ul>
                                </div>
                                <div class="checkout__order__widget">
                                    <label for="check-payment" style="display:flex; flex-direction:column; padding-left:0;">
                                        Cheque payment
                                        <select name="method" style="height: 43px; border-radius: 6px; font-size: 14px; font-weight: 500; color: #111111; text-transform:uppercase;">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">credit cart</option>
               <option value="paypal">paypal</option>
            </select>
                                    </label>
                                    <!-- <label for="paypal">
                                        PayPal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label> -->
                                </div>
                                <!-- <button type="submit" class="site-btn">Place oder</button> -->

                                <?php
if(!isset($_SESSION['id']) || $_SESSION['id'] === null){
?>
    <a href="login.php" style="display: block; font-size: 14px; text-transform: uppercase;  text-align: center; background: #ca1515; border-radius: 50px; padding: 12px 0px 10px; color: #ffffff;  " class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Login to Proceed</a>
<?php
}else{
?>
<button type="submit" class="site-btn" name="order_btn">Place order</button>
<?php

}
?>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Checkout Section End -->



        <?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>