<?php
// Include config file
// include '../Configuration/config.php';
include '../jenny_mart/_Layout/Layout_header.php';


 
// Define variables and initialize with empty values
$username = $image = $password = $confirm_password = $email = "";
$username_err = $image_err  = $password_err = $email_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if (!empty($_FILES["userImage"]["tmp_name"])) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_info = pathinfo($_FILES["userImage"]["name"]);
        if (in_array(strtolower($file_info['extension']), $allowed_types)) {
            $image = file_get_contents($_FILES["userImage"]["tmp_name"]);
        } else {
            $image_err = "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }



     // Validate emai;
     if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } elseif(!preg_match('/^\S+@\S+\.\S+$/', trim($_POST["email"]))){
        $email_err = "Enter correct Email format ";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($image_err)) {
        $sql = "INSERT INTO users (image,username, email, password) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "bsss", $param_image, $param_username, $param_email, $param_password);
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hashed password
            // $param_image = $image;
            mysqli_stmt_send_long_data($stmt, 0, $image);
            
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php"); // Redirect to login page
            } else {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

    <!-- <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
        
    </div>     -->

    <div class="container">
    <div class="wrapper">
        <div style="
        display:flex;
        align-items:center;
        flex-direction:column;
        margin-top:2%;">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
        </div>


        <div class="contact__form">
            <!-- <h5>SEND MESSAGE</h5> -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" style="
                display:flex;
                align-items:center;
                flex-direction:column;
                ">
                <div class="input_div">
                <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <!-- <span class="invalid-feedback"><?php echo $username_err; ?></span> -->
                    <span class="invalid-feedback" style="font-size:100%">
                        <?php echo $username_err; ?>
                    </span>
                </div>
                <div class="input_div">
                <input type="text" name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <!-- <span class="invalid-feedback"><?php echo $username_err; ?></span> -->
                    <span class="invalid-feedback" style="font-size:100%">
                        <?php echo $email_err; ?>
                    </span>
                </div>
                <div class="input_div">
                   <input type="password" name="password" placeholder="Password" id="myInput" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                 <!-- <span class="invalid-feedback"><?php echo $password_err; ?></span> -->
                    <span class="invalid-feedback" style="font-size:100%">
                        <?php echo $password_err; ?>
                    </span>

                </div>
                <div class="input_div">
                <input type="password" name="confirm_password" placeholder="Confirm Password" id="myConfirmInput"  class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback" style="font-size:100%"><?php echo $confirm_password_err; ?></span>
                    </span>
                </div>
                <div class="input_div">
                <!-- <input type="file" name="userImage" class="form-control" value="<?php echo $imgData; ?>"> -->
                <input type="file" name="userImage" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback" style="font-size:100%"><?php echo $image_err; ?></span>
                    </span>
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

                <button type="submit" class="site-btn" name="Submitt" style="margin-bottom:1%">Sign Up</button>

                <p>Already have an account? <a href="login.php">Login here</a>.</p>


            </form>
        </div>
    </div>
</div>



<?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>
