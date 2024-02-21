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

function getCategoriesDropdown($conn) {
    $sql = "SELECT id, category_name FROM category";
    $result = mysqli_query($conn, $sql);
    $options = '<option value="">Select a Category</option>'; // Default option

    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['id'] . '">' . $row['category_name'] . '</option>';
    }

    return $options;
}


// Function to display products
function displayProducts($conn) {
    $sql = "SELECT p.*, c.category_name FROM products p
            INNER JOIN category c ON p.category_id = c.id";
    $result = mysqli_query($conn, $sql);
    $products = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}


if (isset($_POST['save_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = $_POST['product_price'];
    $real_price = $_POST['real_price'];
    $category_id = $_POST['category_id'];
    $product_status = isset($_POST['product_status']) ? $_POST['product_status'] : 1;

    // Handle file upload for product image
    if (isset($_FILES['product_image'])) {
        $image_data = file_get_contents($_FILES['product_image']['tmp_name']);
        $image_data = mysqli_real_escape_string($conn, $image_data);
    }

    // Insert new product
    $insert_sql = "INSERT INTO products (name, price, real_price, image, category_id, status) VALUES ('$product_name', $product_price, $real_price, '$image_data', $category_id, $product_status)";

    if (mysqli_query($conn, $insert_sql)) {
        // Product added successfully
        echo "<script>
            alert('Product added successfully.');
            window.location.href = 'products.php'; // Redirect back to products.php
        </script>";
        exit();
    } else {
        // Handle the error or show a message
        die("Error adding product: " . mysqli_error($conn));
    }
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

if (isset($_GET['delete'])) {
    // Handle product deletion here
    // Be sure to customize this part according to your database structure and logic
    $product_id = $_GET['delete']; // Change 'id' to 'delete'
    $sql = "DELETE FROM products WHERE id = $product_id";
    if (mysqli_query($conn, $sql)) {
        // Product deleted successfully
        echo "<script>
            alert('Product deleted successfully.');
            window.location.href = 'products.php'; // Redirect back to products.php
        </script>";
        exit();
    } else {
        // Handle the error or show a message
        die("Error deleting product: " . mysqli_error($conn));
    }
}
?>

<!-- Add/Edit Product Form -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row" style="justify-content:center;">
            <!-- Add/Edit Product Form -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manage Products</h4>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Price</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Price" required>
                            </div>
                            <div class="form-group">
                                <label for="real_price">Discount</label>
                                <input type="number" class="form-control" id="real_price" name="real_price" placeholder="Enter Discount Percentage" max="100" min="0" required>
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
                                    <input type="checkbox" class="form-check-input" name="product_status" value="2"> Not Available
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary me-2" name="save_product">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Display Products Table -->

            <div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body" style="
    height: 390px;
    overflow: auto;
    overflow-x: hidden;
">
            <h4 class="card-title">Products</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Discount </th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$products = displayProducts($conn);
foreach ($products as $product) {
    echo '<tr>';
    echo '<td>' . $product['name'] . '</td>';
    echo '<td>' . $product['price'] . '</td>';
    echo '<td>' . $product['real_price'] . '%</td>';
    echo '<td>' . $product['category_name'] . '</td>'; // Display category name
    echo '<td>';
    
    // Display "Available" or "Out of Stock" based on the status
    if ($product['status'] == 2) {
        echo 'Out of Stock';

    } else {
        echo 'Available';

    }

    echo '</td>';
    echo '<td>';
    
    if (!empty($product['image'])) {
        $imageData = base64_encode($product['image']);
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
        echo '<img src="' . $imageSrc . '" alt="Product Image" width="100">';
    } else {
        echo 'No Image';
    }
    
    echo '</td>';
    echo '<td>
          <a href="edit_product.php?edit=' . $product['id'] . '" class="btn btn-warning btn-sm">Edit</a>
          <a href="?delete=' . $product['id'] . '" onclick="return confirm(\'Are you sure you want to delete this?\');" class="btn btn-danger btn-sm">Delete</a>
      </td>';
    echo '</tr>';
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

<?php
include '../_Layout/_footer.php';

?>