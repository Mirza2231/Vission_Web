<?php
include '../_Layout/_navbar.php';

// Include your database connection code here
// $db_host = 'your_db_host';
// $db_username = 'your_db_username';
// $db_password = 'your_db_password';
// $db_name = 'your_db_name';

// $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Function to get categories for the dropdown
// function getCategoriesDropdown($conn) {
//     $sql = "SELECT id, category_name FROM category";
//     $result = mysqli_query($conn, $sql);
//     $options = '';
//     while ($row = mysqli_fetch_assoc($result)) {
//         $options .= '<option value="' . $row['id'] . '">' . $row['category_name'] . '</option>';
//     }
//     return $options;
// }

function getCategoriesDropdown($conn) {
    $sql = "SELECT id, category_name FROM category";
    $result = mysqli_query($conn, $sql);
    $options = '<option value="">Select a Category</option>'; // Default option

    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['id'] . '">' . $row['category_name'] . '</option>';
    }

    return $options;
}


if (isset($_GET['edit'])) {
    // Handle editing of a specific product here
    // Fetch the product data for editing and populate the form
    // Be sure to customize this part according to your database structure and logic
    $edit_product_id = $_GET['edit'];
    $edit_sql = "SELECT * FROM products WHERE id = $edit_product_id";
    $edit_result = mysqli_query($conn, $edit_sql);
    if ($edit_result && mysqli_num_rows($edit_result) > 0) {
        $product = mysqli_fetch_assoc($edit_result);
    }
}

if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = $_POST['product_price'];
    $real_price = $_POST['real_price'];
    $category_id = $_POST['category_id'];
    $product_status = isset($_POST['product_status']) ? $_POST['product_status'] : 0;

    // Handle file upload for product image
    if (isset($_FILES['product_image'])) {
        $image_data = file_get_contents($_FILES['product_image']['tmp_name']);
        $image_data = mysqli_real_escape_string($conn, $image_data);
    }

    // Update existing product
    $update_sql = "UPDATE products SET name = '$product_name', price = $product_price, real_price = $real_price, image = '$image_data', category_id = $category_id, status = $product_status WHERE id = $product_id";

    if (mysqli_query($conn, $update_sql)) {
        // Product updated successfully
        echo "<script>
            alert('Product updated successfully.');
            window.location.href = 'products.php'; // Redirect back to products.php
        </script>";
        exit();
    } else {
        // Handle the error or show a message
        die("Error updating product: " . mysqli_error($conn));
    }
}
?>

<!-- Edit Product Form -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row" style="justify-content:center;">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Product</h4>
                        <form method="post" action="" enctype="multipart/form-data">
                            <!-- Use the hidden field to store the product ID for updates -->
                            <input type="hidden" name="product_id" value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo isset($product['name']) ? $product['name'] : ''; ?>" placeholder="Product Name" required>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Price</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>" placeholder="Price" required>
                            </div>
                            <div class="form-group">
                                <label for="real_price">Discount</label>
                                <input type="number" class="form-control" id="real_price" name="real_price" value="<?php echo isset($product['real_price']) ? $product['real_price'] : ''; ?>" min="0" max="100" placeholder="Enter Discount Percentage" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <?php echo getCategoriesDropdown($conn); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_image"  style="
    display: block;
    margin-bottom: 10px;
">Product Image</label>
                                <input type="file" class="form-control-file" id="product_image" name="product_image" accept="image/*" required>
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="product_status" value="2" <?php if (isset($product['status']) && $product['status'] == 2) echo 'checked'; ?>> Not Available
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary me-2" name="update_product">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../_Layout/_footer.php';
?>
