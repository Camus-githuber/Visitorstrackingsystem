<?php
require "../databasecon.php";
$TV='';
$TVS ='';
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $StartDate= $_POST['StartDate'];
    $EndDate=$_POST['EndDate'];
    if(isset($StartDate,$EndDate)){
    $sqlGetTotalVisits="";
    if($StartDate==$EndDate){
        $sqlGetTotalVisits="SELECT COUNT(Dates) FROM visitorstrack WHERE Dates='$StartDate'";
    }
    elseif($StartDate!=$EndDate){
    $sqlGetTotalVisits="SELECT COUNT(Dates) FROM visitorstrack WHERE Dates BETWEEN '$StartDate' AND '$EndDate' ";
    }
    $data = $conn->query($sqlGetTotalVisits);
    $Tot = $data->fetch_assoc();
    $TV = $Tot['COUNT(Dates)'];
    // var_dump($Tot);
    $sqlGetTotalVisitors = " SELECT COUNT(DISTINCT VisitorId) FROM visitorstrack WHERE Dates BETWEEN '$StartDate' AND '$EndDate' ";
    $TotalVisitors = $conn->query($sqlGetTotalVisitors);
    $info = $TotalVisitors->fetch_assoc();
    $TVS = $info['COUNT(DISTINCT VisitorId)'];
}
    // var_dump($info);   


    


}
 ?>
<tr>
<td><h1><?php echo $TVS;  ?></h1></td>
<td><h1><?php echo $TV;  ?></h1></td>
</tr>

</p>