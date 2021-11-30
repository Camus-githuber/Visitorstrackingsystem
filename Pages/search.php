<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "bortech_visitors_record";
 
 // Create connection
 $conn = new mysqli($servername,$username,$password,$dbname);
 
 // Check connection
 if($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $period = $_POST['period'];
  $start_date = $_POST['StartDate'];
  $end_date = $_POST['EndDate'];
  

   if($period || $start_date){
      $d = date('Y-m-d');
       if($period == 1){
          $strselect ="you have selected today".$d;
              // $d = date('Y-m-d');
              $mysql = "SELECT Id,Name,Email,SSN,PhoneNumber,Gender FROM visitors WHERE Id IN ( SELECT VisitorId FROM visitorstrack WHERE Dates='$d')";
       }
        elseif ($period == 2){
          $y = date('Y-m-d',strtotime('yesterday'));
          $strselect ="you have selected yesterday".$y;
              
              $mysql = "SELECT Id,Name,Email,SSN,PhoneNumber,Gender FROM visitors WHERE Id IN ( SELECT VisitorId FROM visitorstrack WHERE Dates='$y')";
      }
         elseif($period == 3){
          $w =  date('Y-m-d',strtotime('monday this week'));
          $strselect ="you have selected this week".$w;
              $mysql = "SELECT Id,Name,Email,SSN,PhoneNumber,Gender FROM visitors WHERE Id IN ( SELECT VisitorId FROM visitorstrack WHERE Dates >='$w')";
         }
         elseif($period == 4){
          $m = date('Y-m-01');
          $strselect =  "you have selected this month".$m;
          
              $mysql = "SELECT Id,Name,Email,SSN,PhoneNumber,Gender FROM visitors WHERE Id IN (SELECT VisitorId FROM visitorstrack WHERE Dates >= '$m')";
         }
          elseif($period == 5){
              $y = date('Y-01-01');
              $strselect = "you have selected this year".$y;
              $mysql = "SELECT Id,Name,Email,SSN,PhoneNumber,Gender FROM visitors WHERE Id IN (SELECT  VisitorId FROM visitorstrack WHERE Dates >= '$y')";
          }
          elseif( isset($start_date,$end_date )){
              $strselect = "shows records between ".$start_date ." And ". $end_date;
              
              $mysql = " SELECT Id,Name,Email,SSN,PhoneNumber,Gender FROM visitors WHERE Id IN (SELECT VisitorId FROM visitorstrack WHERE Dates BETWEEN '$start_date' AND '$end_date' )";
          }
          
       

  
   
  }
  else{
    $mysql = "SELECT * FROM visitors";
    }
  

}


$visitorsTrack = $conn->query($mysql);
$row = $visitorsTrack->fetch_assoc();


$visitorsTrack = $conn->query($mysql);

$i = 1;
while($row = $visitorsTrack->fetch_assoc()) {
    
    ?>
 <tr>
     <td><?php echo $i ; ?></td>
     <td><?php echo $row['Name'];  ?></td>
     <td><?php echo $row['SSN'];  ?></td>
     <td><?php echo $row['Email'];  ?></td>
     <td><?php echo $row['PhoneNumber'];  ?></td>
     <td><?php if($row['Gender'] == 'F') { echo 'Female'; } else echo 'Male'; ?></td>
    <td><?php 
    $Vid = $row['Id'];
    $sqlGetTotalVisits = "SELECT COUNT(Dates) FROM visitorstrack WHERE VisitorId='$Vid' ";
                $TotalVisits = $conn->query($sqlGetTotalVisits);
                $total =$TotalVisits->fetch_assoc();
                echo $total['COUNT(Dates)'];
    ?></td>
 </tr>
 <?php
 $i++;
}
    ?>