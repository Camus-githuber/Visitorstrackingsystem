<?php
 require '../database.php' ; 
 
 
 ?>
<script>
$(document).ready(function(){
  $("table > tbody > tr").hide().slice(0,10).show();

  $("#t").load("time.php");
  setInterval(function(){
    $("#t").load("time.php");
    // refresh()

  },1000);
   
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



<div class=" row justify-content-end">
  <div class=" m-3" id="t" >
    
  </div>

</div>

<div>
    <p class=" text-center text-info">Add Visitor</p>
</div>
<div class="m-2">
<form class="row g-3" action="" method="post">
  <div class="col-md-6">
    <label for="Name" class="form-label m-1">Name</label><span class=" text-danger"><?php echo $nameErr ; ?></span>
    <input type="text" class="form-control" id="Name" name="name" required>
  </div>
  <div class="col-md-6">
    <label for="SSN" class="form-label m-1">SSN</label><span class=" text-danger"><?php echo $ssnErr ; ?></span>
    <input type=" number" class="form-control ssn " id="SSN" name="ssn" maxlength="9" required>
  </div>
  <div class="col-md-6">
    <label for="Contact" class="form-label m-1">Contact</label><span class=" text-danger"><?php echo $numErr ; ?></span>
    <input type=" number" class="form-control numberonly" id="Contact" placeholder="" name="num" maxlength="9" required>
  </div>
  <div class="col-md-6">
    <label for="Email" class="form-label m-1">Email</label><span class=" text-danger"><?php echo $emailErr ; ?></span>
    <input type="email" class="form-control" id="inputAddress2" placeholder="johndoe@gmail.com" name="email" required>
  </div>
  <div class="col-md-3">
    <label for="Gender" class="form-label m-1">Gender</label><span class=" text-danger"><?php echo $genderErr ; ?></span>
    <select id="Gender" class="form-select" name="gender" required>
      <option selected value="">---</option>
      <option  value="M">Male</option>
      <option value="F">Female</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="inputDate" class="form-label m-1">Date</label><span class=" text-danger"><?php echo $dateErr ; ?></span>
    <input type="date" class="form-control" id="inputDate" name="date" value="<?php echo date('Y-m-d'); ?>" required disabled>
  </div> 
  <div class="col-md-6">
    <label for="reason" class="form-label m-1">Reason</label><span class=" text-danger"><?php echo $reasonErr ; ?></span>
    <textarea class="form-control" id="reason" name="reason" rows="5" wrap="hard" placeholder="Reason For Visit" required></textarea>
  </div> 
  <div class="col-12">
    <input type="submit" class="btn btn-primary" name="submit" id="submit">
  </div>
</form>
</div>

<div class="row justify-content-center">
    <div class="table-responsive col-md-10 mt-3">
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">SSN</th>
            <th scope="col">Email</th>
            <th scope="col">Tel_Num</th>
            <th scope="col">Gender</th>
            <th scope="col">Entry_time</th>
            <th scope="col">Exit_time</th>
            <th scope="col">Click To Exit</th>
        </tr>
    </thead>
    <tbody>
      <?php
        $sqlFetchData = "SELECT VisitorId,EntryTime,ExitTime FROM visitorstrack WHERE ExitTime='' ";
        $VisitorsTable = $conn->query($sqlFetchData);
        // var_dump($VisitorsTable->fetch_assoc());
          // output data of each row
          $i = 1;
          while($row = $VisitorsTable->fetch_assoc()) {
            $VID = $row['VisitorId'];
            $sqlGetVisitorInfo = "SELECT Name,SSN,PhoneNumber,Gender,Email FROM visitors WHERE Id='$VID'";

            $info = $conn->query($sqlGetVisitorInfo);
            
            
            while($data =$info->fetch_assoc() ){
             global $mail ;
             $mail= $data['Email'];
              
              ?>
            
              
      
        <tr>

            <td><?php echo $i ; ?></td>
            <td><?php echo $data['Name']; ?></td>
            <td><?php echo $data['SSN']; ?></td>
            <td><?php echo $data['Email']; ?></td>
            <td><?php echo $data['PhoneNumber']; ?></td>
            <td><?php echo $data['Gender']; } ?></td>
            <th><?php 
                  echo $row['EntryTime'];
            
            
            ?></th>
            <th><?php 
                 echo $row['ExitTime'];
            ?></th>
            <th><a href="exitime.php " class=" link-light text-decoration-none exit" id="<?php echo $mail ;?> "><button class="btn btn-danger " name="ExitTime" >OUT</button></a></th>
        </tr>
        <?php
        $i++;
           }
        
        ?>
    </tbody>

</table>
</div>
</div>
<script>
  $(document).ready(function(){
    $('#submit').click(function(e){
      e.preventDefault()
      var nam = $('#Name').val()
      var number = $('#Contact').val()
      var ssnum = $('#SSN').val()
      var mail = $('#inputAddress2').val()
      var reaso = $('#reason').val()
      var gende = $('#Gender').val()
      $.post(
        'database.php',
        {
          name:nam,
          email:mail,
          ssn:ssnum,
          num:number,
          gender:gende,
          reason: reaso
        },
        function(data, status,jwXHR){
          $('#content').load('Pages/addvisitor.inc.php')
        }
      )
    })

    $('.exit').click(function(e){
      e.preventDefault()
       var page = $(this).attr('href')
       var mail = $(this).attr('id')
       $.get(
         page,
         {
           Email: mail 
         },
         function(data,status,jqXHR){
          $('#content').load('Pages/addvisitor.inc.php')
         }
       )
    })

  })

</script>
