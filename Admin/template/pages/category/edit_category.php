<?php
include '../_Layout/_navbar.php';

// // Database configuration (update with your credentials)
// $db_host = 'your_db_host';
// $db_username = 'your_db_username';
// $db_password = 'your_db_password';
// $db_name = 'your_db_name';

// // Create a database connection
// $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// // Check if the connection was successful
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Function to get a category by ID
function getCategoryById($categoryId, $conn) {
    $categoryId = mysqli_real_escape_string($conn, $categoryId);
    $sql = "SELECT * FROM category WHERE id=$categoryId";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_category'])) {
        $categoryId = $_POST['category_id'];
        $categoryName = $_POST['category_name'];

        $sql = "UPDATE category SET Category_name='$categoryName' WHERE id=$categoryId";

        if (mysqli_query($conn, $sql)) {
            // echo 'success';
                        echo "<script>
            window.location = 'category.php';
        </script>";
        } else {
            echo 'error';
        }
        // if (updateCategory($categoryId, $categoryName, $conn)) {
        //     // Category updated successfully
        //     // header('Location: category.php'); // Redirect to the page where you display categories
        //     echo "<script>
        //     window.location = 'category.php';
        // </script>";
        //     exit();
        // }
    }
}

// Get category ID from the URL parameter
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $category = getCategoryById($categoryId, $conn);
    if (!$category) {
        // Category not found
        // header('Location: category.php'); // Redirect to the page where you display categories
        echo "<script>
        window.location = 'category.php';
    </script>";
        exit();
    }
} else {
    // ID parameter not provided
    // header('Location: category.php'); // Redirect to the page where you display categories
    echo "<script>
    window.location = 'category.php';
</script>";
    exit();
}
?>

<!-- Edit Category Form -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row" style="justify-content:center;">
            <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4>
                        <form method="post" action="">
                            <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                            <div class="form-group">
                                <label for="category_name">Category</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category" value="<?php echo $category['Category_name']; ?>">
                            </div>

                            <button type="submit" class="btn btn-primary me-2" name="update_category">Update</button>

                            <a href="./category.php" class="btn btn-dark me-2">Cancel</a>


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
