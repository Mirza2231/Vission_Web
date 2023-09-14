<?php
// Include the navigation bar
include '../_Layout/_navbar.php';

// Function to add a category
function addCategory($categoryName, $conn) {
    $categoryName = mysqli_real_escape_string($conn, $categoryName);
    $sql = "INSERT INTO category (Category_name) VALUES ('$categoryName')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Function to get all categories
function getCategories($conn) {
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}

// Function to update a category
function updateCategory($categoryId, $categoryName, $conn) {
    $categoryId = mysqli_real_escape_string($conn, $categoryId);
    $categoryName = mysqli_real_escape_string($conn, $categoryName);
    $sql = "UPDATE category SET Category_name='$categoryName' WHERE id=$categoryId";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a category
function deleteCategory($categoryId, $conn) {
    $categoryId = mysqli_real_escape_string($conn, $categoryId);
    $sql = "DELETE FROM `category` WHERE id=$categoryId";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}




// Get all categories
$categories = getCategories($conn);

// Handle adding a category
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    if (addCategory($category_name, $conn)) {
        // Category added successfully
        echo "<script>
        window.location.href = 'category.php'; // Redirect back to products.php
    </script>";
    } else {
        // Category addition failed
    }
}

// Handle deleting a category
if (isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];
    if (deleteCategory($category_id, $conn)) {
        // Category deleted successfully
        echo "<script>
        window.location.href = 'category.php'; // Redirect back to products.php
    </script>";
    } else {
        // Category deletion failed
    }
}
?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class='row'>
      <!-- Add Category Form -->
      <div class="col-md-6 col-xl-4 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">Add Category</h4>
                  <p class="card-description"> Enter a Category you want to Add </p>
                  <form method="post" action="" class="forms-sample">
                      <div class="form-group">
                          <label for="category_name">Category</label>
                          <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category">
                      </div>

                      <button type="submit" class="btn btn-primary me-2" name="add_category">Submit</button>
                  </form>
              </div>
          </div>
      </div>

      <!-- Display Categories -->
      <div class="col-md-6 col-xl-8 grid-margin stretch-card">
          <div class="card">
              <div class="card-body" style="
                  height: 390px;
                  overflow: auto;
                  overflow-x: hidden;
              ">
                  <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title">Added Categories</h4>
                  </div>
                  <div class="preview-list">
                      <?php foreach ($categories as $category) { ?>
                          <div class="preview-item border-bottom">
                              <div class="preview-item-content d-flex flex-grow">
                                  <div class="flex-grow">
                                      <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                          <h6 class="preview-subject text-capitalize"><?php echo $category['Category_name']; ?></h6>
                                      </div>
                                  </div>
                                  <div class="d-flex d-md-block d-xl-flex justify-content-between" style="
                                      width: 110px;
                                      align-items: center;
                                  ">
                                      <a href="edit_category.php?id=<?php echo $category['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                      <form method="post" action="">
                                          <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');" name="delete_category">Delete</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      <?php } ?>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Include the footer -->
<?php
include '../_Layout/_footer.php';
?>
