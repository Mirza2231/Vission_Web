<?php
include '../jenny_mart/_Layout/Layout_header.php';
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // header("location: we.php");
     echo "<script>
        window.location = '../Landing_Page/index.php';
    </script>";
    exit;
}
// Include config file
// include '../Configuration/config.php';

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id,$email, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;  
                            $_SESSION["email"] = $email;                          


                            
                            // Redirect user to welcome page
                            // header("location: welcome.php");
                            echo "<script>
                                window.location = './index.php';
                            </script>";
                            
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
<?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger" style="font-size:small">' . $login_err . '</div>';
        }        
        ?>
<div class="container">
    <div class="wrapper">
        <div style="
        display:flex;
        align-items:center;
        flex-direction:column;
        margin-top:2%;">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
        </div>


        <div class="contact__form">
            <!-- <h5>SEND MESSAGE</h5> -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="
                display:flex;
                align-items:center;
                flex-direction:column;
                " >
                <div class="input_div">
                    <input type="text" name="username" placeholder="Username"
                        class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $username; ?>">
                    <span class="invalid-feedback" style="font-size:100%">
                        <?php echo $username_err; ?>
                    </span>
                </div>
                <div class="input_div">
                    <input type="password" name="password" placeholder="Password"
                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback" style="font-size:100%">
                        <?php echo $password_err; ?>
                    </span>
                </div>
                <button type="submit" class="site-btn" name="Submitt" style="margin-bottom:1%">Login</button>
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

            </form>
        </div>
    </div>
</div>

<?php

include '../jenny_mart/_Layout/Layout_Footer.php';

?>