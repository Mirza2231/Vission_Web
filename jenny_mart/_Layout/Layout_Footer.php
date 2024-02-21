<?php


if(isset($_POST['subscribe'])){

   $p_email = $_POST['email'];


   

   $insert_query = mysqli_query($conn, "INSERT INTO `newsletter`( email) VALUES( '$p_email')") or die('query failed');

   if($insert_query){
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

?>


<!-- Back to top button -->
<a id="button"></a>
<i class="arrow_carrot-2up"></i></button>
<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row"  style="
    justify-content: space-between;
">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="index.php"><img src="./asset/img/logo2.png" alt=""></a>
                    </div>
                    <p>Humorous material tends to be recalled at higher rates than non-humorous material.
                        It’s also been shown to break down people’s resistance to being influenced by
                        advertisements.</p>
                    <div class="footer__payment">
                        <a href=""><img src="img/payment/payment-1.png" alt=""></a>
                        <a href=""><img src="img/payment/payment-2.png" alt=""></a>
                        <a href=""><img src="img/payment/payment-3.png" alt=""></a>
                        <a href=""><img src="img/payment/payment-4.png" alt=""></a>
                        <a href=""><img src="img/payment/payment-5.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Quick Links</h6>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="product.php">Products</a></li>
                        <li><a href="shop-cart.php">Cart</a></li>
                        <li><a href="wishlist.php">Wishlist</a></li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#" method="post">
                        <input type="text" placeholder="Email" name="email" id="email" class="form-control " required>

                        <button type="submit" class="site-btn" name='subscribe' id="submit">Subscribe</button>
                     
                    </form>
                    <div class="footer__social">
                        <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.youtube.com/"><i class="fa fa-youtube-play"></i></a>
                        <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright © 2022 All rights reserved</p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->


<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="./asset/js/jquery-3.3.1.min.js"></script>
<script src="./asset/js/jquery.magnific-popup.min.js"></script>
<script src="./asset/js/jquery-ui.min.js"></script>
<script src="./asset/js/mixitup.min.js"></script>
<script src="./asset/js/jquery.countdown.min.js"></script>
<script src="./asset/js/jquery.slicknav.js"></script>
<script src="./asset/js/owl.carousel.min.js"></script>
<script src="./asset/js/jquery.nicescroll.min.js"></script>
<script src="./asset/js/main.js"></script>
<script src="./asset/js/bootstrap.min.js"></script>
<script src="./asset/js/cus.js"></script>
<script src="./asset/js/script.js" ></script>

</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/./asset/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</html>