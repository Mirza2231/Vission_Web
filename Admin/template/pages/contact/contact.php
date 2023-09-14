<?php
include '../_Layout/_navbar.php';

// Fetch contact details from the 'contact' table
$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);

// Check if the form is submitted to change the status
if (isset($_POST['change_status'])) {
    $contactId = $_POST['contact_id'];

    // Update the status to 2 in the database
    $updateSql = "UPDATE contact SET status = 2 WHERE id = $contactId";

    if (mysqli_query($conn, $updateSql)) {
        echo "Status updated successfully.";
        echo "<script>
        window.location = 'contact.php';
    </script>";
        // You can add a redirect or other actions here as needed.
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Contact Details</h4>
                        <p class="card-description">Basic Table</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Email Actions</th>
                                        <!-- <th>Status</th> -->
                                        <th>Change Status</th> <!-- Add this column -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $row['name'] . '</td>';
                                        echo '<td>' . $row['email'] . '</td>';
                                        echo '<td>' . $row['message'] . '</td>';
                                        echo '<td>';

                                        // Check the status and display the button accordingly
                                        if ($row['status'] == 2) {
                                            // Status is 2, button is disabled
                                            echo '<button class="btn btn-primary" disabled>Already Sent</button>';
                                        } else {
                                            // Status is not 2, create a mailto link
                                            $mailtoLink = 'mailto:' . $row['email'] . '?subject=Regarding Your Inquiry&body=Dear ' . $row['name'] . ',%0A%0A';
                                            $mailtoLink = htmlspecialchars($mailtoLink);
                                            // Display the mailto link as a button
                                            echo '<a href="' . $mailtoLink . '" class="btn btn-primary">Send Email</a>';
                                        }

                                        echo '</td>';


                                        // Add the status change form
                                        echo '<td>';
                                        echo '<form method="post">';
                                        echo '<input type="hidden" name="contact_id" value="' . $row['id'] . '">';
                                        echo '<button type="submit" name="change_status" class="btn btn-warning">Change Status</button>';
                                        echo '</form>';
                                        echo '</td>';

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
