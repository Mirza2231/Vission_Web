<?php
include '../jenny_mart/_Layout/Layout_header.php';

// Initialize the category filter
$category_filter = '';

// Check if the filter form has been submitted
if (isset($_POST['filter'])) {
    $selected_category = $_POST['category'];
    if ($selected_category !== 'all') {
        $category_filter = "WHERE category_id = $selected_category";
    }
}

// Retrieve products from the database with the applied category filter
$select_products = mysqli_query($conn, "SELECT * FROM `products` $category_filter");
?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<h4 style="text-align:center;">Our Products</h4>
<section class="shop spad">
    <div class="container">
                <!-- Category Filter Form -->
                <form method="post" action="" class="category-filter-form">
            <div class="category-filter" style="
display: flex;
    width: 562px;
    justify-content: space-between;
    align-items: center;
    font-size: medium;
">
                <label for="category">Filter by Category:</label>
                <select id="category" name="category">
                    <option value="all">All Categories</option>
                    <?php
                    // Retrieve categories from the database and populate the dropdown
                    $select_categories = mysqli_query($conn, "SELECT * FROM `category`");
                    while ($fetch_category = mysqli_fetch_assoc($select_categories)) {
                        echo '<option value="' . $fetch_category['id'] . '">' . $fetch_category['Category_name'] . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" class="site-btn" name="filter" style="
    width: 156px;
">Apply Filter</button>
            </div>
        </form>
        <!-- End Category Filter Form -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <?php
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                            $discount = $fetch_product['real_price'] ;
                            $discount_integer = (int) round($discount);
                    ?>

                            <form action="" method="post" style="display: contents;">
                                <div class="col-lg-3 col-md-3">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="data:image/jpeg;base64,<?php echo base64_encode($fetch_product['image']); ?>">
                                        <div class="label sale"><?php echo $discount_integer ?>% off </div>
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

                                                            <li>
                                                <button type="submit" class="cart_buton" value="add to cart" name="add_to_wishlist">
                                                    <span class="icon_heart_alt"></span>
                                                </button>
                                            </li>
                                                <?php
                                            
                                            if ($fetch_product['status'] == 2) {
                                                
                                                echo '';
                                        
                                            } else {
                                                echo '

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
                                            <input type="hidden" name="product_status" value="<?php echo $fetch_product['status']; ?>">

                                            <h6><?php echo $fetch_product['name']; ?></h6>
                                            <?php 
                                            $ss =($fetch_product['real_price'] / 100) * $fetch_product['price'];
                                            
                                            ?>
                                            <div class="product__price" style="font-size: medium;">Rs <?php echo $fetch_product['price'] - $ss ?>/-</div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                    <?php
                        }
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->



<?php
include '../jenny_mart/_Layout/Layout_Footer.php';
?>
