<?php
require_once 'databasecon.php';

$nameErr=$emailErr=$genderErr=$numErr=$dateErr=$ssnErr=$reasonErr ="*";
$date = date('Y-m-d');


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $EntryTime= date("H:i:s");

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

      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      }
       else {
       
        // check if e-mail address is well-formed
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
        else{
            $email = test_input($_POST["email"]);
        }
      }

      if (empty($_POST["ssn"])) {
        $ssnErr = "SSN is required";
      } else {
        // check if SSN is correct format
        if (!preg_match("/^[0-9]{9}$/",$_POST["ssn"])) {
          $ssnErr = "Ex: 000000000";
          
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

    // check if gender selected
        if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        }
        else{ 
            $gender = test_input($_POST["gender"]);
          }

        // check reason
        if (empty($_POST["reason"])) {
          $reasonErr = "Why is he/she there!";
          }
          else{ 
              $Reason= test_input($_POST["reason"]);
            }
        
 if(isset($name,$num,$email,$date,$gender,$ssn,$Reason))
 {
     $sqlVisitors = "INSERT INTO visitors(Name,SSN,PhoneNumber,Gender,Email) VALUES ('$name','$ssn','$num','$gender','$email')" ;

     if (mysqli_query($conn, $sqlVisitors)) {
        echo "<span class='suc'>New record created successfully</span><br>";
    }

     $sqlGetVisitorID= "SELECT Id FROM visitors WHERE Email = '$email'";
    
    $vId=mysqli_query($conn, $sqlGetVisitorID);
    $VisitorId='';
    while ($row = $vId->fetch_assoc()){
      $VisitorId = $row['Id'];
    }

     $sqlVisitorsRecord = "INSERT INTO visitorstrack(VisitorId,EntryTime,Dates,Reason) VALUES ('$VisitorId','$EntryTime','$date','$Reason')";
     if ($conn->query( $sqlVisitorsRecord)) {
        echo "<span class='suc'>New record created successfully</span>";
    }

}

}
?>