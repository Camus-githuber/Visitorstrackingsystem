<?php
require "../databasecon.php";
  $id = $_SESSION['Id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $PeriodBegin = $_POST['period_start'];
    $PeriodEnd = $_POST['period_end'];

    $sqlReportCreator = "SELECT Name,Email FROM administrators WHERE Id = '$id' ";
    
    $Array = $conn->query($sqlReportCreator);
    $Array = $Array->fetch_assoc();
    $ReportCreator = $Array['Name'];
    $ReportEmail = $Array['Email'];

    $sqlVisitors = "SELECT Dates,VisitorId FROM visitorstrack WHERE Dates BETWEEN '$PeriodBegin' AND  '$PeriodEnd' " ;
    $Result =$conn->query($sqlVisitors);
    $totVisitors = array();
    $visitors = array();
    $distinct = array();

    while($data = $Result->fetch_assoc()){
        array_push($totVisitors,$data['Dates']);
        array_push($visitors,$data['VisitorId']);
    }
    $totvisits = sizeof($totVisitors);
    $TotalVisitors = sizeof(array_unique($visitors));
    $distinct = array_unique($totVisitors);
?>



<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Design/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../Design/bootstrap.min.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Generator</title>
    
 
</head>
<body>
<script src="../jquery.js" type="text/javascript"></script>
<script src="../jsPDF-1.3.2/dist/jspdf.min.js" type="text/javascript"></script>
<script src="../myscript.js" type="text/javascript"></script>


<div class="container mt-5" id="pdfcontent">
    <div class="d-flex justify-content-center row">
        <div class="col-md-12">
            <div class="bg-white rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-uppercase text-info">Report Of Records</h2>
                        <div class="billed"><span class="font-weight-bold text-uppercase"><h4 class="text-primary"><span>Bortech.com</span></h4></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Created By:</span><span class="ml-1"><?php echo $ReportCreator ?></span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Email:</span><span class="ml-1"><?php echo $ReportEmail ; ?></span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1 date"><?php echo date('Y-m-d H:i:s'); ?></span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Contains Record Between : </span><span class="text-danger"><?php echo $PeriodBegin." And ".$PeriodEnd; ?></span></div>
                    </div>
                    <div class="col-md-6 text-right mt-3">
                        <img src="../Assets/icons/favicon.png" width="80" height="80" class="" >
                    </div>
                </div>



                 <div class="table-responsive col-md-10 mt-3">
                    <table class="table table-light table-striped table-bordered">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Visits</th>
                            <th scope="col">Visitors</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                            foreach($distinct as $unidate){?>
                            <tr> 
                                <td><?php echo $unidate;  ?></td>
                                <?php 
                                $sqlCountVisitsForThatDay = "SELECT COUNT(Dates),VisitorId FROM visitorstrack WHERE Dates = '$unidate'";
                                $R= $conn->query($sqlCountVisitsForThatDay);
                                // $R= $R->fetch_assoc();
                                while($Ro = $R->fetch_assoc()){
                                    $tot = $Ro['COUNT(Dates)' ];
                                //    var_dump($Ro ['VisitorId']) ;
                                    // array_push($visitors,$der);
                             }
                                ?> 
                                <td><?php echo $tot;   ?></td>
                                <td>
                                <?php 
                                    $sqlGetNameOfSpecificVisitor = "SELECT DISTINCT(Name) FROM visitors WHERE Id IN ( SELECT VisitorId FROM visitorstrack WHERE Dates='$unidate')";
                                    $Re = $conn->query($sqlGetNameOfSpecificVisitor);
                                    while( $R = $Re->fetch_assoc()){
                                            echo $R['Name'].", ";
                                           

                                    }
                                    
                                   
                                     
                                    ?>
                                    </td> </tr>

                        <?php
                            
                        }

                        }

                        ?>
                        

                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">Total</th>
                                <th scope="col"><?php echo $totvisits ; ?></th>
                                <th scope="col"><?php echo $TotalVisitors ; 
                            ?></th>
                                </tr>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-danger" id="gpdf" onclick="HTMLtoPDF()">Generate a Pdf</button> 
<script>
function HTMLtoPDF(){
    var stringname = 'visitors_report' + $('.date').text()
    var quotes = document.getElementById('pdfcontent');

    html2canvas(quotes, {
        onrendered: function(canvas) {

        //! MAKE YOUR PDF
        var pdf = new jsPDF('p', 'pt', 'letter');

        for (var i = 0; i <= quotes.clientHeight/980; i++) {
            //! This is all just html2canvas stuff
            var srcImg  = canvas;
            var sX      = 0;
            var sY      = 980*i; // start 980 pixels down for every new page
            var sWidth  = 900;
            var sHeight = 980;
            var dX      = 0;
            var dY      = 0;
            var dWidth  = 900;
            var dHeight = 980;

            window.onePageCanvas = document.createElement("canvas");
            onePageCanvas.setAttribute('width', 900);
            onePageCanvas.setAttribute('height', 980);
            var ctx = onePageCanvas.getContext('2d');
            // details on this usage of this function: 
            // https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Using_images#Slicing
            ctx.drawImage(srcImg,sX,sY,sWidth,sHeight,dX,dY,dWidth,dHeight);

            // document.body.appendChild(canvas);
            var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);

            var width         = onePageCanvas.width;
            var height        = onePageCanvas.clientHeight;

            //! If we're on anything other than the first page,
            // add another page
            if (i > 0) {
                pdf.addPage(612, 791); //8.5" x 11" in pts (in*72)
            }
            //! now we declare that we're working on that page
            pdf.setPage(i+1);
            //! now we add content to that page!
            pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width*.62), (height*.62));

        }
        //! after the for loop is finished running, we save the pdf.
        pdf.save(stringname+'.pdf');
    }
  });



}
</script> 
</body>
</html>
