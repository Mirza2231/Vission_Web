<?php

include '../jenny_mart/_Layout/Layout_header.php';

?>
<?php
if(isset($_POST['Submitt'])){
   $p_name = $_POST['name'];
   $p_email = $_POST['email'];
   $p_message = $_POST['message'];

   

   $insert_query = mysqli_query($conn, "INSERT INTO `contact`(name, email, message) VALUES('$p_name', '$p_email', '$p_message')") or die('query failed');

   if($insert_query){
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
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
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Contact info</h5>
                            <ul>
                                <li>
                                    <h6><i class="fa fa-map-marker"></i> Address</h6>
                                    <p>160 Pennsylvania Ave NW, Washington, Castle, PA 16101-5161</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-phone"></i> Phone</h6>
                                    <p><span>125-711-811</span><span>125-668-886</span></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Support</h6>
                                    <p>Support.photography@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__form">
                            <h5>SEND MESSAGE</h5>
                            <form action="" method="post">
                                <input type="text" placeholder="Name" name ="name" style="margin-bottom:14px;" required>
                                <input type="text" placeholder="Email" name="email" style="margin-bottom:14px;" required>
                                <textarea placeholder="Message" name ="message" required></textarea>
                                <button type="submit" class="site-btn" name="Submitt" style="margin-bottom:14px;">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="contact__map">
                        <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48158.305462977965!2d-74.13283844036356!3d41.02757295168286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2e440473470d7%3A0xcaf503ca2ee57958!2sSaddle%20River%2C%20NJ%2007458%2C%20USA!5e0!3m2!1sen!2sbd!4v1575917275626!5m2!1sen!2sbd"
                        height="780" style="border:0" allowfullscreen="">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->




<?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>