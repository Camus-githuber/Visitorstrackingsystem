<?php
require 'databasecon.php';

  $loginErr = "";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Email = $_POST['email'];
        $Pwd = $_POST['pwd'];
        $faker ="hslikughkhegk rthkehrig uheriiguhihtigruh";
        $TruePwd = md5($Pwd.$faker);

        $sqllogin = " SELECT Name,Id,Email FROM administrators WHERE Email = '$Email' AND Passwords = '$TruePwd ' ";
        $runquery = $conn->query($sqllogin);
        
        if(!$runquery){
          $loginErr = "Email or Password Mismatch!";
        }
        else{
          $data  = $runquery->fetch_assoc();
            // var_dump($data);
            $name = $data['Name'];
            $id = $data['Id'];
            $_SESSION['Username']= $name;
            $_SESSION['Id'] = $id ;
           
            // echo $name;

            header("location: index.php");
          
        }

 }





?>





<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="Assets/icons/favicon.png" >
	<meta charset="utf-8">
	<title>Bortech Login</title>
	<link rel="stylesheet" href="Design/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="Design/bootstrap.min.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="description" content="Records of Visitors in Bortech's company" lang="en">
    <meta name="keywords" content="HTML,CSS,PHP,JavaScript">
    <meta name="Author" content="Dexter">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img
                src="Assets/database-icon.jpeg"
                alt="login form"
                class="img-fluid" style="border-radius: 1rem 0 0 1rem;"
              />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="" method="POST">
                  
                  <div class="d-flex align-items-center mb-3 pb-1">
                  <img src="Assets/icons/favicon.png" width="80" height="80" >
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                  <span class="text-danger"><?php echo $loginErr ; ?></span>
                    <input type="email" id="form2Example17" class="form-control form-control-lg" name="email" required/>
                    <label class="form-label" for="form2Example17">Email address</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" class="form-control form-control-lg" name="pwd" required/>
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button><br>
                    <a class="small text-primary" href="forgotpwd.php">Forgot password?</a><br>
                  </div>

                  
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>



