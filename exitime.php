<?php

    require_once 'databasecon.php';
    
    $Email = $_GET['Email'];

    $t = date("H:i:s");
    $d = date("Y-m-d");

    $lt=array(); // array for times

//Getting corrresponding Id

    $sqlGetVisitorId = "SELECT Id FROM visitors WHERE Email='$Email'";
    $result = $conn->query($sqlGetVisitorId);
    $VisitorID = '';
    while($row = $result->fetch_assoc()){
        $VisitorID = $row['Id'];
    }
    
    
    $sqlSelectTime = " SELECT EntryTime FROM visitorstrack WHERE VisitorId = '$VisitorID' AND Dates = '$d' ";
    $R = $conn->query($sqlSelectTime);
    while($data = $R->fetch_assoc()){
        array_push($lt,$data['EntryTime']);   
    }
    $Lastime = max($lt);
    $sqltimeUpdate = "UPDATE visitorstrack SET ExitTime = '$t' WHERE EntryTime = '$Lastime'";
    $conn->query($sqltimeUpdate);


    header('location: index.php?PageName=addvisitor');
// sjnpovajdpov;dzlvm; sadm n vpsd pv sd

?>

