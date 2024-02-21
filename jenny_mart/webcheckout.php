<?php
include '../jenny_mart/_Layout/Layout_header.php';
?>

<?php

$fname= $lname = $number= $method= $street= $city= $state= $pin_code= "";

if (isset($_POST['order_btn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $method = $_POST['method'];
    $street = $_POST['street'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pin_code = $_POST['pin_code'];
    $remarks = $_POST['remarks'];
    $user_id = $_SESSION['id'];
    $email = $_SESSION['email'];

    // Phone number validation using regex
    $fname_pattern = "/^(?=.*[a-zA-Z].{2,})[a-zA-Z-' ]+$/";
    if (empty(trim($fname))){
        $fname_error = "Please First name";

    }elseif (!preg_match($fname_pattern, $fname)) {
        $fname_error = "Please enter a valid name with only Alphatbets.";
    }

    $lname_pattern = "/^(?=.*[a-zA-Z].{2,})[a-zA-Z-' ]+$/";
    if (empty(trim($lname))){
        $lname_error = "Please Enter Last name";

    }elseif (!preg_match($lname_pattern, $lname)) {
        $lname_error = "Please enter a valid name with only Alphatbets.";
    }
    
    $phone_pattern = "/^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/";
    if (empty(trim($number))){
        $phone_error = "Please Enter Number";

    }elseif (!preg_match($phone_pattern, $number)) {
        $phone_error = "Please enter a valid moblie no without space.";
    }

    $street_pattern = "/^[A-Za-z0-9\s\,\.\-'#&]+$/";
    if (empty(trim($street))){
        $street_error = "Please Enter Address";

    }elseif (!preg_match($street_pattern, $street)) {
        $street_error = "Please enter a valid Address.";
    }


    $state_pattern = "/^[A-Za-z\s]+$/";
    
    if (empty(trim($state))){
        $state_error = "Please Enter Address";

    }elseif (!preg_match($state_pattern, $state)) {
        $state_error = "Please enter a valid Country Name.";
    }
    $city_pattern = "/^[A-Za-z\s]+$/";
    
    if (empty(trim($city))){
        $city_error = "Please Enter City";

    }elseif (!preg_match($city_pattern, $city)) {
        $city_error = "Please enter a valid city.";
    }

    $pin_pattern = "/^\d{6}$/";
    
    if (empty(trim($pin_code))){
        $pin_error = "Please Enter City";

    }elseif (!preg_match($pin_pattern, $pin_code)) {
        $pin_error = "Please enter a 6 number pin code.";
    }


    if (empty($pin_error) && empty($city_error) && empty($state_error) && empty($street_error) && empty($phone_error) && empty($lname_error) && empty($fname_error)) {


        $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
        $price_total = 0;
        if (mysqli_num_rows($cart_query) > 0) {
            while ($product_item = mysqli_fetch_assoc($cart_query)) {
                $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
                $product_price = $product_item['price'] * $product_item['quantity'];
                $price_total += $product_price;
            };
        }
    
        $total_product = implode(', ', $product_name);
        $detail_query = mysqli_query($conn, "INSERT INTO `order`(fname,lname, number, method,street, state, city, pin_code,remarks, total_product, total_price,user_id) VALUES('$fname','$lname','$number','$method','$street','$state','$city','$pin_code','$remarks','$total_product','$price_total','$user_id')") or die('query failed');
        $delete_query = mysqli_query($conn, "DELETE FROM `cart`") or die('query failed');
    
        if ($cart_query && $detail_query) {
            // Display order confirmation message here
            echo "
            <div class='order-message-container'>
    <div class='message-container' style='height: 100%;'>

        <div class='row'>
            <div class='col-md-12'>
                <div class='text-center lh-1 mb-2'>
                    <img src='./asset/img/logo2.png' alt=''>
                    <img src='./asset/img/success.png' alt='' style='width: 12%;'>
                    <span class='fw-normal'>Order Successfully Done</span>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <div> <span class='fw-bolder'>Customer ID: </span> <small class='ms-3'>$user_id</small> </div>
                    </div>
                    <div class='col-md-6'>
                        <div> <span class='fw-bolder'>Customer Name: </span> <small class='ms-3 text-capitalize'>$fname $lname</small> </div>
                    </div>
                    <div class='col-md-6'>
                        <div> <span class='fw-bolder'>Customer Email: </span> <small class='ms-3'>$email</small> </div>
                    </div>
                    <div class='col-md-6'>
                        <div> <span class='fw-bolder'>Customer Number: </span> <small class='ms-3'>$number</small> </div>
                    </div>
                </div>
            </div>
            <div class='col-md-10 mx-auto'>
                <table class='mt-4 table table-bordered'>
                    <thead class='bg-dark text-white'>
                        <th colspan='2'>Address</th>
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
                <div class='order_button text-center'>
                    <a href='./index.php' class='btn btn-primary mt-3' id='continueButton'>Continue To Shopping</a>
                    <a href='./index.php' onclick='printSlip()' id='printButton' class='btn btn-danger mt-3'>Print Slip</a>
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
                                <input type="text" placeholder="enter your name" name="fname" value="<?php echo $fname; ?>" >
                                <?php
                                    if(isset($fname_error)){
                                        echo "<p class='text-danger' style='font-size:small; margin-top: -26px;'>$fname_error</p>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Last Name <span>*</span></p>
                                <input type="text" placeholder="enter your name" name="lname" value="<?php echo $lname; ?>" >
                                <?php
                                    if(isset($lname_error)){
                                        echo "<p class='text-danger' style='font-size:small; margin-top: -26px;'>$lname_error</p>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" placeholder="e.g. street name" name="street" value="<?php echo $street; ?>">
                                <?php
                                    if(isset($street_error)){
                                        echo "<p class='text-danger' style='font-size:small; margin-top: -26px;'>$street_error</p>";
                                    }
                                ?>
                            </div>
                            <div class="checkout__form__input">
                                <p>Town/City <span>*</span></p>
                                <input type="text" placeholder="e.g. mumbai" name="city" value="<?php echo $city; ?>">
                                <?php
                                    if(isset($city_error)){
                                        echo "<p class='text-danger' style='font-size:small; margin-top: -26px;'>$city_error</p>";
                                    }
                                ?>
                            </div>
                            <div class="checkout__form__input">
                                <p>Country/State <span>*</span></p>
                                <input type="text" placeholder="e.g. maharashtra" name="state" value="<?php echo $state; ?>">
                                <?php
                                    if(isset($state_error)){
                                        echo "<p class='text-danger' style='font-size:small; margin-top: -26px;'>$state_error</p>";
                                    }
                                ?>
                            </div>
                            <div class="checkout__form__input">
                                <p>Postcode/Zip <span>*</span></p>
                                <input type="text" placeholder="e.g. 123456" name="pin_code" value="<?php echo $pin_code; ?>">
                                <?php
                                    if(isset($pin_error)){
                                        echo "<p class='text-danger' style='font-size:small; margin-top: -26px;'>$pin_error</p>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Phone <span>*</span></p>
                                <input type="text" placeholder="enter your number" name="number" value="<?php echo $number; ?>">
                                <?php
                                    if(isset($phone_error)){
                                        // echo "<span class='invalid-feedback' style='font-size:100%'>$phone_error</span>";
                                        echo "<p class='text-danger' style='font-size:small; margin-top: -26px;'>$phone_error</p>";

                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Remarks/Feedback <span>*</span></p>
                                <textarea name="remarks" rows="7" placeholder="e.g. Remarks" cols="81" style='

    border: 1px solid rgb(225, 225, 225);
    border-radius: 2px;
    margin-bottom: 25px;
    font-size: 14px;
    padding: 10px;
    color: rgb(102, 102, 102);
                                '></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12" style="display:none;">
                            <!-- Your other fields here -->
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
                                   if (mysqli_num_rows($select_cart) > 0) {
                                      while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                                          $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
                                          $grand_total = $total += $total_price;
                                ?>
                                <li><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>) <span><?= number_format($fetch_cart['price'] * $fetch_cart['quantity'])?></span></li>
                                <?php
                                     }
                                  } else {
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
                        </div>
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

<script>

function printSlip() {
    // Disable other buttons to prevent them from being clicked during printing
    document.getElementById('continueButton').style.display = 'none';
    document.getElementById('printButton').style.display = 'none';
    
    // Perform the printing action
    window.print();
    
    // Re-enable other buttons after printing is complete
    setTimeout(function() {
        document.getElementById('continueButton').style.display = 'block';
        document.getElementById('printButton').style.display = 'block';
    }, 1000); // You can adjust the delay as needed
}

</script>


<?php
include '../jenny_mart/_Layout/Layout_Footer.php';
?>
