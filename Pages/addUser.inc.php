<?php 
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
              $sqlAddNewAdmin = "INSERT INTO administrators(Name,SSN,PhoneNumber,Gender,Email,DOB,Passwords) VALUES ('$name','$ssn','$num','$gender','$email','$dob','$pwd')" ;
        
              if (mysqli_query($conn, $sqlAddNewAdmin)) {
                echo "<p class = 'newrec'> New record created successfully</p>";
            } else {
                echo "Error: " . $sqlAddNewAdmin . "<br>" . mysqli_error($conn);
            }
       }



}



?>






<div class=" row justify-content-center">
  <p></p>
  <p class="text-center text-primary"> Add New Administrator</p>
  <div class=" col-md-6 mt-4">
      <form action="" method="POST">
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="name">Name</span>
            <input type="text" class="form-control" aria-describedby="name" name="name" required><span><?php echo $nameErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="ssn">SSN</span>
            <input type=" number" maxlength="9" class="form-control ssn" id="ssn" aria-describedby="ssn" name="ssn" required><span><?php echo $ssnErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="num">Tel</span>
            <input type=" number" maxlength="9" class="form-control numberonly" aria-describedby="num" name="num" id="num" required><span><?php echo $numErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="dob">DOB</span>
            <input type="date" class="form-control" aria-describedby="dob" name="DOB" id="dob" required><span><?php echo $DobErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="mail">Email</span>
            <input type="email" class="form-control" aria-describedby="mail" name="email" id="mail" required><span><?php echo $emailErr  ?></span>
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
            <input type="password" class="form-control" aria-describedby="pwd" name="pwd" id="pwd" required><span><?php echo $pwdErr  ?></span>
          </div>
          <div class="input-group mb-3">
            <span class=" input-group-text bg-warning" id="rpwd">Repeat</span>
            <input type="password" class="form-control" aria-describedby="rpwd" name="rpwd" id="rpwds" required><span><?php echo $pwdErr  ?></span>
          </div>
          <div class="mt-2">
          <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
          </div>
        </form>

        <!-- <button class="button bg-success btn"><a href="">Update profile</a></button> -->
  </div>
</div>
<script>
  $(document).ready(function(){
    $('.newrec').fadeOut();
    // $('#submit').click(function(e){
    //   e.preventDefault()
    //   nam = $('input > #name').val()
    //   num1 = $('input > #dob').val()
    //   mal = $('input > #mail').val()
    //   ssn1 = $('input > #ssn').val()
    //   dob1 = $('input > #dob').val()
    //   gen = $('input > #gen').val()
    //   pwds = $('input > #pwd').val() 
    //   rpwds = $('input > #rpwds').val() 

    //   $.post(
    //     'Pages/addUser.inc.php',
    //     {
    //         name:nam,
    //         email:mal,
    //         ssn:ssn1,
    //         num:num1,
    //         dob:dob1,
    //         gender:gen,
    //         pwd:pwds,
    //         rpwd:rpwds,


    //     },
    //     function(data,status,jqXHR){
    //       console.log(status)
    //       // $(selector).load('Pages/addUser.inc.php')
          
    //     }
    //   )
      
      // if($('form').submit() == true){
      //   console.log('success')
      // }
      // else if ($('form').submit() == false){
      //   console.log('failue')
      // }
    // })
    
    $(".numberonly").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
              return false;
  }
  });
  $(".ssn").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
              return false;
        
  }


});

  });
</script>
