<!-- orders.php -->
<?php
include '../_Layout/_navbar.php';

// Fetch a summary of orders
$sql = "SELECT id, fname, lname, total_price, status FROM `order`";
$result = mysqli_query($conn, $sql);
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Summary</h4>
                        <p class="card-description">Click on an order to view details.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Actions</th> <!-- Add this column for the "Detail" button -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['fname'] . '</td>';
                                        echo '<td>' . $row['lname'] . '</td>';
                                        echo '<td>$' . $row['total_price'] . '</td>';
                                       
                                    if ($row['status'] == 2) {
                                        // echo 'Order Placed';
                                        echo '<td>Order Placed</td>';

                                
                                    } else {
                                        // echo 'Not Placed';
                                        echo '<td>Not Placed</td>';

                                
                                    }
                                
                              
                                        echo '<td><a href="order_details.php?id=' . $row['id'] . '" class="btn btn-info">Detail</a></td>'; // "Detail" button
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

<?php include '../_Layout/_footer.php'; ?>
