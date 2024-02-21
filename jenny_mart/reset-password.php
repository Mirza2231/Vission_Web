<?php
// session_start();

include '../jenny_mart/_Layout/Layout_header.php';

?>

<?php
// Initialize the session
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
// require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!-- 
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>  
     -->
    
<div class="container">
    <div class="wrapper">
        <div style="
        display:flex;
        align-items:center;
        flex-direction:column;
        margin-top:2%;">
            <h2>Reset Password</h2>
            <p>Please fill out this form to reset your password.</p>
        </div>


        <div class="contact__form">
            <!-- <h5>SEND MESSAGE</h5> -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="
                display:flex;
                align-items:center;
                flex-direction:column;
                " >
                <div class="input_div">
                    <!-- <input type="text" name="username" placeholder="Username"
                        class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $username; ?>">
                    <span class="invalid-feedback" style="font-size:100%">
                        <?php echo $username_err; ?>
                    </span> -->

                    <input type="password" name="new_password" placeholder="New Password" id="myInput" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>

                </div>
                <div class="input_div">
                    <!-- <input type="password" name="password" placeholder="Password"
                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback" style="font-size:100%">
                        <?php echo $password_err; ?>
                    </span> -->

                    <input type="password" name="confirm_password" placeholder="Confirm Password" id="myConfirmInput" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

                <div style="
                    
                    display: flex;
    align-items: center;
    margin-top: 12px;
    font-size: larger;
                    ">

                        <input type="checkbox" onclick="myFunction()" style="
                        height: auto;
    width: 25px;
    ">Show Password
                    </div>

                </div>
                <div style="
    display:flex;
">
                <button type="submit" class="site-btn" name="Submitt" style="margin-bottom:1%">Submit</button>
                <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                <a class="btn btn-link ml-2" href="index.php" style="
    border-radius: 50px;
    padding: 12px 30px;
    margin:0;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    background:#ca1515;
">Cancel</a>
                <!-- <p>Don't have an account? <a href="register.php">Sign up now</a>.</p> -->
                </div>

            </form>
        </div>
    </div>
</div>




    <?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>
