<?php
require 'databasecon.php';
$emailErr =" ";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $sqlcheck= "SELECT Name FROM administrators WHERE Email='$email' ";
    $runn = $conn->query($sqlcheck);
    $runn = $runn->fetch_assoc();
    if(!empty($runn)){
        $_SESSION['email'] = $email;
        // echo $_SESSION['email'];
        header('location: recover.php');
    }
    else{
        $emailErr = "you are not an Admin";
    }


 }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="Assets/icons/favicon.png" >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="Design/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="Design/bootstrap.min.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot_password</title>
</head>
<body>
<div class="container padding-bottom-3x mb-2 mt-5">
	    <div class="row justify-content-center">
	        <div class="col-lg-8 col-md-10">
	            <div class="forgot">
	                <h2>Forgot your password?</h2>
	            </div>
	            <form class="card mt-4" method="POST" action="">
                    <span class="text-danger"><?php echo $emailErr ; ?></span>
	                <div class="card-body">
	                    <div class="form-group"> <label for="email-for-pass">Enter your email address</label> <input class="form-control" type="text" id="email-for-pass" name="email" required=""><small class="form-text text-muted">Enter the email address you used during the registration on bortech_visitors_record.com. Then we'll email a link to this address.</small> </div>
	                </div>
	                <div class="card-footer"> <button class="btn btn-success" type="submit">Get New Password</button> <a class="btn btn-danger" href="login.php">Back to Login</a> </div>
	            </form>
	        </div>
	    </div>
	</div>
</body>
</html>


