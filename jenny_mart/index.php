<?php

include '../jenny_mart/_Layout/Layout_header.php';

// Retrieve the last 4 products from the database
$select_products = mysqli_query($conn, "SELECT * FROM `products` ORDER BY id DESC LIMIT 4");



?>
    <!-- Categories Section Begin -->
    <!-- <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="categories__item categories__large__item set-bg"
                        data-setbg="./asset/img/content-pixie-be-6rpnQ30k-unsplash.jpg">
                        <div class="categories__text">
                            <h1>Gym Equipments </h1>
                            <p>An eyeshadow palette offers a spectrum of shades,<br> usually within the same color
                                group, or at least in <br>complementary shades.</p>
                            <a href="./product.php">Shop now</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> -->
        <!-- Banner Section Begin -->
        <section class="banner set-bg" data-setbg="./asset/img/categories/89.jpg" style="height: 660px;">
        <div class="container" style="height: 596px;">
            <div class="row" style="height: 596px;">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Fitness X</span>
                                <h1>The Best Acessories we have</h1>
                                <a href="product.php">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Fitness X</span>
                                <h1>GO Have Your Choice</h1>
                                <a href="product.php">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Fitness X</span>
                                <h1>The Best Machines We Have</h1>
                                <a href="product.php">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
    <div class="container">
    <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Latest Product</h4>
                    </div>
                </div>

            </div>
        <div class="row property__gallery">
            <?php
            while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                $discount = ($fetch_product['real_price'] - $fetch_product['price'] ) / $fetch_product['real_price'] *100;
                $discount_integer = (int) round($discount);
            ?>
 <form action="" method="post" style="display: contents;">
                                <div class="col-lg-3 col-md-3">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="data:image/jpeg;base64,<?php echo base64_encode($fetch_product['image']); ?>">
                                        <div class="label sale"><?php echo $discount_integer?>% off</div>
                                         <?php
                                            
                                            if ($fetch_product['status'] == 2) {
                                                
                                                echo '<div class="label avail">Out Of Stock</div>';
                                        
                                            } else {
                                                echo '';
                                        
                                            }
                                            ?> 
                                        

                                            <ul class="product__hover">
                                                <li><a href="data:image/jpeg;base64,<?php echo base64_encode($fetch_product['image']); ?>" class="image-popup"><span
                                                            class="arrow_expand"></span></a></li>

                                               
                                                <?php
                                            
                                            if ($fetch_product['status'] == 2) {
                                                
                                                echo '';
                                        
                                            } else {
                                                echo '
                                                <li>
                                                <button type="submit" class="cart_buton" value="add to cart" name="add_to_wishlist">
                                                    <span class="icon_heart_alt"></span>
                                                </button>
                                            </li>
                                                <li> <button type="submit" class="cart_buton" value="add to cart" name="add_to_cart">
                                                <span class="icon_bag_alt"></span>
                                            </button></li>';
                                        
                                            }
                                            ?> 
                                                 
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                            <input type="hidden" name="product_image" value="data:image/jpeg;base64,<?php echo base64_encode($fetch_product['image']); ?>">
                                            <h6><?php echo $fetch_product['name']; ?></h6>
                                            <div class="product__price">Rs<?php echo $fetch_product['price']; ?>/-</div>
                                        </div>
                                    </div>
                                </div>
                            </form>
            <?php
            }
            ?>
        </div>
    </div>
</section>
    <!-- Product Section End -->


    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="./asset/img/categories/45.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Fitness X</span>
                                <h1>The Best Acessories we have</h1>
                                <a href="product.php">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Fitness X</span>
                                <h1>GO Have Your Choice</h1>
                                <a href="product.php">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Fitness X</span>
                                <h1>The Best Machines We Have</h1>
                                <a href="product.php">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <br><br>


    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-car"></i>
                        <h6>Free Shipping</h6>
                        <p>For all oder over $99</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-money"></i>
                        <h6>Money Back Guarantee</h6>
                        <p>If good have Problems</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-support"></i>
                        <h6>Online Support 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-headphones"></i>
                        <h6>Payment Secure</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Instagram Begin -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="./asset/img/categories/22.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/">@ jenny_mart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="./asset/img/categories/25.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/">@ jenny_mart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="./asset/img/categories/26.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/">@ jenny_mart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="./asset/img/categories/27.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/">@ jenny_mart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="./asset/img/categories/28.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/">@ jenny_mart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="./asset/img/categories/29.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/">@ jenny_mart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Instagram End -->

<?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>