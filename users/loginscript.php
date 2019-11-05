
<?php
// Include config file
session_start();
//$myid = $_GET["hid"];
// $unused = $myid; 
require_once "db.php";


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted

 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
        $ac = 2;
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
        $sql = "SELECT id, username, password FROM users WHERE username = :username AND Access_level = '2'";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $Vname = $row["Customer_name"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                           // echo '<META HTTP-EQUIV="refresh" content="0;URL=../single/checkout.php?hid='.$unused.' ">';
                            header("location: index.php?hid=$username");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            echo '<script> alert('.$password_err.')</script>';
                            header("location: ../login/login.php?hid=$myid");
                            
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                    echo '<script> alert('.$password_err.')</script>';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                echo '<script> alert('.$password_err.')</script>';
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);

?>