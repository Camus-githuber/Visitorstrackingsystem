<?php
// require 'databasecon.php' ; 
$id = $_SESSION['Id'];

$nameErr=$emailErr=$genderErr=$numErr=$DobErr=$ssnErr=$pwdErr=" ";


if($_SERVER["REQUEST_METHOD"] == "POST"){

  
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

          if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } else {
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {
              $nameErr = "Only letters and white space allowed";
            }
            else{
                $name = test_input($_POST["name"]);
            }
          }

            // check if e-mail address is well-formed
          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          }
          else {
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
            }
            else{
                $email = test_input($_POST["email"]);
            }
          }

           // check if SSN 

          if (empty($_POST["ssn"])) {
            $ssnErr = "SSN is required";
          } else {
            if (!preg_match("/^[0-9]{9}$/",$_POST["ssn"])) {
              $ssnErr = "Ex: 000-00-0000";
              
            }
            else{
                $ssn = test_input($_POST["ssn"]);
            }
          }

          // Check number validity
          if (empty($_POST["num"])) {
            $numErr = "Tel Number is required";
          } else {
            
            if (!preg_match("/^[0-9]{9}$/",$_POST["num"])) {
              $numErr = "Ex: 6700000000";
            }
            else{
                $num = test_input($_POST["num"]);
            }
          }

          // check DOB
            if (empty($_POST["DOB"])) {
                $DobErr = "DOB required";
              }
              else{ 
                  $dob = test_input($_POST["DOB"]);
                }

          // check if gender selected
            if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
            }
            else{ 
                $gender = test_input($_POST["gender"]);
            }

            // check password 
              if (empty($_POST["pwd"])) {
                $pwdErr = "Password is required";
                }
                else{ 
                    if( $_POST['pwd'] == $_POST['rpwd']){
                      $passer = test_input($_POST['pwd']);
                      $faker ="hslikughkhegk rthkehrig uheriiguhihtigruh";
                      $pwd = md5($passer.$faker);
                    }
                  }


        if(isset($name,$num,$email,$gender,$ssn,$pwd,$dob))
        {
              $sqlAddNewAdmin = "UPDATE  administrators SET Name='$name' ,SSN = '$ssn',PhoneNumber = '$num' ,Gender = '$gender',Email = '$email',DOB = '$dob',Passwords = '$pwd' WHERE Id = '$id' " ;
        
              if (mysqli_query($conn, $sqlAddNewAdmin)) {
                echo "<p class = 'newrec text-success suc'>".$_SESSION['Username'].": Your Info Has been updated succesfully </p>";
            } else {
                echo "Error: " . $sqlAddNewAdmin . "<br>" . mysqli_error($conn);
            }
       }

// echo '<script> window.location.assign("logout.php") </scripts>';



}

$sqlGetAccordData = " SELECT Name,DOB,PhoneNumber,SSN,Email FROM administrators WHERE Id = '$id' ";
$result = $conn->query($sqlGetAccordData);
$info = $result->fetch_assoc();



?>

<div class=" row justify-content-center">
  <p class="text-center text-primary"> Update Your Profile</p>
  <div class=" col-md-6 mt-4">
      <form action="" method="post">
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="name">Name</span>
            <input type="text" class="form-control" aria-describedby="name" name="name" value="<?php echo $info['Name'] ; ?>" required><span><?php echo $nameErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="ssn">SSN</span>
            <input type="text" class="form-control" aria-describedby="ssn" name="ssn" value="<?php echo $info['SSN'] ; ?>" required><span><?php echo $ssnErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="num">Tel</span>
            <input type="num" class="form-control" aria-describedby="num" name="num" value="<?php echo $info['PhoneNumber'] ; ?>" required><span><?php echo $numErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="dob">DOB</span>
            <input type="date" class="form-control" aria-describedby="dob" name="DOB" value="<?php echo $info['DOB'] ; ?>" required><span><?php echo $DobErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="mail">Email</span>
            <input type="email" class="form-control" aria-describedby="mail" name="email" value="<?php echo $info['Email'] ; ?>" required><span><?php echo $emailErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="gen">Gender</span>
            <select name="gender" id="gen" required>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select><span><?php echo $genderErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="pwd">Password</span>
            <input type="password" class="form-control" aria-describedby="pwd" name="pwd" required><span><?php echo $pwdErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="rpwd">Repeat</span>
            <input type="password" class="form-control" aria-describedby="rpwd" name="rpwd" required><span><?php echo $pwdErr  ?></span>
          </div>
          <div class="mt-2">
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          </div>
        </form>

        <!-- <button class="button bg-success btn"><a href="">Update profile</a></button> -->
  </div>
</div>