<!-- order-details-dark.php -->
<?php
include '../_Layout/_navbar.php';

// Check if the order ID is provided in the URL
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Fetch order details from the database
    $sql = "SELECT * FROM `order` WHERE id = $orderId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
    } else {
        // Handle order not found error
        echo 'Order not found.';
        exit;
    }
        // Check if the button to change status is clicked
        if (isset($_POST['change_status'])) {
            // Update the status to '2' in the database
            $updateSql = "UPDATE `order` SET status = '2' WHERE id = $orderId";
            if (mysqli_query($conn, $updateSql)) {
                // Refresh the page to see the updated status
                header("Location: order-details-dark.php?id=$orderId");
                exit;
            } else {
                // Handle the update error
                echo 'Failed to update status.';
            }
        }
} else {
    // Handle missing order ID error
    echo 'Order ID is missing.';
    exit;
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Details</h4>
                        <div class="order-details-container">
                            <div class="order-info">
                                <h5>Order ID:</h5>
                                <p><?php echo $order['id']; ?></p>
                            </div>
                            <div class="order-info">
                                <h5>Customer Name:</h5>
                                <p><?php echo $order['fname'] . ' ' . $order['lname']; ?></p>
                            </div>
                            <div class="order-info">
                                <h5>Contact Number:</h5>
                                <p><?php echo $order['number']; ?></p>
                            </div>
                            <div class="order-info">
                                <h5>Shipping Address:</h5>
                                <p><?php echo $order['street'] . ', ' . $order['city'] . ', ' . $order['state'] . ', ' . $order['pin_code']; ?></p>
                            </div>
                            <div class="order-info">
                                <h5>Remarks:</h5>
                                <p><?php echo $order['remarks']; ?></p>
                            </div>
                            <div class="order-info">
                                <h5>Total Products:</h5>
                                <p><?php echo $order['total_product']; ?></p>
                            </div>
                            <div class="order-info">
                                <h5>Total Price:</h5>
                                <p>Rs <?php echo $order['total_price']; ?></p>
                            </div>
                            <div class="order-info">
                                <h5>Status:</h5>
                                <p><?php 
                                    if ($order['status'] == 2) {
                                        echo 'Order Placed';
                                
                                    } else {
                                        echo 'Not Placed';
                                
                                    }
                                
                                ?></p>
                                
                            </div>
                            <div class="order-info">
                            <h5>Change Status:</h5>

                                <form method="post">
                                    <button type="submit" name="change_status" class="btn btn-success">Changed Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Add your custom CSS styles for the dark-themed order details here */


    .order-details-container {
        border-radius: 10px;
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
    }

    .order-info {
        flex-basis: calc(33.33% - 20px);
        padding: 15px;
        background-color: #444;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    h5 {
        font-size: 16px;
        color: #fff;
    }

    p {
        font-size: 14px;
        color: #ccc;
    }
</style>

<?php include '../_Layout/_footer.php'; ?>
