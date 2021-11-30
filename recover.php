<?php
require 'databasecon.php';
$email = $_SESSION['email'];
$pwdErr =" ";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Np = $_POST['new_password'];
    $Op = $_POST['confirm_password'];
    $num = $_POST['number'];
    if($Np == $Op){
        $truncate = "hslikughkhegk rthkehrig uheriiguhihtigruh";
        $pwd = md5($Np.$truncate);
        
        echo $email;
        $sql = "UPDATE administrators SET Passwords='$pwd' WHERE Email = '$email' AND PhoneNumber= '$num' ";
        $run = $conn->query($sql);
        if($run === true){
            // echo "update successful";
            header('Location: logout.php');
        }
    }
    else{
        $pwdErr="Password or Number Error";
    }


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="Assets/icons/favicon.png" > 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Design/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="Design/bootstrap.min.css" type="text/css">
    <title>Recover</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Recover</h5>
                    <span class="text-success">FOR :<?php echo $email;  ?></span><br>
                    <p></p>
                    <form class="form-signin" method="POST" action="">
                        <span class="text-danger"><?php echo $pwdErr ;?></span>
                        <div class="form-label-group"> <input type=" number" id="number" class="form-control" placeholder="registered number" name="number" required maxlength="9"> <label for="number">Registerd Number</label> </div>
                        <div class="form-label-group"> <input type="password" id="inputPassword" class="form-control" placeholder="New Password" name="new_password" required autofocus> <label for="inputPassword">New Password</label> </div>
                        <div class="form-label-group"> <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" name="confirm_password" required> <label for="inputPassword">Confirm Password</label> </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>